<?php

use app\models\FlagKepala;
use app\models\Instansi;
use app\models\FlagPpk;
use app\models\FlagBendahara;

/* @var $this yii\web\View */

$this->title = 'FAQ';

?>
<!-- OVERVIEW -->
<div class="panel panel-headline">
    <div class="panel-heading">
        <h3 class="panel-title">FAQ</h3>
        <hr/>
        <!-- <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p> -->
    </div>
    <div class="panel-body">
        <strong>Q: Apa tujuan SPD Online?</strong>
        <p>A: SPD Online bertujuan untuk mempermudah pembuatan surat tugas & spd serta kwitansi pembayaran perjalanan dinas.
        Dengan adanya SPD Online atasan juga dapat melihat rekapitulasi siapa saja yang sering/jarang melakukan perjalanan dinas 
        sebagai bahan evaluasi.</p><br/>

        <strong>Q: Apa saja feature-feature SPD Online?</strong>
        <p>A: (1) Pembuatan surat tugas, spd, dan kwitansi. (2) Rekapitulasi perjalanan dinas bulanan dan tahunan. (3)
        Rule validasi untuk mencegah surat tugas dengan nomor yang sama, mencegah pegawai dengan jadwal surat tugas yang berbenturan. 
        (4) Isian kode program, kegiatan, output, komponen sesuai dengan database POK aplikasi RKAKL.</p><br/>

        <strong>Q: Apa saja perbedaan SPD Online saat ini dengan versi sebelumnya?</strong>
        <p>A: (1) Perubahan nomor surat tugas/spd dari yang otomatis menjadi manual tetapi nomor tersebut diberi rule harus unique. 
        (2) Penambahan format surat tugas biasa & surat tugas dengan anggota. (3) Penambahana format kwitansi dalam dan luar kota.
        (4) Menghilangkan lampiran visum. (5) Database POK langsung dari import database RKAKL (6) Perubahan format surat tugas hasil 
        generate dari pdf ke docx agar bisa diedit jika ada kesalahan</p><br/>

        <strong>Q: Surat tugas & SPD yang sudah dibuat tidak bisa dihapus?</strong>
        <p>A: Surat tugas & SPD sengaja dibuat tidak bisa dihapus jika masih ada kwitansi dari surat tugas tersebut yang belum dihapus. 
        cara menghapusnya adalah dengan terlebih dahulu menghapus kwitansi kemudian dilanjutkan dengan menghapus surat tugas & spd.</p><br/>

        <strong>Q: Mengapa tidak ada pilihan kepala, ppk, dan bendahara saat pembuatan surat tugas (status home undefined)?</strong>
        <p>A: Pilih menu pegawai > edit kepala, bendahara, dan ppk saat penggunaan SPD Online pertama kali.</p><br/>

        <strong>Q: Bagaimana cara melaporkan bug / request feature untuk SPD Online??</strong>
        <p>A: Bisa menghubungi langsung tim IPDS provinsi sulawesi tenggara via telpon/whatsapp</p><br/>

    </div>
</div>
<!-- END OVERVIEW -->