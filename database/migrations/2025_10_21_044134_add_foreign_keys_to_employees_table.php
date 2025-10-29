<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            // Tambahkan hanya kolom jabatan_id
            $table->unsignedBigInteger('jabatan_id')->after('departemen_id');

            // Buat foreign key untuk jabatan_id
            $table->foreign('jabatan_id')
                ->references('id')
                ->on('positions')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['jabatan_id']);
            $table->dropColumn(['jabatan_id']);
        });
    }
};
