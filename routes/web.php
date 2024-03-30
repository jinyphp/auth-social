<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/**
 * 소셜 로그인
 * config.social.php 에 접속 경로 설정되어야 함.
 */

Route::get('/login/{provider}', [
    \Jiny\Social\Http\Controllers\OAuthRedirect::class,
    'redirect'
])->name('oauth-redirect')->middleware(['web']);


Route::get('/login/{provider}/callback', [
    \Jiny\Social\Http\Controllers\OAuthController::class,
    'callback'])->middleware(['web']);



// admin prefix 모듈 검사
// admin 모듈에 선언됨
if(function_exists('admin_prefix')) {
    $prefix = admin_prefix();
} else {
    $prefix = "admin";
}


## 인증 Admin
use Jiny\Social\Http\Controllers\AdminOAuthController;
use Jiny\Social\Http\Controllers\AdminOAuthProviderController;
use Jiny\Social\Http\Controllers\Dashboard;

Route::middleware(['web','auth:sanctum', 'verified', 'admin'])
->name('admin.auth')
->prefix($prefix.'/auth')->group(function () {

    // 소셜로그인
    Route::resource('oauth',AdminOAuthController::class);
    Route::resource('provider',AdminOAuthProviderController::class);

    Route::get('social', [
        \Jiny\Social\Http\Controllers\SocialSettingController::class,
        "index"]);
});

// Alias 라우터
Route::middleware(['web','auth:sanctum', 'verified', 'admin'])
->name('admin.auth')
->prefix($prefix.'/module/social')->group(function () use ($prefix){

    // 사이트 데쉬보드
    Route::get('/', [Dashboard::class, "index"]);

    // 소셜로그인
    Route::redirect('/oauth', $prefix.'/auth/oauth');
    //Route::resource('oauth',AdminOAuthController::class);
    Route::redirect('/provider', $prefix.'/auth/provider');
    //Route::resource('provider',AdminOAuthProviderController::class);
});

