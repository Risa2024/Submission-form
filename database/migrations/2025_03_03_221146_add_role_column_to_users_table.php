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
    {
        Schema::table('users', function (Blueprint $table) {
            // usersテーブルにrole（役割）という列を追加
            // role（ロール）とは「役割」や「権限」を意味します。
           $table->string('role')// 役割を文字列で保存（例：'admin', 'user'）
           ->after('name')// name列の後に列を追加
           ->nullable();// 役割が未設定でもOK
        });
    }

// 一般的なロールの種類：
//'admin'     // 管理者（全ての操作ができる）
//'user'      // 一般ユーザー（基本的な操作のみ）
//'editor'    // 編集者（記事の編集ができる）
//'guest'     // ゲスト（閲覧のみ）
//-------------------------------------------------
    //これにより：
    // ユーザーに権限を設定できる
    // 管理者と一般ユーザーを区別できる
    // 特定の機能へのアクセス制御ができる
//-------------------------------------------------
    /**
     * Reverse the migrations.
     */
    // 追加した役割の列を削除する処理
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');// role列を削除
        });
    }
};
