<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {// usersという名前の新しいテーブルを作ります
        Schema::create('users', function (Blueprint $table) {
            $table->id();//金の鍵（PRIMARY KEY）が自動的に設定される
            $table->string('name');
            $table->string('email')->unique(); //unique()は「同じメールアドレスは使えない」というルール
            //銀の鍵（UNIQUE INDEX）が自動的に設定される
            $table->timestamp('email_verified_at')->nullable();
            // email_verified_at: メールアドレスが確認された時間を保存する場所
            // nullable()は必須ではない任意の項目を作るときに使う。データベースの用語では「NULL」（空）を許可する
            $table->string('password');
            $table->rememberToken();//ログインを記憶する機能
            $table->timestamps();//データベースの中で、データが作成された時間と更新された時間を保存する列
        });
        // パスワードを忘れたときに、パスワードをリセットする機能
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // ログインを記憶する機能
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }
//簡単な例え：
//password_reset_tokensは、
//パスワードを忘れた時の「パスワード再設定申請書」のようなもの
//メールアドレスで申請者を特定
//トークンは「本人確認用の特別なコード」

//sessionsは、
//ウェブサイトの「入館証」のようなもの
//誰が（user_id）
//どこから（ip_address）
//どんなブラウザで（user_agent）
//いつまで有効か（last_activity）
//を管理します
//これらは、ユーザー認証やセキュリティのための重要なテーブル！

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
