$(document).ready(function () {
    // * function untuk validasi error login
    function validasi(error, selectorerror, selectorinput) {
        if (error !== "") {
            $(selectorerror).html(error);
            $(selectorerror).addClass("bg-danger text-white mt-1 p-2 font-weight-bold");
            $(selectorerror).css("border-radius", "50px");
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

    // * jika tombol masuk di klik 
    $("#masuk").on("click", function () {
        var username = $("#username").val().trim();
        var password = $("#password").val().trim();

        // ? cek apakah username sudah di isi
        var usernameError = "";
        if (username === "") {
            usernameError = "<i class='fas fa-exclamation-circle'></i> username wajib di isi";
        }
        validasi(usernameError, "#usernameError", "#username");

        var passwordError = "";
        // ? cek apakah password sudah di isi
        if (password === "") {
            passwordError = "<i class='fas fa-exclamation-circle'></i> password wajib di isi";
        }
        validasi(passwordError, "#passwordError", "#password");


        // * jika username , password sudah di isi dengan benar,maka cek validasi ke server dengan
        // * bantuan ajax 
        if (username !== "" && password !== "") {
            var remember = $("#remember")[0].checked;

            $.ajax({
                url: "login/ceklogin",
                method: "post",
                dataType: "json",
                data: {
                    username: username,
                    password: password,
                    remember: remember
                },
                success: function (response) {
                    if (response.status === "gagal") {
                        $("#pesan").html("<i class='fas fa-exclamation-circle'></i> username atau password salah");
                        $("#pesan").addClass("bg-danger text-center text-white mt-1 p-2 font-weight-bold");
                        $("#pesan").css("border-radius", "50px");
                        $("#username").val("").removeAttr("style");
                        $("#password").val("").removeAttr("style");
                    }
                    else {
                        $("#pesan").html("");
                        $("#pesan").removeAttr("class").removeAttr("style");
                        window.location.href = "dashboard";

                    }

                }

            });



        }


    });

    // * jika isian form di klik ada error,maka hapus errornya
    function hapusError(e) {
        e.target.style.border = "";
        e.target.parentElement.lastElementChild.className = "";
        e.target.parentElement.lastElementChild.innerHTML = "";
    }

    $("#username").focus(hapusError);
    $("#password").focus(hapusError);
});