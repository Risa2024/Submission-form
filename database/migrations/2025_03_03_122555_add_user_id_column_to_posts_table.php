<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// このファイルは「投稿」を保存する場所（postテーブル）
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            //１.リレーションを作成する列を追加。postsテーブルにuser_idという新しい列を追加
            $table->foreignId('user_id');
            //userテーブルのidとpostテーブルのuser_idを紐づける処理が必要
            //2.リレーションを作成する列にリレーションを作成
            $table->foreign('user_id')
            ->references('id')->on('users')// usersテーブルのidと連携
            ->onDelete('cascade');// もしuserテーブルのidが削除されたら、postテーブルのuser_idも消える
        });
    }
    //まとめると：
    //$table->foreignId('user_id');
    // foreign = 外部の、他の
    // Id = 識別番号
    // → 「他のテーブルの識別番号」という意味
//-------------------------------------------------
    //$table->foreign('user_id')
    // foreign = 外部の、他の
    // → 「他のテーブルと関連付ける」という意味
//-------------------------------------------------
   // ->references('id')->on('users')
    // references = 参照する、指し示す
    // on = ～の上に、～に対して
    // → 「usersテーブルのidを参照する」という意味
//-------------------------------------------------
    //->onDelete('cascade')
    // on = ～の時に
    // Delete = 削除
    // cascade = 滝のように連鎖する
    // → 「削除された時に連鎖的に削除する」という意味
//-------------------------------------------------
    // これらの英単語を組み合わせて：
    // 他のテーブルとの関連付け（foreign）
    // 参照先の指定（references）
    // 削除時の動作（onDelete）
//-------------------------------------------------
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
