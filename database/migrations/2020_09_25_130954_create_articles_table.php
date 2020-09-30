<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->text('title');
            $table->text('author');
            $table->text('author_link');
            $table->text('content_original');
            $table->text('content_markdown');
            $table->text('content_html');
            $table->text('excerpt');
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
