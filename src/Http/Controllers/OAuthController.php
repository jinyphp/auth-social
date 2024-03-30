<?php
namespace Jiny\Social\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;


use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    public $setting=[];
    public $provider;

    public function __construct()
    {
        $this->setting = config("jiny.auth.setting");
    }

    public function callback(Request $request)
    {
        $this->provider = $request->provider;
        $auth = null;

        try {
            //$auth = Socialite::driver('google')->user();
            $auth = \Socialite::driver($this->provider)
            ->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))
            ->user();
            // $auth contains user details returned by Google
            // You can authenticate the user or perform other actions here
            //dd($auth);
        } catch (\Exception $e) {
            // Handle any errors that occur during the authentication process
            //dd($e->getMessage());
        }

        return $this->createOAuthUser($auth);
    }

    function createOAuthUser($auth)
    {
        if($auth) {
            // 증복된 회원이 있는지 확인
            $user = DB::table('users')->where('email', $auth->email)->first();
            if(!$user) {
                // 미등록회원, 회원 DB등록
                $user = User::create([
                    'name' => $auth->name,
                    'email' => $auth->email,
                    'password' => $auth->token, // 나중에 비빌번호 변경해야함
                ]);

                DB::table('user_oauth')->insert([
                    'user_id' => $user->id,
                    'email'=> $user->email,
                    'provider'=>$this->provider,
                    'oauth_id'=>$auth->id,
                    'created_at'=>date("Y-m-d H:i:s"),
                    'updated_at'=>date("Y-m-d H:i:s")
                ]);
            } else {
                // 이메일로 가입된 회원이, Oauth 인증 요구시
                $oauth = DB::table('user_oauth')->where('email', $auth->email)->first();
                if(!$oauth) {
                    DB::table('user_oauth')->insert([
                        'user_id' => $user->id,
                        'email'=> $user->email,
                        'provider'=>$this->provider,
                        'oauth_id'=>$auth->id,
                        'created_at'=>date("Y-m-d H:i:s"),
                        'updated_at'=>date("Y-m-d H:i:s")
                    ]);
                }

            }

            // 회원 승인 처리
            $this->authAuth($user);

            // 인증된 회원만 접속
            if($this->isNeedAuth()) {

                // 회원 유효기간 만료 체크
                if($user->expire && isExpireTime($user->expire)) {
                    session()->flash('error', "접속 유효기간(".$user->expire.") 이 초과되었습니다.");
                    return redirect('/login');
                    //return redirect()->back();
                }

                // 5.로그인 로그기록
                $this->log($user);

                // 로그인 처리
                Auth::loginUsingId($user->id);

                //dd($auth);

                // 7.페이지 이동
                return $this->redirect();
            }

            $url = "/register/success"; // 초기값
            return redirect($url);

        }

        // OAuth 로그인을 할 수 없습니다.
        return redirect("/login");
    }

    private function redirect()
    {
        $url = "/register/success"; // 초기값

        if(isset($this->setting['auth']['urls']['home'])) {
            if($this->setting['auth']['urls']['home']) {
                $url = $this->setting['auth']['urls']['home'];
            }
        }

        return redirect($url);
    }

    private function log($user)
    {
        // log 기록을 DB에 삽입
        //$user = Auth::user();
        DB::table('user_logs')->insert([
            'user_id' => $user->id,
            'provider'=> $this->provider,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }




    public function isNeedAuth()
    {
        // 자동 인증설정 처리
        if(isset($this->setting['auth']['enable'])) {
            if($this->setting['auth']['enable']) {
                return true;
            }
        }

        return false;
    }


    public function autoAuth()
    {
        if(isset($this->setting['auth']['auto'])){
            if($this->setting['auth']['auto']) {
                return true;
            }
        }
        return false;
    }

    public function authAuth($user)
    {

        // 자동 인증설정 처리
        if($this->isNeedAuth()) {
            if($this->autoAuth()) {
                // 자동인증
                DB::table('users_auth')->insert([
                    'user_id' => $user->id,
                    'enable' => 1,
                    'auth' => 1,
                    'auth_date' => date("Y-m-d h:i:s"),
                    'created_at' => date("Y-m-d h:i:s"),
                    'updated_at' => date("Y-m-d h:i:s")
                ]);

                DB::table('users')->where('id', $user->id)->update([
                    'auth'=>1
                ]);
            } else {
                // 인증요청
                DB::table('users_auth')->insert([
                    'user_id' => $user->id,
                    'enable' => 0,
                    'auth' => 0,
                    'created_at' => date("Y-m-d h:i:s"),
                    'updated_at' => date("Y-m-d h:i:s")
                ]);
            }

        }
    }


}
