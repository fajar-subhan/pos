$(document).ready(function () {
    // * datepicker 
    $("#tgl_awal,#tgl_akhir").datepicker({
        format: "mm/dd/yyyy",
        autoclose: true,
        todayHighlight: true

    });
    // * tabel #data dengan datatable
    $("#data").DataTable();
    // * jika menu sidebar di klik,hapus "semua" class "active" nya
    $(".nav-item").on("click", function () {
        $(".nav-item").removeClass("active");
    });

    // * function untuk membuat format tanggal indonesia
    function tanggalindo(tanggal) {
        var data = tanggal;
        var thn = data.substr(0, 4);
        var bln = data.substr(5, 2);
        var tgl = data.substr(8, 2);
        var tanggal = new Date(thn, bln, tgl);

        var bulanindo = [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Meil",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember"
        ];

        var gettgl = tanggal.getDate();
        var getbln = bulanindo[tanggal.getMonth() - 1];
        var getthn = tanggal.getFullYear();
        var tanggalindo = gettgl + " " + getbln + " " + getthn;
        return tanggalindo;
    }

    // * function untuk validasi data
    function validasi(error, selectorerror, selectorinput) {
        if (error !== "") {
            $(selectorerror).html(error);
            $(selectorerror).addClass("bg-danger text-white mt-1 p-1 font-weight-bold");
            $(selectorerror).css("border-radius", "6px");
            $(selectorinput).css("border", "3px solid #e74a3b");
        }
        else {
            $(selectorinput).css("border", "3px solid #1cc88a");
            $(selectorerror).html("");
            $(selectorerror).removeClass();
            $(selectorerror).removeAttr("style");
            $(selectorerror).removeAttr("class");
        }
    }

    // * function untuk hapus error isian form ketika di focus
    function hapusError(e) {
        e.target.style.border = "";
        e.target.parentElement.lastElementChild.className = "";
        e.target.parentElement.lastElementChild.innerHTML = "";
    }


    // ! =========== AWAL PEMBELIAN ==================
    // * function untuk hapus error isian harga jual dan harga beli ketika di focus
    function hapusError2(e) {
        e.target.offsetParent.style.border = "";
        e.target.offsetParent.nextElementSibling.innerHTML = "";
        e.target.offsetParent.nextElementSibling.className = "";
    }

    // * hapus pesan error
    $("#supplier").on("focus", hapusError);
    $("#qty").on("focus", hapusError);
    $("#kd_barang").on("focus", hapusError);
    $("#nama_barang").on("focus", hapusError);
    $("#harga_beli").on("focus", hapusError2);
    $("#harga_jual").on("focus", hapusError2);

    // * function untuk format harga 
    function formatharga(nilai) {
        // * ambil isi nilai dari parameter 'nilai' dan gantikan semua karakter selain angka
        var harga = nilai.toString().replace(/[^\d]/g, "");
        // * sisa hasil bagi,untuk menentukan isi dari awal pengambilan rupiah dan ribuan
        var sisa = harga.length % 3;
        // * ambil nilai awal rupiah yang diambil (substr) dari nomer index 0 sampai nomer = hasil dari sisa.
        var rupiah = harga.substr(0, sisa);
        // * ambil nilai ribuan yang di ambil dari (substr) nomer index hasil dari sisa.
        // * dan pecah menjadi array yang berisi 3 angka
        var ribuan = harga.substr(sisa).match(/\d{3}/g);
        // ? cek apakah data di dalam variable ribuan ada 
        if (ribuan) {
            // ? cek juga apakah data di dalam variable sisa ada,untuk mencegah terjadinya tanda titik berlebih
            if (sisa) {
                var titik = ".";
            }
            else {
                var titik = "";
            }
            // * gabungkan formatnya
            var format = rupiah + titik + ribuan.join(".");
        }


        return format;
    }

    // * rubah format harga jual
    $("#harga_jual").on("keyup", function () {
        // * ambil value dari harga jual
        var harga_jual = $("#harga_jual").val();
        // * masukan value harga jual sebagai parameter function
        var format = formatharga(harga_jual);
        if (format != undefined) {
            // * masukan hasil variable format ke dalam harga jual
            $(this).val(format);
        }


    });

    // * perkalian qty x harga beli
    $("#harga_beli,#qty").on("keyup", function () {
        // * rubah format data qty menjadi number
        var qty = Number($("#qty").val().trim());

        // * ambil value dari harga beli dan gantikan semua selain angka menjadi "" 
        var harga_beli_value = $("#harga_beli").val().replace(/[^\d]/g, "");

        // * kirimkan value kedalam function formatharga()
        var format = formatharga(harga_beli_value);

        if (format != undefined) {
            // * ambil hasil value dari variable format [object]
            var format_harga = $("#harga_beli").val(format);
            // * ambil hasil value dari form harga beli dan gantikan semua selain angka menjadi "" 
            var harga_beli = format_harga[0].value.replace(/[^\d]/g, "");
            // * rubah harga beli menjadi tipe data number
            var harga_beli_number = Number(harga_beli);
            // * kalikan qty * harga_beli
            var kali = qty * harga_beli_number;
            // * masukan kedalam total
            $("#total").val(formatharga(kali));
        }
    });

    // * jika tombol tambah pembelian data (+) di klik
    $("#tomboltambahdata").on("click", function () {
        // * ubah judul modalnya
        $("#judul_modal").html("Tambah Data");

        // * sembunyikan loading
        $("#loading").hide();
        $("#tambahpembelian").show();
        $("#form")[0].reset();
    });


    // * jika tombol tambah (didalam modal) di klik
    $("#tambahpembelian").on("click", function () {
        var supplier = $("#supplier").val().trim();
        var qty = $("#qty").val().trim();
        var kd_barang = $("#kd_barang").val().trim();
        var nama_barang = $("#nama_barang").val().trim();
        var harga_beli = $("#harga_beli").val().trim();
        var harga_jual = $("#harga_jual").val().trim();

        // * supplier
        // ? cek apakah supplier sudah di isi
        var supplierError = "";
        if (supplier === "") {
            supplierError = "<i class='fas fa-exclamation-circle'></i> supplier wajib di isi";
        }
        else if (supplier.length > 20) {
            supplierError = "<i class='fas fa-exclamation-circle'></i> maximal 20 karakter";
        }
        validasi(supplierError, "#supplier_Error", "#supplier");

        // * qty
        // ? cek apakah qty sudah di isi 
        var qtyError = "";
        if (qty === "") {
            qtyError = "<i class='fas fa-exclamation-circle'></i> qty wajib di isi";
        }
        // ? qty hanya di isi angka
        else if (/^\d{1,}$/.test(qty) === false) {
            qtyError = "<i class='fas fa-exclamation-circle'></i> hanya di isi angka";
        }
        validasi(qtyError, "#qty_Error", "#qty");

        // * kode barang
        // ? cek apakah kd_barang sudah di isi
        var kd_barangError = "";
        if (kd_barang === "") {
            kd_barangError += "<i class='fas fa-exclamation-circle'></i> kode barang wajib di isi";
        }
        else if (kd_barang.length > 8) {
            kd_barangError += "<i class='fas fa-exclamation-circle'></i> maximal 8 karakter";
        }
        validasi(kd_barangError, "#kd_barangError", "#kd_barang");

        // * nama barang
        // ? cek apakah nama sudah di isi
        var nama_barangError = "";
        if (nama_barang === "") {
            nama_barangError = "<i class='fas fa-exclamation-circle'></i> nama barang wajib di isi";
        }
        validasi(nama_barangError, "#nama_barangError", "#nama_barang");

        // * harga beli 
        // ? cek apakah harga beli sudah di isi 
        var harga_beliError = "";
        if (harga_beli === "") {
            harga_beliError = "<i class='fas fa-exclamation-circle'></i> harga beli wajib di isi";
        }
        // ? cek hanya di isi angka saja
        else if (/^[^A-Za-z]{1,}$/.test(harga_beli) === false) {
            harga_beliError = "<i class='fas fa-exclamation-circle'></i> hanya di isi angka";
        }

        validasi(harga_beliError, "#harga_beliError", "#beli");

        // * harga jual
        // ? cek apakah harga jual sudah di isi 
        var harga_jualError = "";
        if (harga_jual === "") {
            harga_jualError = "<i class='fas fa-exclamation-circle'></i> harga jual wajib di isi";
        }
        // ? cek hanya di isi angka saja
        else if (/^[^A-Za-z]{1,}$/.test(harga_jual) === false) {
            harga_jualError = "<i class='fas fa-exclamation-circle'></i> hanya di isi angka";
        }

        validasi(harga_jualError, "#harga_jualError", "#jual");

        // * jika form tidak ada error,kirim data lewat ajax
        if (supplierError === "" && qtyError === "" && kd_barangError === "" &&
            nama_barangError === "" && harga_beliError === "" && harga_jualError === "") {

            var data = $("#form").serialize();
            $.ajax({
                url: "pembelian/tambah_data",
                method: "post",
                dataType: "json",
                data: data,
                beforeSend: function () {
                    $("#loading").show();

                },
                success: function (data) {

                    if (data.status === "berhasil") {
                        $("#view").html("");
                        var no = 0;
                        var tabel = "";
                        tabel += '<table class="table table-bordered table-hover" id="data" style="width:100%;">';
                        tabel += '<thead class="small">';
                        tabel += '<tr>';
                        tabel += '<th class="text-center">No</th>';
                        tabel += '<th class="text-center">Kode</th>';
                        tabel += '<th class="text-center">Supplier</th>';
                        tabel += '<th class="text-center">Nama</th>';
                        tabel += '<th class="text-center">Beli</th>';
                        tabel += '<th class="text-center">Jual</th>';
                        tabel += '<th class="text-center">Total</th>';
                        tabel += '<th class="text-center">Qty</th>';
                        tabel += '<th class="text-center">Pengunggah</th>';
                        tabel += '</tr>';
                        tabel += '</thead>';
                        tabel += '<tbody class="small">';
                        $.each(data.data, function (index, value) {
                            no++;
                            tabel += '<tr>';
                            tabel += '<td class="text-center">' + no + '</td>';
                            tabel += '<td>' + value.kd_barang + '</td>';
                            tabel += '<td>' + value.supplier + '</td>';
                            tabel += '<td>' + value.nama_barang + '</td>';
                            tabel += '<td>Rp ' + value.harga_beli + '</td>';
                            tabel += '<td>Rp ' + value.harga_jual + '</td>';
                            tabel += '<td>Rp ' + formatharga(value.total_harga) + '</td>';
                            tabel += '<td class="text-center">' + value.qty + '</td>';
                            tabel += '<td class="text-center">' + value.uploader + ' | ' + tanggalindo(value.tanggal) + '</td > ';
                            tabel += '</tr>';
                        });
                        tabel += '</tbody>';
                        tabel += '</table>';

                        $("#loading").hide();

                        Swal.fire({
                            title: "Berhasil",
                            text: data.pesan,
                            type: "success"
                        });
                        $("#view").html(tabel);
                        $("#data").DataTable();
                        $("#form")[0].reset();

                        // * hapus border green
                        $("#supplier")[0].style.border = "";
                        $("#qty")[0].style.border = "";
                        $("#kd_barang")[0].style.border = "";
                        $("#nama_barang")[0].style.border = "";
                        $("#harga_beli")[0].style.border = "";
                        $("#harga_jual")[0].style.border = "";
                        $("#beli")[0].style.border = "";
                        $("#jual")[0].style.border = "";
                    }
                }
            });
        }
    });


    // * jika tombol tutup dan x di klik,maka reset semua form
    $("#tutup,#close").on("click", function () {
        // * reset all form
        $("#form")[0].reset();

        //  * hapus pesan error form
        function hapusErrorForm(selector) {
            $(selector)[0].nextElementSibling.className = "";
            $(selector)[0].nextElementSibling.innerHTML = "";
            $(selector)[0].style.border = "";
        }
        hapusErrorForm($("#supplier"));
        hapusErrorForm($("#qty"));
        hapusErrorForm($("#kd_barang"));
        hapusErrorForm($("#nama_barang"));
        hapusErrorForm($("#beli"));
        hapusErrorForm($("#jual"));
    });


    // ! ======================= AKHIR PEMBELIAN ===================


    // ! ======================= AWAL PENJUALAN ====================
    // * perkalian harga_jual * qtyjual
    $("#qtyjual").on("keyup", function () {
        // * rubah format data qty menjadi number
        var qty = Number($("#qtyjual").val().trim());

        // * ambil value dari harga jual dan gantikan semua selain angka menjadi "" 
        var harga_jual_value = $("#harga_jual").val().replace(/[^\d]/g, "");

        // * kirimkan value kedalam function formatharga()
        var format = formatharga(harga_jual_value);

        if (format != undefined) {
            // * ambil hasil value dari variable format [object]
            var format_harga = $("#harga_jual").val(format);
            // * ambil hasil value dari form harga jual dan gantikan semua selain angka menjadi "" 
            var harga_jual = format_harga[0].value.replace(/[^\d]/g, "");
            // * rubah harga beli menjadi tipe data number
            var harga_jual_number = Number(harga_jual);
            // * kalikan qty * harga_jual
            var kali = qty * harga_jual_number;
            // * masukan kedalam total
            $("#total").val(formatharga(kali));
        }
    });

    // * jika tombol tutup dan x di klik,maka reset semua form jual
    $("#tutupjual,#closejual").on("click", function () {
        // * reset all form
        $("#formjual")[0].reset();

        //  * hapus pesan error form
        function hapusErrorForm(selector) {
            $(selector)[0].nextElementSibling.className = "";
            $(selector)[0].nextElementSibling.innerHTML = "";
            $(selector)[0].style.border = "";
        }
        hapusErrorForm($("#pembeli"));
        hapusErrorForm($("#qtyjual"));
        hapusErrorForm($("#nama_barang"));
    });

    // * jika tombol tambah data penjualan di klik (+)
    $("#tomboltambahdatajual").on("click", function () {
        // * ubah judul modalnya
        $("#judul_modal").html("Tambah Data");

        // * sembunyikan loading dan tombol ubah 
        $("#loading").hide();
        $("#tambah").show();
        $("#formjual")[0].reset();
        $("#nama_barang").html("");

        // * tampilkan data nama barang di form nama barang
        $.ajax({
            url: "penjualan/namabarangall",
            method: "get",
            dataType: "json",
            success: function (data) {
                // * isian untuk nama barang
                var nama = "";
                nama += '<option value="">-- Pilih Nama Barang --</option>';
                $.each(data, function (index, value) {
                    nama += '<option value="' + value.nama_barang + '">' + value.nama_barang + '</option>';
                });

                $("#nama_barang").append(nama);
            }
        });
    });

    // * ketika nama barang di pilih / melakukan perubahan
    $("#nama_barang").on("change", function () {
        var nama_barang = $("#nama_barang").val().trim();
        $.ajax({
            url: "penjualan/data_by_nama",
            data: { nama_barang: nama_barang },
            dataType: "json",
            method: "post",
            success: function (data) {
                $("#kd_barangjual").val(data.kd_barang);
                $("#harga_jual").val(data.harga_jual);
            }
        });
    });

    // * jika tombol tambah didalam modal form penjualan di klik
    $("#tambahpenjualan").on("click", function () {
        var qty = $("#qtyjual").val().trim();
        var pembeli = $("#pembeli").val().trim();
        var nama_barang = $("#nama_barang").val().trim();

        // * pembeli
        // ? cek apakah pembeli sudah di isi
        var pembeliError = "";
        if (pembeli === "") {
            pembeliError = "<i class='fas fa-exclamation-circle'></i>  wajib di isi";
        }
        else if (pembeli.length > 20) {
            pembeliError = "<i class='fas fa-exclamation-circle'></i> maximal 20 karakter";
        }
        validasi(pembeliError, "#pembeli_Error", "#pembeli");

        // * hapus error 
        $("#pembeli").on("focus", hapusError);

        // * qty
        // ? cek apakah qty sudah di isi 
        var qtyError = "";
        if (qty === "") {
            qtyError = "<i class='fas fa-exclamation-circle'></i> qty wajib di isi";
        }
        // ? qty hanya di isi angka
        else if (/^\d{1,}$/.test(qty) === false) {
            qtyError = "<i class='fas fa-exclamation-circle'></i> hanya di isi angka";
        }
        validasi(qtyError, "#qty_Error", "#qtyjual");
        // * hapus error qty ketika di focus
        $("#qtyjual").on("focus", hapusError);

        // * nama barang 
        // ? cek apkah nama barang sudah di pilih 
        var nama_barangError = "";
        if (nama_barang === "") {
            nama_barangError = "<i class='fas fa-exclamation-circle'></i> pilih nama barang";
        }

        validasi(nama_barangError, "#nama_barangError", "#nama_barang");

        // * jika tidak ada pesan error 
        if (pembeliError === "" && nama_barangError === "" && qtyError === "") {
            var data = $("#formjual").serialize();
            $.ajax({
                url: "penjualan/tambah_data",
                method: "post",
                data: data,
                dataType: "json",
                beforeSend: function () {
                    $("#loading").show();
                },
                success: function (data) {
                    if (data.status === "berhasil") {
                        $("#loading").hide();
                        $("#view").html("");
                        var no = 0;
                        var tabel = "";
                        tabel += '<table class="table table-bordered table-hover" id="data" style="width:100%;">';
                        tabel += '<thead class="small">';
                        tabel += '<tr>';
                        tabel += '<th class="text-center">No</th>';
                        tabel += '<th class="text-center">Pembeli</th>';
                        tabel += '<th class="text-center">Nama Barang</th>';
                        tabel += '<th class="text-center">Jual</th>';
                        tabel += '<th class="text-center">Total</th>';
                        tabel += '<th class="text-center">Qty</td>';
                        tabel += '<th class="text-center">Pengunggah</th>'
                        tabel += '<th class="text-center"><i class="fas fa-print"></i></th>';
                        tabel += '</tr>';
                        tabel += '</thead>';

                        tabel += '<tbody class="small">';
                        $.each(data.data, function (index, value) {
                            no++;
                            tabel += '<tr>';
                            tabel += '<td class="text-center">' + no + '</td>';
                            tabel += '<td>' + value.nama_pembeli + '</td>';
                            tabel += '<td>' + value.nama_barang + '</td>';
                            tabel += '<td>Rp ' + value.harga_jual + '</td>';
                            tabel += '<td>Rp ' + formatharga(value.total_harga) + '</td>';
                            tabel += '<td class="text-center">' + value.qty + '</td>';
                            tabel += '<td class="text-center">' + value.uploader + ' | ' + tanggalindo(value.tanggal) + '</td>'
                            tabel += '<td class="text-center">';
        /* ubah URL => */   tabel += '<a href="http://lokasiserver/folderserver/penjualan/printpdf/' + value.no_trans + '">';
                            tabel += '<button type = "button" class="btn btn-primary btn-sm">';
                            tabel += '<i class="fas fa-download"></i>';
                            tabel += '</button></a>';
                            tabel += '</td>';
                            tabel += '</tr>';
                        });
                        tabel += '</tbody>';
                        tabel += '</table>';

                        Swal.fire({
                            title: "Berhasil",
                            text: data.pesan,
                            type: "success"
                        });
                        $("#view").html(tabel);
                        $("#data").DataTable();
                        $("#formjual")[0].reset();

                        $("#qtyjual")[0].style.border = "";
                        $("#nama_barang")[0].style.border = "";
                        $("#pembeli")[0].style.border = "";
                    }
                }
            });
        }
    });
    // ! ======================= AKHIR PENJUALAN ===================


    // ! ========================= AWAL LAPORAN ====================
    // * hapus pesan error 
    $("#tgl_awal").on("focus", hapusError2);
    $("#tgl_akhir").on("focus", hapusError2);

    // * jika tombol reset di klik,maka reset semua form tanggal
    $("#reset").on("click", function () {
        function hapusErrorForm(selector) {
            $(selector)[0].nextElementSibling.className = "";
            $(selector)[0].nextElementSibling.innerHTML = "";
            $(selector)[0].style.border = "";
        }
        hapusErrorForm("#tanggal_awal");
        hapusErrorForm("#tanggal_akhir");

    });


    // * jika form periode di submit
    $("#form").on("submit", function (e) {
        var tgl_awal = $("#tgl_awal").val().trim();
        var tgl_akhir = $("#tgl_akhir").val().trim();

        // ? cek apakah tanggal awal sudah di isi
        var tglawalError = "";
        if (tgl_awal === "") {
            tglawalError = "<i class='fas fa-exclamation-circle'></i> tanggal awal wajib di isi";
        }

        if (tglawalError !== "") {
            $("#tanggal_awalError").html(tglawalError);
            $("#tanggal_awalError").addClass("bg-danger text-white mt-1 p-1 font-weight-bold");
            $("#tanggal_awalError").css("border-radius", "6px");
            $("#tanggal_awal").css("border", "3px solid #e74a3b");
            e.preventDefault();
        }
        else {
            $("#tanggal_awal").css("border", "3px solid #1cc88a");
            $("#tanggal_awalError").html("");
            $("#tanggal_awalError").removeClass();
            $("#tanggal_awalError").removeAttr("style");
            $("#tanggal_awalError").removeAttr("class");
        }
        // ? cek apakah tanggal akhir sudah di isi
        var tglakhirError = "";
        if (tgl_akhir === "") {
            tglakhirError = "<i class='fas fa-exclamation-circle'></i> tanggal akhir wajib di isi";
        }
        if (tglakhirError !== "") {
            $("#tanggal_akhirError").html(tglakhirError);
            $("#tanggal_akhirError").addClass("bg-danger text-white mt-1 p-1 font-weight-bold");
            $("#tanggal_akhirError").css("border-radius", "6px");
            $("#tanggal_akhir").css("border", "3px solid #e74a3b");
            e.preventDefault();
        }
        else {
            $("#tanggal_akhir").css("border", "3px solid #1cc88a");
            $("#tanggal_akhirError").html("");
            $("#tanggal_akhirError").removeClass();
            $("#tanggal_akhirError").removeAttr("style");
            $("#tanggal_akhirError").removeAttr("class");
        }

    });

    // ! ========================= AKHIR LAPORAN ===================

    // ! ========================= AWAL PENGATURAN ==================
    // * function untuk tombol hapus
    function hapuspengaturan(selectorinput, selectorborder, selectorerror) {
        $(selectorinput).val("");
        $(selectorborder).removeAttr("style");
        $(selectorerror).removeAttr("class");
        $(selectorerror).html("");
    }

    // * PENGATURAN NAMA 
    // * jika ubah nama di klik
    $("#ubahnama").on("click", function () {
        var namabaru = $("#nama_baru").val().trim();

        // * jika nama baru kosong
        var ubahNamaError = "";
        if (namabaru === "") {
            ubahNamaError = "<i class='fas fa-exclamation-circle'></i> nama perusahaan baru wajib di isi";
        }

        validasi(ubahNamaError, "#nama_baruError", "#nama");

        $("#nama_baru").on("focus", hapusError2);

        if (ubahNamaError === "") {
            $("#loading").removeAttr("style");
            // * kirim data lewat ajax 
            var data = $("#formnama").serialize();
            $.ajax({
                url: "pengaturan_nama/ubah_nama",
                method: "post",
                dataType: "json",
                data: data,
                beforeSend: function () {
                    $("#loading").show();
                },
                success: function (data) {
                    if (data.status === "berhasil") {
                        $("#loading").hide();
                        $("#nama_lama").val(data.data.nama_perusahaan);

                        Swal.fire({
                            title: "Berhasil",
                            text: data.pesan,
                            type: "success"
                        });

                        $("#nama_baru").val("");
                        $("#nama").removeAttr("style");
                    }

                }
            });
        }

    });

    $("#resetnama").on("click", function () {
        hapuspengaturan("#nama_baru", "#nama", "#nama_baruError");
    });

    // * PENGATURAN ALAMAT
    // * jika ubah alamat di klik
    $("#ubahalamat").on("click", function () {
        var alamatbaru = $("#alamat_baru").val().trim();

        // * jika nama baru kosong
        var ubahAlamatError = "";
        if (alamatbaru === "") {
            ubahAlamatError = "<i class='fas fa-exclamation-circle'></i> alamat perusahaan baru wajib di isi";
        }

        validasi(ubahAlamatError, "#alamat_baruError", "#alamat");

        $("#alamat_baru").on("focus", hapusError2);

        if (ubahAlamatError === "") {
            $("#loading").removeAttr("style");
            // * kirim data lewat ajax 
            var data = $("#formalamat").serialize();
            $.ajax({
                url: "pengaturan_alamat/ubah_alamat",
                method: "post",
                dataType: "json",
                data: data,
                beforeSend: function () {
                    $("#loading").show();
                },
                success: function (data) {
                    if (data.status === "berhasil") {
                        $("#loading").hide();
                        $("#alamat_lama").val(data.data.alamat_perusahaan);

                        Swal.fire({
                            title: "Berhasil",
                            text: data.pesan,
                            type: "success"
                        });

                        $("#alamat_baru").val("");
                        $("#alamat").removeAttr("style");
                    }

                }
            });
        }

    });

    $("#resetnama").on("click", function () {
        hapuspengaturan("#nama_baru", "#nama", "#nama_baruError")
    });

    $("#resetalamat").on("click", function () {
        hapuspengaturan("#alamat_baru", "#alamat", "#alamat_baruError")
    });


    // ! ========================= AKHIR PENGATURAN ==================

    // ! ========================= AWAL DATA USER ====================
    // * AWAL TAMBAH USER ======
    // * jika tombol tambah user (user plus) di klik
    $("#tomboltambahuser").on("click", function () {
        // * ubah nama judul modal
        $("#judul_modal").html("Tambah User");
        // * sembunyikan loading dan tombol ubah
        $("#loading,#ubahdatauser").hide();
        $("#tambah").show();

        // * reset form
        $("#formdatauser")[0].reset();
        // * tampilkan form password dan ulang password 
        $("#pass,#ulang").show();

    });

    // * jika tombol tambah user di dalam  form modal di klik
    $("#tambah").on("click", function () {
        var nama = $("#nama_user").val().trim();
        var email = $("#email_user").val().trim();
        var jabatan = $("#jabatan_user").val().trim();
        var username = $("#username").val().trim();
        var password = $("#password").val().trim();
        var ulangpass = $("#ulangpass").val().trim();
        var tipeuser = $("#tipe_user").val().trim();

        // ? cek apakah nama sudah di isi
        var namaError = "";
        if (nama === "") {
            namaError = "<i class='fas fa-exclamation-circle'></i> nama wajib di isi";
        }
        validasi(namaError, "#nama_userError", "#nama_user");

        // ? cek apakah email sudah di isi 
        var emailError = "";
        if (email === "") {
            emailError = "<i class='fas fa-exclamation-circle'></i> email wajib di isi";
        }
        // ? cek apakah format email sudah sessuai
        else if (/^\w{1,}[@]{1}\w{1,}\.\w{1,}$/.test(email) === false) {
            emailError = "<i class='fas fa-exclamation-circle'></i> format email salah";
        }
        validasi(emailError, "#email_userError", "#email_user");

        // ? cek apakah jabatan sudah di isi
        var jabatanError = "";
        if (jabatan === "") {
            jabatanError = "<i class='fas fa-exclamation-circle'></i> jabatan wajib di isi";
        }
        validasi(jabatanError, "#jabatan_userError", "#jabatan_user");

        // ? cek apakah username sudah di isi
        var usernameError = "";
        if (username === "") {
            usernameError = "<i class='fas fa-exclamation-circle'></i> username wajib di isi";
        }
        validasi(usernameError, "#username_Error", "#username");

        // ? cek apakah password sudah di isi
        var passwordError = "";
        if (password === "") {
            passwordError = "<i class='fas fa-exclamation-circle'></i> password wajib di isi";
        }
        // * minimal 6 karakter
        else if (password.length < 6) {
            passwordError = "<i class='fas fa-exclamation-circle'></i> minimal 6 karakter";
        }
        validasi(passwordError, "#pass_Error", "#password");

        // ? cek apakah ulangi password sudah di isi
        var ulangiPasswordError = "";
        if (ulangpass === "") {
            ulangiPasswordError = "<i class='fas fa-exclamation-circle'></i> password wajib di isi";
        }
        // ? cek apakah ulangi password sama dengan password
        else if (ulangpass !== password) {
            ulangiPasswordError = "<i class='fas fa-exclamation-circle'></i> password tidak sama";
        }
        validasi(ulangiPasswordError, "#ulangpassError", "#ulangpass");

        // ? cek apakah tipe user sudah di pilih
        var tipe_userError = "";
        if (tipeuser === "") {
            tipe_userError = "<i class='fas fa-exclamation-circle'></i> tipe user wajib di pilih";
        }
        validasi(tipe_userError, "#tipe_userError", "#tipe_user");

        // * jika tidak ada error ,maka kirimkan data dengan ajax
        if (namaError === "" && emailError === "" && jabatanError === "" &&
            usernameError === "" && passwordError === "" && ulangiPasswordError === ""
            && tipe_userError === "") {
            var data = $("#formdatauser").serialize();

            $.ajax({
                url: "user/tambah_user",
                method: "post",
                data: data,
                dataType: "json",
                beforeSend: function () {
                    $("#loading").show();
                },
                success: function (data) {
                    if (data.status === "berhasil") {
                        $("#loading").hide();
                        $("#view").html("");
                        var no = 0;
                        var tabel = "";
                        tabel += '<table class="table table-bordered table-hover" id="data" style="width:100%;">';
                        tabel += '<thead class="small">';
                        tabel += '<tr>';
                        tabel += '<th class="text-center">No</th>';
                        tabel += '<th class="text-center">Nama</th>';
                        tabel += '<th class="text-center">Username</th>';
                        tabel += '<th class="text-center">Email</th>';
                        tabel += '<th class="text-center">Jabatan</th>';
                        tabel += '<th class="text-center">Tipe User</th>';
                        tabel += '<th class="text-center"><i class="fas fa-cogs"></i></th>';
                        tabel += '</tr>';
                        tabel += '</thead>';
                        tabel += '<tbody class="small">'
                        $.each(data.data, function (index, value) {
                            if (value.tipe_user === "1") { tipe = "Admin" } else { tipe = "User" }
                            no++;
                            tabel += '<tr>';
                            tabel += '<td class="text-center">' + no + '</td>'
                            tabel += '<td>' + value.nama_user + '</td>';
                            tabel += '<td>' + value.username + '</td>';
                            tabel += '<td>' + value.email_user + '</td>';
                            tabel += '<td>' + value.jabatan_user + '</td>';
                            tabel += '<td class="text-center">' + tipe + '</td>';
                            tabel += '<td class="text-center">';
                            tabel += `
                                    <button id="ubahpass" title="ubah password" data-id="`+ value.id_user + `" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#formpassword">
                                           <i class="fas fa-unlock-alt"></i>
                                     </button>
                                     <button id="ubahuser" title="ubah user" data-id="`+ value.id_user + `" class="btn btn-info btn-sm" data-toggle="modal" data-target="#formuser">
                                           <i class="fas fa-user-cog"></i>
                                     </button>
                                     <button id="hapususer" title="hapus user" data-id="`+ value.id_user + `" class="btn btn-danger btn-sm">
                                           <i class="fas fa-user-alt-slash"></i>
                                      </button>`;
                            tabel += "</td>";
                            tabel += '</tr>';
                        });
                        tabel += "</tbody>";
                        tabel += '</table>';

                        Swal.fire({
                            title: "Berhasil",
                            text: data.pesan,
                            type: "success"
                        });
                    }

                    $("#view").html(tabel);
                    $("#data").DataTable();
                    $("#formdatauser")[0].reset();

                    // * hapus border green
                    $("#nama_user")[0].style.border = "";
                    $("#email_user")[0].style.border = "";
                    $("#jabatan_user")[0].style.border = "";
                    $("#username")[0].style.border = "";
                    $("#password")[0].style.border = "";
                    $("#ulangpass")[0].style.border = "";
                    $("#tipe_user")[0].style.border = "";
                }
            });

        }
    });

    // * lihat password di klik eyes 
    $("#lihatpass").on("click", function () {
        if ($("#pass")[0].type === "password") {
            $("#pass")[0].type = "text";
            $(this).html("");
            $(this).html("<i class='fas fa-eye'></i>");
        }
        else if ($("#pass")[0].type === "text") {
            $("#pass")[0].type = "password";
            $(this).html("");
            $(this).html("<i class='fas fa-eye-slash'></i>");
        }


    });

    // * lihat ulang password
    $("#lihatulangpass").on("click", function () {
        if ($("#ulangpass")[0].type === "password") {
            $("#ulangpass")[0].type = "text";
            $(this).html("<i class='fas fa-eye'></i>");
        }
        else if ($("#ulangpass")[0].type === "text") {
            $("#ulangpass")[0].type = "password";
            $(this).html("");
            $(this).html("<i class='fas fa-eye-slash'></i>");
        }


    });

    // * Hapus Error ketika di focus
    $("#nama_user").on("focus", hapusError);
    $("#email_user").on("focus", hapusError);
    $("#jabatan_user").on("focus", hapusError);
    $("#username").on("focus", hapusError);
    $("#tipe_user").on("focus", hapusError);
    $("#password").on("focus", function () {
        $("#pass_Error").removeAttr("class").html("");
        $(this).removeAttr("style");
    });
    $("#ulangpass").on("focus", function () {
        $("#ulangpassError").removeAttr("class").html("");
        $(this).removeAttr("style");
    });

    // * jika tombol tutup dan x di klik,maka reset form data user dan hilangkan errornya
    $("#tutupuser,#closeuser").on("click", function () {
        // * reset all form
        $("#formdatauser")[0].reset();

        //  * hapus pesan error form
        function hapusErrorForm(selector) {
            $(selector)[0].nextElementSibling.className = "";
            $(selector)[0].nextElementSibling.innerHTML = "";
            $(selector)[0].style.border = "";
        }
        hapusErrorForm("#nama_user");
        hapusErrorForm("#email_user");
        hapusErrorForm("#jabatan_user");
        hapusErrorForm("#username");
        $("#password").removeAttr("style");
        $("#ulangpass").removeAttr("style");
        hapusErrorForm("#tipe_user");

        $("#pass_Error").html("");
        $("#pass_Error").removeAttr("class");

        $("#ulangpassError").html("");
        $("#ulangpassError").removeAttr("class");
    });
    // * AKHIR TAMBAH USER =========




    // * AWAL UBAH USER ==========

    // * jika tombol #ubahuser fa fa-user-cogs di klik
    $("#view").on("click", "#ubahuser", function () {
        // * ubah judul 
        $("#judul_modal").html("Ubah Data");
        // * sembunyikan loading,dan tombol tambah dan password
        $("#loading,#tambah,#pass,#ulang").hide();
        $("#ubahdatauser").show();
        var id = $(this).data("id");

        // * tampilkan data berdasarkan ID lewat ajax 
        $.ajax({
            url: "user/tampil_id",
            method: "post",
            data: { id: id },
            dataType: "json",
            success: function (data) {
                $("#nama_user").val(data.nama_user);
                $("#email_user").val(data.email_user);
                $("#jabatan_user").val(data.jabatan_user);
                $("#username").val(data.username);
                $("#tipe_user").val(data.tipe_user);
                $("#id").val(data.id_user);
            }
        });
    });


    // * jika tombol ubah didalam modal ubah data di klik
    $("#ubahdatauser").on("click", function () {
        var nama = $("#nama_user").val().trim();
        var email = $("#email_user").val().trim();
        var jabatan = $("#jabatan_user").val().trim();
        var username = $("#username").val().trim();
        var tipeuser = $("#tipe_user").val().trim();

        // ? cek apakah nama sudah di isi
        var namaError = "";
        if (nama === "") {
            namaError = "<i class='fas fa-exclamation-circle'></i> nama wajib di isi";
        }
        validasi(namaError, "#nama_userError", "#nama_user");

        // ? cek apakah email sudah di isi 
        var emailError = "";
        if (email === "") {
            emailError = "<i class='fas fa-exclamation-circle'></i> email wajib di isi";
        }
        // ? cek apakah format email sudah sessuai
        else if (/^\w{1,}[@]{1}\w{1,}\.\w{1,}$/.test(email) === false) {
            emailError = "<i class='fas fa-exclamation-circle'></i> format email salah";
        }
        validasi(emailError, "#email_userError", "#email_user");

        // ? cek apakah jabatan sudah di isi
        var jabatanError = "";
        if (jabatan === "") {
            jabatanError = "<i class='fas fa-exclamation-circle'></i> jabatan wajib di isi";
        }
        validasi(jabatanError, "#jabatan_userError", "#jabatan_user");

        // ? cek apakah username sudah di isi
        var usernameError = "";
        if (username === "") {
            usernameError = "<i class='fas fa-exclamation-circle'></i> username wajib di isi";
        }
        validasi(usernameError, "#username_Error", "#username");


        // ? cek apakah tipe user sudah di pilih
        var tipe_userError = "";
        if (tipeuser === "") {
            tipe_userError = "<i class='fas fa-exclamation-circle'></i> tipe user wajib di pilih";
        }
        validasi(tipe_userError, "#tipe_userError", "#tipe_user");


        // * jika tidak ada pesan error ,maka kirimkan data ubah user dengan ajax
        if (namaError === "" && emailError === "" && jabatanError === ""
            && usernameError === "" && tipe_userError === "") {
            var data = $("#formdatauser").serialize();

            $.ajax({
                url: "user/ubah_user_id",
                method: "post",
                dataType: "json",
                data: data,
                beforeSend: function () {
                    $("#loading").show();
                },
                success: function (data) {
                    if (data.status === "berhasil") {
                        $("#loading").hide();
                        $("#view").html("");
                        var no = 0;
                        var tabel = "";
                        tabel += '<table class="table table-bordered table-hover" id="data" style="width:100%;">';
                        tabel += '<thead class="small">';
                        tabel += '<tr>';
                        tabel += '<th class="text-center">No</th>';
                        tabel += '<th class="text-center">Nama</th>';
                        tabel += '<th class="text-center">Username</th>';
                        tabel += '<th class="text-center">Email</th>';
                        tabel += '<th class="text-center">Jabatan</th>';
                        tabel += '<th class="text-center">Tipe User</th>';
                        tabel += '<th class="text-center"><i class="fas fa-cogs"></i></th>';
                        tabel += '</tr>';
                        tabel += '</thead>';
                        tabel += '<tbody class="small">'
                        $.each(data.data, function (index, value) {
                            if (value.tipe_user === "1") { tipe = "Admin" } else { tipe = "User" }
                            no++;
                            tabel += '<tr>';
                            tabel += '<td class="text-center">' + no + '</td>'
                            tabel += '<td>' + value.nama_user + '</td>';
                            tabel += '<td>' + value.username + '</td>';
                            tabel += '<td>' + value.email_user + '</td>';
                            tabel += '<td>' + value.jabatan_user + '</td>';
                            tabel += '<td class="text-center">' + tipe + '</td>';
                            tabel += '<td class="text-center">';
                            tabel += `
                                    <button id="ubahpass" title="ubah password" data-id="`+ value.id_user + `" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#formpassword">
                                           <i class="fas fa-unlock-alt"></i>
                                     </button>
                                     <button id="ubahuser" title="ubah user" data-id="`+ value.id_user + `" class="btn btn-info btn-sm" data-toggle="modal" data-target="#formuser">
                                           <i class="fas fa-user-cog"></i>
                                     </button>
                                     <button id="hapususer" title="hapus user" data-id="`+ value.id_user + `" class="btn btn-danger btn-sm">
                                           <i class="fas fa-user-alt-slash"></i>
                                      </button>`;
                            tabel += "</td>";
                            tabel += '</tr>';
                        });
                        tabel += "</tbody>";
                        tabel += '</table>';

                        Swal.fire({
                            title: "Berhasil",
                            text: data.pesan,
                            type: "success"
                        });
                    }

                    $("#view").html(tabel);
                    $("#data").DataTable();

                    // * hapus border green
                    $("#nama_user")[0].style.border = "";
                    $("#email_user")[0].style.border = "";
                    $("#jabatan_user")[0].style.border = "";
                    $("#username")[0].style.border = "";
                    $("#tipe_user").removeAttr("style");
                }
            });

        }
    });

    // * AKHIR UBAH USER ===============




    // * AWAL UBAH PASSWORD =============

    // * jika tombol ubah pass #ubahpass di klik 
    $("#view").on("click", "#ubahpass", function () {
        // * ubah judul
        $("#judul_modalpass").html("Ubah Password");
        var id = $(this).data("id");
        // * sembunyikan loading
        $("#loadingpass").hide();

        // * tampilkan data username dan password
        $.ajax({
            url: "user/tampil_id",
            method: "post",
            data: { id: id },
            dataType: "json",
            success: function (data) {
                $("#usernamelamafix").val(data.username);
                $("#idpass").val(data.id_user);
            }
        });

    });



    // * lihat password di klik eyes 
    $("#lihatpass").on("click", function () {
        if ($("#password")[0].type === "password") {
            $("#password")[0].type = "text";
            $(this).html("");
            $(this).html("<i class='fas fa-eye'></i>");
        }
        else if ($("#password")[0].type === "text") {
            $("#password")[0].type = "password";
            $(this).html("");
            $(this).html("<i class='fas fa-eye-slash'></i>");
        }


    });


    // * lihat password di klik eyes 
    $("#lihatpassbaru").on("click", function () {
        if ($("#passwordbaru")[0].type === "password") {
            $("#passwordbaru")[0].type = "text";
            $(this).html("");
            $(this).html("<i class='fas fa-eye'></i>");
        }
        else if ($("#passwordbaru")[0].type === "text") {
            $("#passwordbaru")[0].type = "password";
            $(this).html("");
            $(this).html("<i class='fas fa-eye-slash'></i>");
        }


    });

    // * lihat ulang password baru
    $("#lihatulangpassbaru").on("click", function () {
        if ($("#ulangpasswordbaru")[0].type === "password") {
            $("#ulangpasswordbaru")[0].type = "text";
            $(this).html("<i class='fas fa-eye'></i>");
        }
        else if ($("#ulangpasswordbaru")[0].type === "text") {
            $("#ulangpasswordbaru")[0].type = "password";
            $(this).html("");
            $(this).html("<i class='fas fa-eye-slash'></i>");
        }


    });

    // * jika tombol ubah didalm modal password di klik #ubahpassword
    $("#ubahpassword").on("click", function () {
        var passBaru = $("#passwordbaru").val().trim();
        var ulangpassBaru = $("#ulangpasswordbaru").val().trim();

        // ? cek apakah password sudah di isi
        var passwordError = "";
        if (passBaru === "") {
            passwordError = "<i class='fas fa-exclamation-circle'></i> password wajib di isi";
        }
        // * minimal 6 karakter
        else if (passBaru.length < 6) {
            passwordError = "<i class='fas fa-exclamation-circle'></i> minimal 6 karakter";
        }
        validasi(passwordError, "#pass_ErrorBaru", "#passwordbaru");

        // ? cek apakah ulangi password sudah di isi
        var ulangiPasswordError = "";
        if (ulangpassBaru === "") {
            ulangiPasswordError = "<i class='fas fa-exclamation-circle'></i> password wajib di isi";
        }
        // ? cek apakah ulangi password sama dengan password
        else if (ulangpassBaru !== passBaru) {
            ulangiPasswordError = "<i class='fas fa-exclamation-circle'></i> password tidak sama";
        }
        validasi(ulangiPasswordError, "#ulangpass_ErrorBaru", "#ulangpasswordbaru");
        // * jika tidak ada error
        if (passwordError === "" && ulangiPasswordError === "") {
            var id = $("#idpass").val();
            $.ajax({
                url: "user/ubah_pass_id",
                method: "post",
                dataType: "json",
                data: {
                    id: id,
                    passwordbaru: passBaru
                },
                beforeSend: function () {
                    $("#loadingpass").show();
                },
                success: function (data) {
                    if (data.status === "berhasil") {
                        $("#loadingpass").hide();
                        $("#view").html("");
                        var no = 0;
                        var tabel = "";
                        tabel += '<table class="table table-bordered table-hover" id="data" style="width:100%;">';
                        tabel += '<thead class="small">';
                        tabel += '<tr>';
                        tabel += '<th class="text-center">No</th>';
                        tabel += '<th class="text-center">Nama</th>';
                        tabel += '<th class="text-center">Username</th>';
                        tabel += '<th class="text-center">Email</th>';
                        tabel += '<th class="text-center">Jabatan</th>';
                        tabel += '<th class="text-center">Tipe User</th>';
                        tabel += '<th class="text-center"><i class="fas fa-cogs"></i></th>';
                        tabel += '</tr>';
                        tabel += '</thead>';
                        tabel += '<tbody class="small">'
                        $.each(data.data, function (index, value) {
                            if (value.tipe_user === "1") { tipe = "Admin" } else { tipe = "User" }
                            no++;
                            tabel += '<tr>';
                            tabel += '<td class="text-center">' + no + '</td>'
                            tabel += '<td>' + value.nama_user + '</td>';
                            tabel += '<td>' + value.username + '</td>';
                            tabel += '<td>' + value.email_user + '</td>';
                            tabel += '<td>' + value.jabatan_user + '</td>';
                            tabel += '<td class="text-center">' + tipe + '</td>';
                            tabel += '<td class="text-center">';
                            tabel += `
                                    <button id="ubahpass" title="ubah password" data-id="`+ value.id_user + `" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#formpassword">
                                           <i class="fas fa-unlock-alt"></i>
                                     </button>
                                     <button id="ubahuser" title="ubah user" data-id="`+ value.id_user + `" class="btn btn-info btn-sm" data-toggle="modal" data-target="#formuser">
                                           <i class="fas fa-user-cog"></i>
                                     </button>
                                     <button id="hapususer" title="hapus user" data-id="`+ value.id_user + `" class="btn btn-danger btn-sm">
                                           <i class="fas fa-user-alt-slash"></i>
                                      </button>`;
                            tabel += "</td>";
                            tabel += '</tr>';
                        });
                        tabel += "</tbody>";
                        tabel += '</table>';

                        Swal.fire({
                            title: "Berhasil",
                            text: data.pesan,
                            type: "success"
                        });
                    }

                    $("#passwordbaru").val("");
                    $("#ulangpasswordbaru").val("");
                    $("#view").html(tabel);
                    $("#data").DataTable();
                    $("#passwordbaru").removeAttr("style");
                    $("#ulangpasswordbaru").removeAttr("style");
                }
            });
        }
    });

    // * hapus error saat di focus password
    $("#passwordbaru").on("focus", function () {
        $("#pass_ErrorBaru").removeAttr("class").html("");
        $(this).removeAttr("style");
    });
    $("#ulangpasswordbaru").on("focus", function () {
        $("#ulangpass_ErrorBaru").removeAttr("class").html("");
        $(this).removeAttr("style");
    });

    // * jika tombol tutuppass dan x di klik,maka reset semua form ubah password
    $("#tutuppassword,#closepass").on("click", function () {
        // * reset all form
        $("#formpass")[0].reset();

        $("#passwordbaru").removeAttr("style");
        $("#ulangpasswordbaru").removeAttr("style");
        $("#pass_ErrorBaru").html("");
        $("#pass_ErrorBaru").removeAttr("class");

        $("#ulangpass_ErrorBaru").html("");
        $("#ulangpass_ErrorBaru").removeAttr("class");
    });
    // * AKHIR UBAH PASSWORD ===========


    // * AWAL HAPUS USER  ==================
    $("#view").on("click", "#hapususer", function () {
        var id = $(this).data("id");
        // * hapus data user berdasarkan id
        Swal.fire({
            title: 'Apakah anda yakin ?',
            text: "Data akan dihapus secara permanen!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: '<i class="fas fa-user-alt-slash"></i> Hapus',
            cancelButtonText: "Tutup"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "user/hapus_user",
                    method: "post",
                    data: { id: id },
                    dataType: "json",
                    success: function (data) {
                        if (data.status === "berhasil") {
                            $("#loadingpass").hide();
                            $("#view").html("");
                            var no = 0;
                            var tabel = "";
                            tabel += '<table class="table table-bordered table-hover" id="data" style="width:100%;">';
                            tabel += '<thead class="small">';
                            tabel += '<tr>';
                            tabel += '<th class="text-center">No</th>';
                            tabel += '<th class="text-center">Nama</th>';
                            tabel += '<th class="text-center">Username</th>';
                            tabel += '<th class="text-center">Email</th>';
                            tabel += '<th class="text-center">Jabatan</th>';
                            tabel += '<th class="text-center">Tipe User</th>';
                            tabel += '<th class="text-center"><i class="fas fa-cogs"></i></th>';
                            tabel += '</tr>';
                            tabel += '</thead>';
                            tabel += '<tbody class="small">'
                            $.each(data.data, function (index, value) {
                                if (value.tipe_user === "1") { tipe = "Admin" } else { tipe = "User" }
                                no++;
                                tabel += '<tr>';
                                tabel += '<td class="text-center">' + no + '</td>'
                                tabel += '<td>' + value.nama_user + '</td>';
                                tabel += '<td>' + value.username + '</td>';
                                tabel += '<td>' + value.email_user + '</td>';
                                tabel += '<td>' + value.jabatan_user + '</td>';
                                tabel += '<td class="text-center">' + tipe + '</td>';
                                tabel += '<td class="text-center">';
                                tabel += `
                                        <button id="ubahpass" title="ubah password" data-id="`+ value.id_user + `" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#formpassword">
                                               <i class="fas fa-unlock-alt"></i>
                                         </button>
                                         <button id="ubahuser" title="ubah user" data-id="`+ value.id_user + `" class="btn btn-info btn-sm" data-toggle="modal" data-target="#formuser">
                                               <i class="fas fa-user-cog"></i>
                                         </button>
                                         <button id="hapususer" title="hapus user" data-id="`+ value.id_user + `" class="btn btn-danger btn-sm">
                                               <i class="fas fa-user-alt-slash"></i>
                                          </button>`;
                                tabel += "</td>";
                                tabel += '</tr>';
                            });
                            tabel += "</tbody>";
                            tabel += '</table>';

                            Swal.fire({
                                title: "Berhasil",
                                text: data.pesan,
                                type: "success"
                            });
                        }

                        $("#view").html(tabel);
                        $("#data").DataTable();


                    }
                });
            }
        })

    });
    // * AKHIR HAPUS USER ================

    // ! ======================== AKHIR DATA USER =======================

});