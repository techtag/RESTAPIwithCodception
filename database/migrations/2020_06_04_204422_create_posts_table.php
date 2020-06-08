<?php

use App\Post;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Post::TABLE_NAME, function (Blueprint $table) {
            $table->id(Post::ID);
            $table->string(Post::TITLE);
            $table->text(Post::CONTENT);
            $table->string(Post::PRIMARY_IMAGE);
            $table->string(Post::THUMBNAIL_IMAGE);
            $table->string(Post::SLUG);
            $table->string(Post::AUTHOR);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
