<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id');

            $table->morphs('target');
            // The row above is equivalet to the three commented rows below

            // $table->string("target_type");
            // $table->unsignedBigInteger("target_id");
            // $table->index(["target_type", "target_id"]);

            $table->text('content');
            $table->timestamps();

            $table->foreign('author_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
