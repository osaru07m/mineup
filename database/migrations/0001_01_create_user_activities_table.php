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
        Schema::create('user_activities', function (Blueprint $table) {
            $table->comment('ユーザーアクティビティ');

            $table->id();
            $table->unsignedBigInteger('user_id')->comment('ユーザーID');
            $table->string('action')->comment('アクション');
            $table->json('context')->comment('情報');
            $table->ipAddress()->comment('IPアドレス');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_activities');
    }
};
