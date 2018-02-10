CKEDITOR.replace('editor1');
CKEDITOR.instances.editor1.setData(template);


function replaceCK(){
    var str = template;
    str = str.replace(/\?nomor_surat\?/g, $("#stspd-nomor_st").val());
    str = str.replace(/\?maksud\?/g, $("#stspd-maksud").val());
    str = str.replace(/\?tanggal_terbit\?/g, $("#stspd-tanggal_terbit").val());

    str = str.replace(/\?kota\?/g, $("#stspd-kota_asal").val());
    str = str.replace(/\?nip\?/g, $("#stspd-nip").val());
    str = str.replace(/\?nama\?/g, $("#stspd-nip").find("option:selected").text());
    str = str.replace(/\?kota_asal\?/g, $("#stspd-kota_asal").val());
    str = str.replace(/\?kota_tujuan\?/g, $("#stspd-kota_tujuan").val());
    str = str.replace(/\?tujuan\?/g, $("#stspd-kota_tujuan").val());
    str = str.replace(/\?tanggal_pergi\?/g, $("#stspd-tanggal_pergi").val());
    str = str.replace(/\?tanggal_kembali\?/g, $("#stspd-tanggal_kembali").val());
    str = str.replace(/\?tingkat\?/g, $("#stspd-tingkat_perjalanan_dinas").val());
    str = str.replace(/\?kendaraan\?/g, $("#stspd-id_kendaraan").val());
    str = str.replace(/\?program\?/g, $("#stspd-kode_program").val());
    str = str.replace(/\?kegiatan\?/g, $("#stspd-kode_kegiatan").val());
    str = str.replace(/\?output\?/g, $("#stspd-kode_output").val());
    str = str.replace(/\?komponen\?/g, $("#stspd-kode_komponen").val());
    str = str.replace(/\?akun\?/g, $("#stspd-id_akun").val());
    str = str.replace(/\?instansi\?/g, instansi);
    str = str.replace(/\?y_instansi\?/g, instansi);
    str = str.replace(/\?pangkat\?/g, pangkat);
    str = str.replace(/\?jabatan\?/g, jabatan);

    str = str.replace(/\?nip_ppk\?/g, $("#stspd-nip_ppk").val());
    str = str.replace(/\?nama_ppk\?/g, $("#stspd-nip_ppk").find("option:selected").text());
    str = str.replace(/\?nip_kepala\?/g, $("#stspd-nip_kepala").val());
    str = str.replace(/\?nama_kepala\?/g, $("#stspd-nip_kepala").find("option:selected").text());


    CKEDITOR.instances.editor1.setData(str);
}

$(document).ready(function () {
    replaceCK();
    $("#stspd-nomor_st").change(function () {
        replaceCK();
    });
    $("#stspd-maksud").change(function () {
        replaceCK();
    });
    $("#stspd-tanggal_terbit").change(function () {
        replaceCK();
    });
    $("#stspd-nip").change(function () {
        var value = $(this).val();
        console.log(value);
        $.ajax({
            url: link,
            data: {value: value},
            type: "POST",
            success: function(data) {
                var parsedData = JSON.parse(data);
                pangkat = parsedData['pangkat'];
                jabatan = parsedData['jabatan'];
                replaceCK();
            }
        });
        
    });
    $("#stspd-kota_asal").change(function () {
        replaceCK();
    });

    $("#stspd-kota_tujuan").change(function () {
        replaceCK();
    });
    $("#stspd-tanggal_pergi").change(function () {
        replaceCK();
    });
    $("#stspd-tanggal_kembali").change(function () {
        replaceCK();
    });
    $("#stspd-tingkat_perjalanan_dinas").change(function () {
        replaceCK();
    });
    $("#stspd-id_kendaraan").change(function () {
        replaceCK();
    });
    $("#stspd-kode_program").change(function () {
        replaceCK();
    });
    $("#stspd-kode_kegiatan").change(function () {
        replaceCK();
    });
    $("#stspd-kode_output").change(function () {
        replaceCK();
    });
    $("#stspd-kode_komponen").change(function () {
        replaceCK();
    });

});
