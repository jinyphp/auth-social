<?php
namespace Jiny\Social\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class WireSocialLogin extends Component
{
    public $forms=[];
    public $message=[];

    public function mount()
    {

    }

    public function render()
    {
        $social = config('services');

        /*
        dd($social);
        $provider = DB::table('user_oauth_providers')
                        ->where('enable', 1)
                        ->get();
                        */
        $providers = [];
        foreach($social as $key => $item) {
            if(is_array($item)) {
                if(isset($item['enable'])) {
                    if($item['enable']) {
                        $providers []= $key;
                    }
                }
                // else {
                //     $providers []= $key;
                // }
            }
        }

        return view("jiny-social::livewire.social",[
            'providers' => $providers
        ]);
    }

}
