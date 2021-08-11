<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title_ja')->default('');
            $table->string('title_en')->default('');
            $table->text('body_ja')->nullable();
            $table->text('body_en')->nullable();
            $table->string('category')->default('');
            $table->string('type')->default('');
            $table->timestamps();
        });

        Schema::create('ja_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('');
            $table->text('body')->nullable();
            $table->string('category')->default('');
            $table->string('type')->default('');
            $table->timestamps();
        });

        Schema::create('en_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('');
            $table->text('body')->nullable();
            $table->string('category')->default('');
            $table->string('type')->default('');
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
        Schema::dropIfExists('ja_posts');
        Schema::dropIfExists('en_posts');
    }
}
