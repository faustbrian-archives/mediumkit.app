<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->text('title');
            $table->text('author');
            $table->text('author_link');
            $table->text('content_original')->nullable();
            $table->text('content_original_html')->nullable();
            $table->text('content_markdown')->nullable();
            $table->text('content_markdown_html')->nullable();
            $table->text('excerpt')->nullable();
            $table->text('url')->unique();
            $table->text('date');
            $table->text('banner')->nullable();
            $table->json('embed_meta');
            $table->json('embed_linked');
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
        Schema::dropIfExists('articles');
    }
}
