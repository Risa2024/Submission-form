<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [// 基本的なセキュリティ
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        // 空文字をnullに変換（SQLインジェクション対策）
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        // 文字列の両端の空白を削除（XSS対策の一環）
        \App\Http\Middleware\TrimStrings::class,
    ];

    protected $middlewareGroups = [// Web用セキュリティ
        'web' => [
            // クッキーの暗号化
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            // セッションの暗号化
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            // CSRF保護
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    protected $middlewareAliases = [// 認証・認可
         // ログイン認証
        'auth' => \App\Http\Middleware\Authenticate::class,
        // 基本認証
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        // 管理者権限チェック
        'admin' => \App\Http\Middleware\RoleMiddleware::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];
}