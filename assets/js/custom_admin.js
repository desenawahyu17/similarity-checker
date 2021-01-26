$(document).ready(function() {
    // INISIALISASI OBJEK
    var date    = new Date();

    // AKTIFKAN KOMPONEN MATERIALIZE
    $('.sidenav').sidenav();
    $('.dropdown-trigger').dropdown();
    $('.modal').modal();
    $('select').formSelect();
    $('.fixed-action-btn').floatingActionButton();
    $('.tabs').tabs();
    $('.datepickerAll').datepicker({
        format: 'yyyy-mm-dd'
    });
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        maxDate: new Date(date.getFullYear(),date.getMonth(),date.getDate())
    });
    $('.datepickerIzin').datepicker({
        format: 'yyyy-mm-dd',
        minDate: new Date(date.getFullYear(),date.getMonth(),date.getDate())
    });
    $('.datepickerCetak').datepicker({
        container: 'body',
        format: 'yyyy-mm-dd',
        maxDate: new Date(date.getFullYear(),date.getMonth(),date.getDate())
    });
    $('.timepicker').timepicker({
        twelveHour: false
    });

    // DETIK DI PRESENSI
    displayTime();
    setInterval('displayTime()', 1000);

    validateToken();

    // VALIDASI JWT
    function validateToken() {

        // WAKTU HARI INI, FORMAT (TAHUN-BULAN-HARI)
        var now     = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();

        // GET JWT DARI CACHE
        var jwt     = getCookie('jwt');

        var token   = JSON.stringify({jwt:jwt});

        // CEK VALID/TIDAKNYA JWT
        $.ajax({
            url         : "../api/validate_token.php",
            type        : "POST",
            contentType : 'application/json',
            data        : token,
            success     : function(result) {
                if(result.success == 1) {

                    if(result.data.jabatan == "Supervisor") {

                        $('.userName').html(result.data.nama);
                        $('.userNIM').html(result.data.nim);
                        retrieveAllAsisten();
                        retrieveAllPresensi(now);
                        retrieveAllIzin(now);
                        getCmbAsisten();
                        $("#allContent").css("display", "unset");
                    }
                    else {
                        swal ( "Akses ditolak." , "Silahkan Masuk untuk Melanjutkan." ,  "warning" , {
                            buttons: false,
                            closeOnClickOutside: false,
                            timer: 2000,
                        })
                        .then(function() {
                            location.href = "http://localhost/Presensi/";
                        });
                    }
                }
                else {
                    swal ( result.message , "Silahkan Masuk untuk Melanjutkan." ,  "warning" , {
                        buttons: false,
                        closeOnClickOutside: false,
                        timer: 2000,
                    })
                    .then(function() {
                        location.href = "http://localhost/Presensi/";
                    });
                }
            },
            error       : function() {
                swal ( data.message , "Silahkan Masuk untuk Melanjutkan." ,  "warning" , {
                    buttons: false,
                    closeOnClickOutside: false,
                    timer: 2000,
                })
                .then(function() {
                    location.href = "http://localhost/Presensi/";
                });
            }
        });
    }

    // get or read cookie
    function getCookie(cname) {

        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' '){
                c = c.substring(1);
            }

            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    // function to make form values to json format
    $.fn.serializeObject = function(){
    
        var o = {};
        var a = this.serializeArray();
        $.each(a, function() {
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };

    function getCmbAsisten() {
        $.ajax({
            url         : "proses/retrieve_userAktif.php",
            success     : function(result) {
                var data = jQuery.parseJSON(result);
                var cmbContent = "<option value='' disabled selected>Pilih Asisten</option>";

                $.each(data.data, function () {

                    cmbContent += `
                        <option value="`+this.nim+`">`+this.nim+` - `+this.nama+`</option>
                    `;
                });

                $("#cmbAsisten").html(cmbContent);
                $('select').formSelect();

            },
            error       : function() {
                location.href = "http://localhost/Presensi/pages/index.php?hal=beranda";
            }
        });
    }
});

// FUNGSI MENAMPILKAN DETIK SAAT ENTRY PRESENSI BARU
function displayTime() {
    var time = new Date();
    var sh = time.getHours() + "";
    var sm = time.getMinutes() + "";
    var ss = time.getSeconds() + "";

    var second   = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
    $("#clock").html(second);
}

