<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->comment('ログイン情報');

            $table->id();
            $table->string('login')->unique()->comment('ログインID');
            $table->string('email')->unique()->comment('メールアドレス');
            $table->string('password')->comment('ハッシュ化パスワード');
            $table->string('first_name')->comment('名');
            $table->string('last_name')->comment('姓');
            $table->string('status')->default('active')->comment('ステータス');
            $table->string('language')->default('auto')->comment('使用言語');
            $table->boolean('is_password_change_required')->default(false)->comment('強制パスワード変更フラグ');
            $table->boolean('is_admin')->default(false)->comment('管理者フラグ');
            $table->rememberToken();
            $table->timestamps();
            $table->dateTime('last_logged-in_at')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
