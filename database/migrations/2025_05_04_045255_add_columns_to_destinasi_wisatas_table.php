<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('destinasi_wisatas', function (Blueprint $table) {
        $table->string('nama')->after('id');
        $table->string('lokasi')->after('nama');
        $table->text('deskripsi')->after('lokasi');
        $table->decimal('harga_tiket')->after('deskripsi');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('destinasi_wisatas', function (Blueprint $table) {
            //
        });
    }
};