// FUNGSI TAMPIL SELURUH DATA ASISTEN
function retrieveAllAsisten() {
    // SELECT DATA DARI DB
    $.ajax({
        url         : "proses/retrieve_user.php",
        success     : function(result) {
            var data = jQuery.parseJSON(result);
            var tableContent = "";
            var number = 1;

            $.each(data.data, function () {
                if(this.status == "Aktif") {
                    tableContent += `
                        <tr>
                            <td>`+number+`</td>
                            <td>`+this.nim+`</td>
                            <td>`+this.nama+`</td>
                            <td>`+this.jurusan+`</td>
                            <td>`+this.jabatan+`</td>
                            <td>
                                <button data-target="modalDetail" onclick="getDataAsisten('`+this.nim+`')" class="modal-trigger waves-effect waves-light btn info hoverable"><i class="material-icons center">assignment_ind</i></button>
                                <button data-target="modalUpdate" onclick="getDataAsisten('`+this.nim+`')" class="modal-trigger waves-effect waves-light btn orange hoverable"><i class="material-icons center">edit</i></button>
                                <button data-target="modalDelete" onclick="getDataAsisten('`+this.nim+`')" class="modal-trigger waves-effect waves-light btn red hoverable"><i class="material-icons center">delete</i></button>
                            </td>
                        </tr>
                    `;
                } else {
                    tableContent += `
                        <tr class="grey-text">
                            <td>`+number+`</td>
                            <td>`+this.nim+`</td>
                            <td>`+this.nama+`</td>
                            <td>`+this.jurusan+`</td>
                            <td>`+this.jabatan+`</td>
                            <td>
                                <button data-target="modalDetail" onclick="getDataAsisten('`+this.nim+`')" class="modal-trigger waves-effect waves-light btn info hoverable"><i class="material-icons center">assignment_ind</i></button>
                                <button data-target="modalUpdate" onclick="getDataAsisten('`+this.nim+`')" class="modal-trigger waves-effect waves-light btn orange hoverable"><i class="material-icons center">edit</i></button>
                                <button data-target="modalDelete" onclick="getDataAsisten('`+this.nim+`')" class="modal-trigger waves-effect waves-light btn red hoverable"><i class="material-icons center">delete</i></button>
                            </td>
                        </tr>
                    `;
                }

                number++;
            });

            if(number == 1) {
                tableContent += `<tr>
                                    <td colspan='6' class='p-3 cPointer'><h5>Data Asisten Kosong<br><small>Jadilah yang pertama!</small></h5></td>
                                </tr>`;
            }

            $("#listDataAsisten").html(tableContent);
        },
        error       : function() {
            location.href = "http://localhost/Presensi/pages/index.php?hal=beranda";
        }
    });
}

// FUNGSI UNTUK EDIT DATA BERDASARKAN NIM
function getDataAsisten(id) {

    $.ajax({
        url         : "proses/getData_user.php",
        type        : "POST",
        data        : id,
        success     : function(result) {
            var data = jQuery.parseJSON(result);
            
            $("#get_nim").html(data.nim);
            $("#get_nama").html(data.nama);
            $("#get_status").html(data.status);
            $("#get_fakultas").html(data.fakultas);
            $("#get_jurusan").html(data.jurusan);
            $("#get_jenis_kelamin").html(data.jenis_kelamin);
            $("#get_surel").html(data.surel);
            $("#get_no_telp").html(data.no_telp);
            $("#get_jabatan").html(data.jabatan);
            $("#get_imei").html(data.imei);

            if(data.status == "Aktif") {
                $('#btnUbahStatus').attr("onclick","ubahStatusAsisten('"+data.nim+"')");
                $('#btnUbahStatus').html("Non-Aktifkan");
            }
            else {
                $('#btnUbahStatus').attr("onclick","ubahStatusAsisten('"+data.nim+"')");
                $('#btnUbahStatus').html("Aktifkan");
            }

            $("#nim").val(data.nim);
            $("#nama").val(data.nama);
            $("#fakultas").val(data.fakultas);
            $("#jurusan").val(data.jurusan);
            $("#surel").val(data.surel);
            $("#no_telp").val(data.no_telp);
            $("#imei").val(data.imei);
            

            $("#btnHapus").attr("onclick","deletebyNIM('"+data.nim+"')");
            $("#get_nimHapus").html(data.nim);
            $("#get_namaHapus").html(data.nama);

            if(data.jenis_kelamin == "Laki-laki") {
                $("#Laki-laki").prop("checked",true);
            }
            else {
                $("#Perempuan").prop("checked",true);
            }
            
            if(data.jabatan == "Supervisor") {
                $("#Supervisor").prop("selected",true);
            }
            else {
                if(data.jabatan == "Asisten") {
                    $("#Asisten").prop("selected",true);
                }
                else {
                    $("#CALAS").prop("selected",true);
                }
            }

            // RE-INISIALISASI MATERIALIZE
            $('select').formSelect();
            M.updateTextFields();
        },
        error       : function() {
            location.href = "http://localhost/Presensi/pages/index.php?hal=beranda";
        }
    });

    return false;
}

