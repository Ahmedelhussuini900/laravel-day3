<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('title')->nullable(); // Title of the post
            $table->foreignId('posted_by')->constrained('users'); // Foreign key for the user
            $table->string('image')->nullable(); // Path to image (if any)
            $table->timestamps(); // Automatically creates created_at and updated_at columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}