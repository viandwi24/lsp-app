<?php

use App\Models\Jadwal;
use App\Models\Kategori;
use App\Models\Skema;
use App\Models\Tuk;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SkemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kategori::create([
            'nama' => "TKJ",
            "deskripsi" => "Teknik Komputer Jaringan"
        ]);
        Tuk::create([
            "nama" => "LAB 1 TKJ SMKN 1 MOJOKERTO",
            "alamat" => "SMKN 1 MOJOKERTO",
            "no_telp" => "123"
        ]);
        Jadwal::create([
            "nama" => "LSP KELAS 12 - 08-06-2020",
            "waktu_pelaksanaan" => Carbon::now(),
            "pengumuman" => "<p>tes</p>",
            "acara" => json_decode('[{"waktu":"13","kegiatan":"awe"}]')
        ]);
        $skema = Skema::create([
            "judul" => "KKNI level II pada Kompetensi Keahlian Teknik Komputer dan Jaringan\/Instalasi Jaringan Komputer Berbasis Kabel",
            "kode" => "5.7.1",
            "admin_id" => 1,
            "unit" => json_decode('[{"judul":"Mengumpulkan Kebutuhan Teknis Pengguna Yang Menggunakan  Jaringan","kode":"J.611000.001.01","jenis":"SKKNI","elemen":[{"elemen":"Melakukan survei teknis","kuk":[{"kuk":"Menggunakan Daftar kebutuhan yang telah\nditentukan.","rencana_asesmen":{"observasi":{"jenis_bukti":"L","metode":"CL"},"jawaban":{"jenis_bukti":"L","metode":"CL"}}},{"kuk":"Membutuhkan Informasi yang ditentukan.","rencana_asesmen":{"observasi":{"jenis_bukti":"L","metode":"CL"},"jawaban":{"jenis_bukti":"L","metode":"CL"}}},{"kuk":"Merancang dokumen survei teknis .","rencana_asesmen":{"observasi":{"jenis_bukti":"L","metode":"CL"},"jawaban":{"jenis_bukti":"L","metode":"CL"}}}]},{"elemen":"Membuat daftar kebutuhan teknis pengguna jaringan","kuk":[{"kuk":"Merpersiapkan Tabel untuk merangkum hasil\nsurvei teknis .","rencana_asesmen":{"observasi":{"jenis_bukti":"L","metode":"CL"},"jawaban":{"jenis_bukti":"L","metode":"CL"}}},{"kuk":"Membuat kebutuhan teknis pengguna yang\nmenggunakan jaringan.","rencana_asesmen":{"observasi":{"jenis_bukti":"L","metode":"CL"},"jawaban":{"jenis_bukti":"L","metode":"CL"}}},{"kuk":"Membuat daftar jumlah kebutuhan pengguna .","rencana_asesmen":{"observasi":{"jenis_bukti":"L","metode":"CL"},"jawaban":{"jenis_bukti":"L","metode":"CL"}}}]}]},{"judul":"Mengumpulkan Data Peraiatan Jaringan Dengan Teknologi yang  Sesuai","kode":"J.611000.002.01","jenis":"SKKNI","elemen":[{"elemen":"Membuat daftar teknologi dan perangkat jaringan  saat ini (existing)","kuk":[{"kuk":"Menyusun daftar teknologi yang saat ini dipakai.","rencana_asesmen":{"observasi":{"jenis_bukti":"L","metode":"CL"},"jawaban":{"jenis_bukti":"L","metode":"CL"}}},{"kuk":"Menyusun daftar perangkat jaringan yang ada beserta\nkinerjanya","rencana_asesmen":{"observasi":{"jenis_bukti":"L","metode":"CL"},"jawaban":{"jenis_bukti":"L","metode":"CL"}}}]},{"elemen":"Membuat daftar teknologi yang dapat memperbaiki  kinerja jaringan","kuk":[{"kuk":"Merangkum perkembangan yang ada dari semua\nteknologi yang dipakai","rencana_asesmen":{"observasi":{"jenis_bukti":"L","metode":"CL"},"jawaban":{"jenis_bukti":"L","metode":"CL"}}},{"kuk":"Menentukan teknologi yang berpotensi meningkatkan\nkinerja jaringan","rencana_asesmen":{"observasi":{"jenis_bukti":"L","metode":"CL"},"jawaban":{"jenis_bukti":"L","metode":"CL"}}}]}]},{"judul":"Menyiapkan Kabel Jaringan","kode":"J.611000.008.01","jenis":"SKKNI","elemen":[{"elemen":"Mempersiapkan peralatan dan bahan yang  diperlukan.","kuk":[{"kuk":"Mengidentifikasi spesifikasi jaringan","rencana_asesmen":{"observasi":{"jenis_bukti":"L","metode":"CL"},"jawaban":{"jenis_bukti":"L","metode":"CL"}}},{"kuk":"Menyiapkan Bahan-bahan yang diperlukan sesuai\nspesifikasi.","rencana_asesmen":{"observasi":{"jenis_bukti":"L","metode":"CL"},"jawaban":{"jenis_bukti":"L","metode":"CL"}}},{"kuk":"Menyiapkan Peralatan yang sesuai.","rencana_asesmen":{"observasi":{"jenis_bukti":"L","metode":"CL"},"jawaban":{"jenis_bukti":"L","metode":"CL"}}},{"kuk":"Menyiapkan Alat ukur untuk pengujian.","rencana_asesmen":{"observasi":{"jenis_bukti":"L","metode":"CL"},"jawaban":{"jenis_bukti":"L","metode":"CL"}}}]},{"elemen":"Memasang konektor pada kabel jaringan Kriteria Unjuk Kerja","kuk":[{"kuk":"Memotong Kabel sesuai keperluan dengan\nmempertimbangkan standar batasan panjang maksimum\nkabel.","rencana_asesmen":{"observasi":{"jenis_bukti":"L","metode":"CL"},"jawaban":{"jenis_bukti":"L","metode":"CL"}}},{"kuk":"Mengupas Kabel sesuai dengan ukuran konektor.","rencana_asesmen":{"observasi":{"jenis_bukti":"L","metode":"CL"},"jawaban":{"jenis_bukti":"L","metode":"CL"}}},{"kuk":"Memasang Konektor pada kabel sesuai dengan standar\nurutan warna.","rencana_asesmen":{"observasi":{"jenis_bukti":"L","metode":"CL"},"jawaban":{"jenis_bukti":"L","metode":"CL"}}},{"kuk":"Memastikan Urutan warna kabel (jika ada warna) sudah\nsesuai standar.","rencana_asesmen":{"observasi":{"jenis_bukti":"L","metode":"CL"},"jawaban":{"jenis_bukti":"L","metode":"CL"}}},{"kuk":"Memasang Bagian kabel ke dalam konektor.","rencana_asesmen":{"observasi":{"jenis_bukti":"L","metode":"CL"},"jawaban":{"jenis_bukti":"L","metode":"CL"}}}]},{"elemen":"Menguji koneksi kabel Kriteria Unjuk Kerja:","kuk":[{"kuk":"Menguji Konektivitas antar pin pada kedua konektor yang\nberada di ujung kabel dengan menggunakan alat ukur.","rencana_asesmen":{"observasi":{"jenis_bukti":"L","metode":"CL"},"jawaban":{"jenis_bukti":"L","metode":"CL"}}},{"kuk":"Menguji Hubungan antar perangkat jaringan untuk\nmemastikan konektivitas pada jaringan.","rencana_asesmen":{"observasi":{"jenis_bukti":"L","metode":"CL"},"jawaban":{"jenis_bukti":"L","metode":"CL"}}}]}]},{"judul":"Memasang Kabel Jaringan","kode":"J.611000.009.01","jenis":"SKKNI","elemen":[{"elemen":"Merencanakan pengkabelan horizontal Kriteria Unjuk Kerja","kuk":[{"kuk":"Menyiapkan Prosedur instalasi jaringan yang aman baik\ndari segi elektris maupun konstruksi.","rencana_asesmen":{"observasi":{"jenis_bukti":"L","metode":"CL"},"jawaban":{"jenis_bukti":"L","metode":"CL"}}},{"kuk":"Membuat Diagram jalur perkabelan Menentukan Jadwal\ndan urutan penyelesaian pekerjaan","rencana_asesmen":{"observasi":{"jenis_bukti":"L","metode":"CL"},"jawaban":{"jenis_bukti":"L","metode":"CL"}}}]},{"elemen":"Menginstalasi pengkabelan horizontal Kriteria Unjuk Kerja","kuk":[{"kuk":"Memasang Soket RJ-45 pada dinding di wiring closet.","rencana_asesmen":{"observasi":{"jenis_bukti":"L","metode":"CL"},"jawaban":{"jenis_bukti":"L","metode":"CL"}}},{"kuk":"Memasang Perangkat dalam wiring closet","rencana_asesmen":{"observasi":{"jenis_bukti":"L","metode":"CL"},"jawaban":{"jenis_bukti":"L","metode":"CL"}}},{"kuk":"Memasang Terminal utama (main distribution frame) atau\nterminal cabang (intermediatedistribution frame) jika\ndiperlukan.","rencana_asesmen":{"observasi":{"jenis_bukti":"L","metode":"CL"},"jawaban":{"jenis_bukti":"L","metode":"CL"}}},{"kuk":"Menyiapkan Jalur kabel","rencana_asesmen":{"observasi":{"jenis_bukti":"L","metode":"CL"},"jawaban":{"jenis_bukti":"L","metode":"CL"}}},{"kuk":"Melakukan Pelabelan kabel dengan benar.","rencana_asesmen":{"observasi":{"jenis_bukti":"L","metode":"CL"},"jawaban":{"jenis_bukti":"L","metode":"CL"}}}]},{"elemen":"Membuat dokumentasi pengkabelan terstruktur horizontal","kuk":[{"kuk":"Menggambarkan Topologi fisik jaringan.","rencana_asesmen":{"observasi":{"jenis_bukti":"L","metode":"CL"},"jawaban":{"jenis_bukti":"L","metode":"CL"}}},{"kuk":"Menggambarkan Topologi logis jaringan.","rencana_asesmen":{"observasi":{"jenis_bukti":"L","metode":"CL"},"jawaban":{"jenis_bukti":"L","metode":"CL"}}},{"kuk":"Mencatat Outlet dan jalur kabel.","rencana_asesmen":{"observasi":{"jenis_bukti":"L","metode":"CL"},"jawaban":{"jenis_bukti":"L","metode":"CL"}}},{"kuk":"Mendokumentasikan Perangkat, MAC address dan IP\naddress.","rencana_asesmen":{"observasi":{"jenis_bukti":"L","metode":"CL"},"jawaban":{"jenis_bukti":"L","metode":"CL"}}}]}]}]'),
            "berkas" => json_decode('[{"jenis":"syarat","tipe":"ditentukan","nama":"Rapot Semester 1 - 5","format":["pdf"]},{"jenis":"syarat","tipe":"ditentukan","nama":"KTP","format":["pdf"]},{"jenis":"syarat","tipe":"ditentukan","nama":"Sertifikat PKL","format":["pdf"]}]')
        ]);
        $skema->kategori()->attach(1);
        $skema->frpaap01()->create([
            'asesi' => 'Hasil pelatihan dan / atau pendidikan',
            'tujuan_asesmen' => 'Sertifikasi',
            'konteks_asesmen_lingkungan' => 'Tempat kerja nyata',
            'konteks_asesmen_peluang_mengumpulan_bukti' => 'Tersedia',
            'konteks_asesmen_hubungan_standar_kompetensi' => 'Bukti untuk mendukung asesmen / RPL',
            'konteks_asesmen_pelaku_asesmen' => 'Lembaga Sertifikasi',
            'relevan_dikonfirmasi' => 'Manajer sertifikasi LSP',
            'tolak_ukur' => 'Standar kompetensi',
        ]);
        $skema->frmak01()->create([]);
        $skema->fraiae01()->create([]);
        $skema->fraiae03()->create([]);
    }
}