// FUSNGSI UBAH STATUS ASISTEN (AKTIF - TIDAK AKTIF)
function ubahStatusAsisten(id) {

    $.ajax({
        url         : "proses/changeStatus_user.php",
        type        : "POST",
        data        : id,
        success     : function(x) {
            
            var data = JSON.parse(x);
            swal ( "Berhasil!" ,  data.message ,  "success" );
            $('.modal').modal('close');
            retrieveAllAsisten();
        },
        error       : function(x) {
            location.href = "http://localhost/Presensi/pages/index.php?hal=beranda";
        }
    });

    return false;
}


// FUNGSI UNTUK HAPUS DATA BERDASARKAN NIM
function deletebyNIM(id) {

    $.ajax({
        url         : "proses/delete_user.php",
        type        : "POST",
        data        : id,
        success     : function(x) {
            
            var data = JSON.parse(x);
            swal ( "Berhasil!" ,  data.message ,  "success" );
            $('.modal').modal('close');
            retrieveAllAsisten();
        },
        error       : function() {
            location.href = "http://localhost/Presensi/pages/index.php?hal=beranda";
        }
    });

    return false;
}

// KETIKA SUBMIT TAMBAH DATA ASISTEN
$(document).on('submit', '#registration_form', function(){
    // GET FORM DATA
    var registration_form   = $(this);
    var form_data           = JSON.stringify(registration_form.serializeObject());

    // KIRIM form_data DENGAN AJAX
    $.ajax({
        url         : "proses/create_user.php",
        type        : "POST",
        contentType : 'application/json',
        data        : form_data,
        success     : function(x) {
            
            var data = JSON.parse(x);
            swal ( "Berhasil!" ,  data.message ,  "success" )
            .then(function() {
                location.href = "http://localhost/Presensi/pages/index.php?hal=asisten";
            });
        },
        error       : function(x) {

            var data = JSON.parse(x.responseText);
            swal ( "Oops..." ,  data.message ,  "error" )
            .then(function() {

                $("#registration_form").trigger('reset');
                M.updateTextFields();
            });
        }
    });

    return false;
})

// KETIKA SUBMIT UBAH DATA ASISTEN
$(document).on('submit', '#update_form', function(){
    // GET FORM DATA
    var update_form    = $(this);
    var form_data       = JSON.stringify(update_form.serializeObject());

    // KIRIM form_data DENGAN AJAX
    $.ajax({
        url         : "proses/update_user.php",
        type        : "POST",
        contentType : 'application/json',
        data        : form_data,
        success     : function(x) {
            
            var data = JSON.parse(x);
            swal ( "Berhasil!" ,  data.message ,  "success" );
            $('.modal').modal('close');
            retrieveAllAsisten();
        },
        error       : function(x) {

            var data = JSON.parse(x.responseText);
            swal ( "Oops..." ,  data.message ,  "error" )
            .then(function() {

                $("#update_form").trigger('reset');
                $('.modal').modal('close');
                M.updateTextFields();
            });
        }
    });

    return false;
})

