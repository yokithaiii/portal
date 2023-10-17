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
        Schema::create('comments_comments', function (Blueprint $table) {
            $table->id();
            $table->text('comment');
            $table->timestamps();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->index('user_id', 'comment_comment_user_idx');
            $table->foreign('user_id', 'comment_comment_user_fk')->on('users')->references('id');

            $table->unsignedBigInteger('forum_id')->nullable();
            $table->index('forum_id', 'comment_comment_forum_idx');
            $table->foreign('forum_id', 'comment_comment_forum_fk')->on('forums')->references('id');

            $table->unsignedBigInteger('comment_id')->nullable();
            $table->index('comment_id', 'comment_comment_idx');
            $table->foreign('comment_id', 'comment_comment_fk')->on('comments_forum')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments_comments');
    }
};
