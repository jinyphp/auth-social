<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/**
 * Google 로그인
 */
Route::middleware(['web'])
    ->name('oauth.')
    ->prefix('/login')->group(function () {
        Route::get('/google', [
            \Jiny\Social\Http\Controllers\OAuthGoogle::class,
            'redirect'
        ]);

        Route::get('/google/callback', [
            \Jiny\Social\Http\Controllers\OAuthGoogle::class,
            'callback'
        ]);
    });

/**
 * 페이스북
 */
Route::middleware(['web'])
    ->name('oauth.')
    ->prefix('/login')->group(function () {
        Route::get('/facebook', [
            \Jiny\Social\Http\Controllers\OAuthFacebook::class,
            'redirect'
        ]);

        Route::get('/facebook/callback', [
            \Jiny\Social\Http\Controllers\OAuthFacebook::class,
            'callback'
        ]);
    });

/**
 * Github
 */
Route::middleware(['web'])
    ->name('oauth.')
    ->prefix('/login')->group(function () {
        Route::get('/github', [
            \Jiny\Social\Http\Controllers\OAuthGithub::class,
            'redirect'
        ]);

        Route::get('/github/callback', [
            \Jiny\Social\Http\Controllers\OAuthGithub::class,
            'callback'
        ]);
    });

/**
 * 네이버
 */
Route::middleware(['web'])
    ->name('oauth.')
    ->prefix('/login')->group(function () {
        Route::get('/naver', [
            \Jiny\Social\Http\Controllers\OAuthNaver::class,
            'redirect'
        ]);

        Route::get('/naver/callback', [
            \Jiny\Social\Http\Controllers\OAuthNaver::class,
            'callback'
        ]);
    });

/**
 * 카카오
 */
Route::middleware(['web'])
    ->name('oauth.')
    ->prefix('/login')->group(function () {
        Route::get('/kakao', [
            \Jiny\Social\Http\Controllers\OAuthKakao::class,
            'redirect'
        ]);

        Route::get('/kakao/callback', [
            \Jiny\Social\Http\Controllers\OAuthKakao::class,
            'callback'
        ]);
    });

// admin prefix 모듈 검사
// admin 모듈에 선언됨
if(function_exists('admin_prefix')) {
    $prefix = admin_prefix();
} else {
    $prefix = "admin";
}

/**
 * Admin 소셜 연동
 */
Route::middleware(['web','auth:sanctum', 'verified', 'admin'])
->name('admin.auth')
->prefix($prefix.'/auth')->group(function () {

    // 소셜 가입 로그인
    Route::get('oauth',[
        \Jiny\Social\Http\Controllers\Admin\AdminOAuthProvider::class,
        'index'
    ]);

    // 소셜 로그인 공급자
    Route::get('oauth/users',[
        \Jiny\Social\Http\Controllers\Admin\AdminOAuth::class,
        'index'
    ]);

    Route::get('social', [
        \Jiny\Social\Http\Controllers\SocialSettingController::class,
        "index"]);
});


// Route::get('/login/social/{provider}', [
//         \Jiny\Social\Http\Controllers\OAuthRedirect::class,
//         'redirect'
//     ])->name('oauth-redirect')->middleware(['web']);



// 소셜 로그인 콜백
Route::get('/login/social/{provider}/callback', [
    \Jiny\Social\Http\Controllers\OAuthController::class,
    'callback'])->middleware(['web']);






## 인증 Admin
use Jiny\Social\Http\Controllers\AdminOAuthController;
//use Jiny\Social\Http\Controllers\AdminOAuthProviderController;
use Jiny\Social\Http\Controllers\Dashboard;




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

