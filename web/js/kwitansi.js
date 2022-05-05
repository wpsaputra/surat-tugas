CKEDITOR.replace('editor1',{
    on: {
        instanceReady: function( evt ) {
            // your stuff 
            if($("#kwitansi-id_st").val().length>0 && $("#kwitansi-nip").val().length>0){
                // if($("#kwitansi-id_st").val().length>0){
                ajaxRequest();
            }
        }
    }
});
CKEDITOR.instances.editor1.setData(template);
var x_hari = 0;
var tanggal_terbit = '';
var kota_asal = '';
var nama_bendahara = '';
var nip_bendahara = '';
var nama = '';
var nip = '';
var nama_ppk = '';
var nip_ppk = '';
var jabatan = '';
var id_instansi = '';



function replaceCK(){
    var str = template;
    // console.log(str);
    str = str.replace(/\$\{nomor_spd\}/g, $("#kwitansi-id_st").find("option:selected").text());
    str = str.replace(/\$\{uang_harian\}/g, $("#kwitansi-uang_harian").val());
    str = str.replace(/\$\{biaya_transportasi\}/g, $("#kwitansi-biaya_transportasi").val());
    str = str.replace(/\$\{biaya_penginapan\}/g, $("#kwitansi-biaya_penginapan").val());
    str = str.replace(/\$\{hari_inap_riil\}/g, $("#kwitansi-hari_inap_riil").val());
    str = str.replace(/\$\{biaya_inap_riil\}/g, $("#kwitansi-biaya_inap_riil").val());
    str = str.replace(/\$\{transport_riil\}/g, $("#kwitansi-transport_riil").val());
    str = str.replace(/\$\{taksi_riil\}/g, $("#kwitansi-taksi_riil").val());
    str = str.replace(/\$\{representasi_riil\}/g, $("#kwitansi-representasi_riil").val());
    str = str.replace(/\$\{tanggal_bayar\}/g, $("#kwitansi-tanggal_bayar").val());
    str = str.replace(/\$\{jumlah_hari\}/g, x_hari);

    var biaya_inap_riil_total = 0.3 * $("#kwitansi-hari_inap_riil").val() * $("#kwitansi-biaya_inap_riil").val();
    str = str.replace(/\$\{biaya_inap_riil_total\}/g, biaya_inap_riil_total);

    var representasi_riil_total = x_hari * $("#kwitansi-representasi_riil").val();
    str = str.replace(/\$\{representasi_riil_total\}/g, representasi_riil_total);

    var jumlah_riil = parseFloat(biaya_inap_riil_total) + parseFloat($("#kwitansi-transport_riil").val()) 
        + parseFloat($("#kwitansi-taksi_riil").val()) ;
    str = str.replace(/\$\{jumlah_riil\}/g, jumlah_riil);
    str = str.replace(/\$\{terbilang_jumlah_riil\}/g, jumlah_riil);

    var uang_harian_total = x_hari * $("#kwitansi-uang_harian").val();
    str = str.replace(/\$\{uang_harian_total\}/g, uang_harian_total);

    var jumlah_pdb = parseFloat(uang_harian_total) + parseFloat($("#kwitansi-biaya_transportasi").val()) 
        + parseFloat($("#kwitansi-biaya_penginapan").val()) + parseFloat(jumlah_riil) + parseFloat(representasi_riil_total);
    str = str.replace(/\$\{jumlah_pdb\}/g, jumlah_pdb);
    str = str.replace(/\$\{terbilang_jumlah_pdb\}/g, jumlah_pdb);

    str = str.replace(/\$\{tanggal_terbit\}/g, tanggal_terbit);
    str = str.replace(/\$\{kota_asal\}/g, kota_asal);
    str = str.replace(/\$\{nama_bendahara\}/g, nama_bendahara);
    str = str.replace(/\$\{nip_bendahara\}/g, nip_bendahara);
    str = str.replace(/\$\{nama\}/g, $("#kwitansi-nip").find("option:selected").text());
    str = str.replace(/\$\{nip\}/g, $("#kwitansi-nip").val());
    str = str.replace(/\$\{nama_ppk\}/g, nama_ppk);
    str = str.replace(/\$\{nip_ppk\}/g, nip_ppk);
    str = str.replace(/\$\{jabatan\}/g, jabatan);
    str = str.replace(/\$\{id_instansi\}/g, id_instansi);

    CKEDITOR.instances.editor1.setData(str);
}

function ajaxRequest(){
    var id_st = $("#kwitansi-id_st").val();
        var nip = $("#kwitansi-nip").val();
        $.ajax({
            url: link_multi,
            data: {id_st: id_st, nip: nip},
            type: "POST",
            success: function(data) {
                // x_hari = data + " Hari";
                var parsedData = JSON.parse(data);
                x_hari = parsedData['hari'];
                tanggal_terbit = parsedData['surat_tugas']['tanggal_terbit'];
                kota_asal = parsedData['surat_tugas']['kota_asal'];
                nama_bendahara = parsedData['bendahara']['nama'];
                nip_bendahara = parsedData['bendahara']['nip'];
                nama = parsedData['pegawai']['nama'];
                nip = parsedData['pegawai']['nip'];
                nama_ppk = parsedData['ppk']['nama'];
                nip_ppk = parsedData['ppk']['nip'];
                jabatan = parsedData['pegawai']['jabatan'];
                id_instansi = parsedData['surat_tugas']['id_instansi'];

                console.log(nip);

                replaceCK();
            }
        });
}


$(document).ready(function () {
    replaceCK();
    $("#kwitansi-id_st").change(function () {
        if($("#kwitansi-id_st").val().length>0 && $("#kwitansi-nip").val().length>0){
        // if($("#kwitansi-id_st").val().length>0){
            ajaxRequest();
        }
        replaceCK();
    });
    $("#kwitansi-nip").change(function () {
        if($("#kwitansi-nip").val().length>0 && $("#kwitansi-nip").val().length>0){
            ajaxRequest();
        }
        replaceCK();
    });

    $("#kwitansi-uang_harian").change(function () {
        replaceCK();
    });
    $("#kwitansi-biaya_transportasi").change(function () {
        replaceCK();
    });
    $("#kwitansi-biaya_penginapan").change(function () {
        replaceCK();
    });
    $("#kwitansi-hari_inap_riil").change(function () {
        replaceCK();
    });
    $("#kwitansi-biaya_inap_riil").change(function () {
        replaceCK();
    });
    $("#kwitansi-transportasi_riil").change(function () {
        replaceCK();
    });
    $("#kwitansi-taksi_riil").change(function () {
        replaceCK();
    });
    $("#kwitansi-representasi_riil").change(function () {
        replaceCK();
    });
    $("#kwitansi-tanggal_bayar").change(function () {
        replaceCK();
    });


});