// FUNGSI TAMPIL SELURUH DATA PRESENSI BERDASARKAN TANGGAL
function retrieveAllPresensi(id) {
    // SELECT DATA DARI DB
    $.ajax({
        url         : "proses/retrieve_presence.php",
        type        : "POST",
        data        : id,
        success     : function(result) {
            var data = jQuery.parseJSON(result);
            var tableContent = "";
            var number  = 1;
            var tepat   = 0;
            var telat   = 0;
            var menitDatang = 0;
            var menitTelat  = 0;
            var splitwaktuDatang;

            $.each(data.data, function () {

                tableContent += `
                    <tr>
                        <td>`+number+`</td>
                        <td>`+this.nim+`</td>
                        <td>`+this.nama+`</td>
                `;

                if(this.waktu_datang > '08:00:00') {
                    tableContent += `<td class="red-text">`+this.waktu_datang+`</td>`;
                    telat   = telat + 1;
                }
                else {
                    tableContent += `<td class="green-text">`+this.waktu_datang+`</td>`;
                    tepat   = tepat + 1;
                }
                
                if(this.waktu_pulang != null) {
                    tableContent += `<td>`+this.waktu_pulang+`</td>`;
                }
                else {
                    tableContent += `<td>-</td>`;
                }

                if(this.waktu_datang > '08:00:00') {
                    
                    splitmenitDatang    = this.waktu_datang.split(":");
                    menitDatang         = (parseInt(splitmenitDatang[0]) * 60) + parseInt(splitmenitDatang[1]);
                    menitTelat          = parseInt(menitDatang) - (parseInt("08") * 60) + parseInt("00");

                    tableContent += `<td class="orange-text">`+menitTelat+` Menit</td>`;
                }
                else {
                    tableContent += `<td>-</td>`;
                }

                tableContent += `</tr>`;

                number++;
            });

            if(number == 1) {
                tableContent += `<tr>
                                    <td colspan='5' class='p-3 cPointer'><h5>Belum ada yang Hadir<br><small>Data hadir asisten masih kosong!</small></h5></td>
                                </tr>`;
            }
            
            var waktuDataPresensi = ubahFormatkeID(id);

            $("#waktuDataPresensi").html(waktuDataPresensi);
            $("#hadir").html((tepat+telat) +" Asisten");
            $("#tidakHadir").html((data.data2-(tepat+telat)) +" Asisten");
            $("#tepat").html(tepat+" Asisten");
            $("#telat").html(telat+" Asisten");
            $("#listDataPresensi").html(tableContent);
        },
        error       : function() {
            location.href = "http://localhost/Presensi/pages/index.php?hal=beranda";
        }
    });
}

// FUNGSI TAMPIL SELURUH DATA IZIN BERDASARKAN TANGGAL
function retrieveAllIzin(id) {
    // SELECT DATA DARI DB
    $.ajax({
        url         : "proses/retrieve_izin.php",
        type        : "POST",
        data        : id,
        success     : function(result) {
            var data = jQuery.parseJSON(result);
            var tableContent = "";
            var number  = 1;

            $.each(data.data, function () {

                tableContent += `
                    <tr>
                        <td>`+number+`</td>
                        <td>`+this.nim+`</td>
                        <td>`+this.nama+`</td>
                        <td>`+this.keterangan+`</td>
                    </tr>`;

                number++;
            });

            if(number == 1) {
                tableContent += `<tr>
                                    <td colspan='4' class='p-3 cPointer'><h5>Belum ada yang Izin<br><small>Data izin asisten masih kosong!</small></h5></td>
                                </tr>`;
            }
            
            var waktuDataIzin = ubahFormatkeID(id);

            $("#waktuDataIzin").html(waktuDataIzin);
            $("#izin").html(data.data2 +" Asisten");
            $("#listDataIzin").html(tableContent);
        },
        error       : function() {
            location.href = "http://localhost/Presensi/pages/index.php?hal=beranda";
        }
    });
}

