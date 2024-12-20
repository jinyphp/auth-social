<?php
namespace Jiny\Social;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire\Livewire;
use Laravel\Fortify\Fortify;

use Illuminate\Routing\Router;

class JinySocialServiceProvider extends ServiceProvider
{
    private $package = "jiny-social";
    public function boot()
    {
        // 모듈: 라우트 설정
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', $this->package);

        // 데이터베이스
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // 설정파일 복사
        $this->publishes([
            __DIR__.'/../config/setting.php' => config_path('jiny/social/setting.php'),
        ]);


        Blade::component($this->package.'::components.'.'social_login', 'social-login');




    }

    public function register()
    {
        /* 라이브와이어 컴포넌트 등록 */
        $this->app->afterResolving(BladeCompiler::class, function () {

            //Livewire::component('WireSocial-Login', \Jiny\Social\Http\Livewire\WireSocialLogin::class);

        });

    }

}
