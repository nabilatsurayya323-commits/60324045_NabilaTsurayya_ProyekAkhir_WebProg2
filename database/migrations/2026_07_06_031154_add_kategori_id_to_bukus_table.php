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
        Schema::table('buku', function (Blueprint $table) {
            // 1. Hapus kolom enum 'kategori' lama agar tidak membingungkan
            $table->dropColumn('kategori');

            // 2. Tambahkan foreign key baru yang mengarah ke tabel 'kategori' (tanpa s)
            $table->foreignId('kategori_id')
                  ->nullable()
                  ->after('id')
                  ->constrained('kategori') 
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('buku', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
            $table->dropColumn('kategori_id');
            
            // Kembalikan kolom enum jika di-rollback (opsional)
            $table->enum('kategori', ['Programming', 'Database', 'Web Design', 'Networking', 'Data Science'])->nullable();
        });
    }
};