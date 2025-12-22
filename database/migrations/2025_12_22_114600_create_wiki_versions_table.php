<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/xxxx_create_wiki_versions_table.php
public function up()
{
    Schema::create('wiki_versions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('wiki_id')->constrained()->onDelete('cascade');
        $table->longText('content');             // isi versi lama
        $table->string('title');                 // judul versi lama
        $table->string('category')->nullable();
        $table->string('tags')->nullable();
        $table->enum('status',['draft','review','published'])->default('draft');
        $table->foreignId('edited_by')->constrained('users');
        $table->timestamp('edited_at');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wiki_versions');
    }
};
