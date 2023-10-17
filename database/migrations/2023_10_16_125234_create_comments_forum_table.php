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
        Schema::create('comments_forum', function (Blueprint $table) {
            $table->id();
            $table->text('comment');
            $table->timestamps();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->index('user_id', 'comment_user_idx');
            $table->foreign('user_id', 'comment_user_fk')->on('users')->references('id');

            $table->unsignedBigInteger('forum_id')->nullable();
            $table->index('forum_id', 'forum_forum_idx');
            $table->foreign('forum_id', 'forum_forum_fk')->on('forums')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments_forum');
    }
};
