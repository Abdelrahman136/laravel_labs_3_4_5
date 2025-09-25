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
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('author');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('author')->after('content');
            $table->foreign('author')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Drop the foreign key and column
            $table->dropForeign(['author']);
            $table->dropColumn('author');
            // Add back the original string column
            $table->string('author', 255)->after('content');
        });
    }
};
