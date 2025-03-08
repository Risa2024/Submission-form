<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// このクラスは、データベースの構造を変更するための設計図みたいなものです
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void//up()は、新しい機能を追加するときに実行される処理です
    {
        Schema::table('posts', function (Blueprint $table) {// postsテーブル（投稿を保存する場所）の中身を変更します
            //１.リレーションを作成する列を追加
            $table->foreignId('user_id');
            //userテーブルのidとpostテーブルのuser_idを紐づける処理が必要
            //2.リレーションを作成する列にリレーションを作成
            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void//down()は、追加した機能を取り消すときの処理です
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('posts_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
};