// FUNGSI UBAH FORMAT WAKTU MENJADI FORMAT WAKTU INDONESIA
function ubahFormatkeID(id) {
    var waktuIndonesia = "";
    var tahun   = id.substr(0,4);
    var bulan   = "";
    var tanggal = id.substr(8,2);
    if(tanggal == "") {
        tanggal = "0"+id.substr(7,1);
    }

    switch(id.substr(5,2)) {
        case '01' : bulan = "Januari"; break;
        case '02' : bulan = "Februari"; break;
        case '03' : bulan = "Maret"; break;
        case '04' : bulan = "April"; break;
        case '05' : bulan = "Mei"; break;
        case '06' : bulan = "Juni"; break;
        case '07' : bulan = "Juli"; break;
        case '08' : bulan = "Agustus"; break;
        case '09' : bulan = "September"; break;
        case '10' : bulan = "Oktober"; break;
        case '11' : bulan = "November"; break;
        case '12' : bulan = "Desember"; break;

        default : bulan = "-";
    }

    if(bulan == "-") {
        switch(id.substr(5,1)) {
            case '1'  : bulan = "Januari"; break;
            case '2'  : bulan = "Februari"; break;
            case '3'  : bulan = "Maret"; break;
            case '4'  : bulan = "April"; break;
            case '5'  : bulan = "Mei"; break;
            case '6'  : bulan = "Juni"; break;
            case '7'  : bulan = "Juli"; break;
            case '8'  : bulan = "Agustus"; break;
            case '9'  : bulan = "September"; break;
            case '10' : bulan = "Oktober"; break;
            case '11' : bulan = "November"; break;
            case '12' : bulan = "Desember"; break;
        }
    }
    
    waktuIndonesia = tanggal+ " " +bulan+ " " +tahun;

    $("#waktuIndonesia").find('input').remove();
    $("#waktuIndonesia").append('<input class="valid black-text" value="'+waktuIndonesia+'" disabled required readonly>');

    return waktuIndonesia;
}

// FUNGSI GANTI WAKTU PRESENSI
$("#btnGantiWaktu").on('change', function() {
    var date = $("#btnGantiWaktu").val();
    retrieveAllPresensi(date);
    retrieveAllIzin(date);
})

// KETIKA SUBMIT TAMBAH DATA PRESENI
$(document).on('submit', '#presence_form', function(){
    // GET FORM DATA
    var presence_form       = $(this);
    var form_data           = JSON.stringify(presence_form.serializeObject());

    // KIRIM form_data DENGAN AJAX
    $.ajax({
        url         : "proses/presenceIn.php",
        type        : "POST",
        contentType : 'application/json',
        data        : form_data,
        success     : function(x) {
            
            var data = JSON.parse(x);
            swal ( "Berhasil!" ,  data.message ,  "success" )
            .then(function() {
                location.href = "http://localhost/Presensi/pages/index.php?hal=presensi";
            });
        },
        error       : function(x) {

            var data = JSON.parse(x.responseText);
            swal ( "Oops..." ,  data.message ,  "error" )
            .then(function() {

                $("#presence_form").trigger('reset');
                M.updateTextFields();
            });
        }
    });

    return false;
})

// KETIKA SUBMIT TAMBAH DATA IZIN
$(document).on('submit', '#izin_form', function(){
    // GET FORM DATA
    var izin_form       = $(this);
    var form_data       = JSON.stringify(izin_form.serializeObject());

    // KIRIM form_data DENGAN AJAX
    $.ajax({
        url         : "proses/izinIn.php",
        type        : "POST",
        contentType : 'application/json',
        data        : form_data,
        success     : function(x) {
            
            var data = JSON.parse(x);
            swal ( "Berhasil!" ,  data.message ,  "success" )
            .then(function() {
                location.href = "http://localhost/Presensi/pages/index.php?hal=izin";
            });
        },
        error       : function(x) {

            var data = JSON.parse(x.responseText);
            swal ( "Oops..." ,  data.message ,  "error" )
            .then(function() {

                $("#izin_form").trigger('reset');
                M.updateTextFields();
            });
        }
    });

    return false;
})

// KETIKA SUBMIT CETAK KE EXCEL
$(document).on('submit', '#cetakExcel_pdf', function(){
    // GET FORM DATA
    var cetakExcel_pdf  = $(this);
    var form_data       = JSON.stringify(cetakExcel_pdf.serializeObject());

    // KIRIM form_data DENGAN AJAX
    $.ajax({
        url         : "proses/viewCetak.php",
        type        : "POST",
        contentType : 'application/json',
        data        : form_data,
        success     : function() {
            
            location.href = "http://localhost/Presensi/pages/index.php?hal=laporan";
        },
        error       : function(x) {

            var data = JSON.parse(x.responseText);
            swal ( "Oops..." ,  data.message ,  "error" )
            .then(function() {
                
                $("#cetakExcel_pdf").trigger('reset');
                $('.modal').modal('close');
                M.updateTextFields();
            });
        }
    });

    return false;
})