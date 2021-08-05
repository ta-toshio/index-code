<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url')->unique();
            $table->string('version')->default('');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('path');
            $table->string('extension')->default('');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('klasses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('file_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('path');
            $table->string('extension')->default('');
            $table->text('description')->nullable();
            $table->boolean('existing')->default(true);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->timestamps();
        });

        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('klass_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('name'); // プロパティ名 or メソッド名
            $table->string('type'); // PROPERTY OR METHOD or FUNCTION
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('codes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('file_id')->constrained()->onDelete('cascade');
            $table->foreignId('klass_id')->nullable()->constrained()->onDelete('cascade');
            $table->longText('body')->nullable();
            $table->unsignedInteger('line')->default(0);
            $table->string('checksum')->default('');
            $table->timestamps();
        });

        Schema::create('memos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('file_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('line')->default(0);
            $table->string('code')->default(''); // 該当行
            $table->text('codes')->nullable(); // 該当行の前後X行
            $table->text('body')->nullable();
            $table->string('version')->default('');
            $table->timestamps();
        });

        Schema::create('scraps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('scrap_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('scrap_id')->constrained()->onDelete('cascade');
            $table->foreignId('file_id')->nullable()->constrained();
            $table->unsignedInteger('start_line')->nullable();
            $table->unsignedInteger('end_line')->nullable();
            $table->text('code')->nullable();
            $table->text('body')->nullable();
            $table->unsignedSmallInteger('nest_level')->default(0);
            $table->unsignedSmallInteger('order')->default(0);
            $table->timestamps();
        });

        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('code_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('start_line')->nullable();
            $table->unsignedInteger('end_line')->nullable();
            $table->longText('code')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });

        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title')->default('');
            $table->longText('body')->nullable();
            $table->timestamps();
        });

        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->string('name')->default('');
            $table->timestamps();
        });

        Schema::create('table_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('table_id')->constrained()->onDelete('cascade');
            $table->string('name')->default('');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('note')->nullable();
            $table->timestamps();
        });

        Schema::create('fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('table_id')->constrained()->onDelete('cascade');
            $table->string('table_name')->default('');
            $table->string('field_name')->default('');
            $table->string('field_type')->default('');
            $table->string('field_param')->default('');
            $table->timestamps();
        });

        Schema::create('field_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('field_id')->constrained()->onDelete('cascade');
            $table->string('name')->default('');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('note')->nullable();
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
        Schema::dropIfExists('field_details');
        Schema::dropIfExists('fields');
        Schema::dropIfExists('table_details');
        Schema::dropIfExists('tables');
        Schema::dropIfExists('notes');
        Schema::dropIfExists('stocks');
        Schema::dropIfExists('scrap_details');
        Schema::dropIfExists('scraps');
        Schema::dropIfExists('memos');
        Schema::dropIfExists('codes');
        Schema::dropIfExists('attributes');
        Schema::dropIfExists('klasses');
        Schema::dropIfExists('files');
        Schema::dropIfExists('projects');
    }
}
