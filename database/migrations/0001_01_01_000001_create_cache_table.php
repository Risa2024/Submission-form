<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// このクラスは、一時的なデータを保存するための場所（キャッシュ）を作る設計図です
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {// 1. キャッシュデータを保存するテーブルを作成
        Schema::create('cache', function (Blueprint $table) {
            // key: データを探すための名前（例：「人気記事リスト」）
            // primary()で金の鍵（主キー）に設定
            $table->string('key')->primary();
            // value: 実際に保存するデータ（例：記事のリストデータ）
            // mediumTextは大きなテキストデータを保存できる
            $table->mediumText('value');
            // expiration: データの有効期限（例：24時間後に削除）
            $table->integer('expiration');
        });
        //2. キャッシュの同時更新防止用のテーブルを作成
        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            // owner: 誰が更新しているかを特定するための名前（例：「ユーザーA」）
            $table->string('owner');
            // expiration: データの有効期限（例：24時間後に削除）
            $table->integer('expiration');
        });
    }

    //実際の例：
    //ブログサイトで：
//1. AさんとBさんが同時に同じ記事を編集しようとした
//2. Aさんが先に「編集中」の札（lock）を付ける
//3. Bさんは「今誰かが編集中です」と分かる
//4. Aさんの編集が終わる（または時間切れ）まで待つ
    //このように、データの安全な更新を管理するための仕組みです！

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
    }
};
