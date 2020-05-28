<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

class CreateSkemaFrPaap01Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frpaap01', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('skema_id')->unsigned();
            $table->foreign('skema_id')->references('id')->on('skema')->onUpdate('cascade')->onDelete('cascade');

            $table->enum('asesi', ['Hasil pelatihan dan / atau pendidikan', 'Pekerja berpengalaman', 'Pelatihan / belajar mandiri']);
            $table->enum('tujuan_asesmen', ['Sertifikasi', 'RCC', 'RPL', 'Hasil pelatihan / proses pembelajaran', 'Lainnya']);
            $table->enum('konteks_asesmen_lingkungan', ['Tempat kerja nyata', 'Tempat kerja simulasi']);
            $table->enum('konteks_asesmen_peluang_mengumpulan_bukti', ['Tersedia', 'Terbatas']);
            $table->enum('konteks_asesmen_hubungan_standar_kompetensi', ['Bukti untuk mendukung asesmen / RPL', 'Aktivitas kerja di tempat kerja kandidat', 'Kegiatan Pembelajaran']);
            $table->enum('konteks_asesmen_pelaku_asesmen', ['Lembaga Sertifikasi', 'Organisasi Pelatihan', 'Asesor Perusahaan']);
            $table->enum('relevan_dikonfirmasi', ['Manajer sertifikasi LSP', 'Master Assessor / Master Trainer / Asesor Utama kompetensi', 'Manajer pelatihan Lembaga Training terakreditasi / Lembaga Training terdaftar', 'Lainnya']);
            $table->enum('tolak_ukur', ['Standar kompetensi', 'Kriteria asesmen dari kurikulum pelatihan', 'Spesifikasi kinerja suatu perusahaan atau industri', 'Spesifikasi produk', 'Pedoman khusus']);
            $table->json('rencana_asesmen')->default(new Expression('(JSON_ARRAY())'));
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
        Schema::dropIfExists('frpaap01');
    }
}
