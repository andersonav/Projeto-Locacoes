/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    var controller = "app/controller/FrontController.php";

    $(".btn-login").click(function () {
        var login = $("#login").val();
        var password = $("#password").val();

        if (login == "" || password == "") {
            $("#modalCamposNulos").modal("show");
        } else {
            $.ajax({
                url: controller,
                type: 'POST',
                data: {
                    action: 'UsuarioLogica.login',
                    login: login,
                    senha: password
                }, success: function (data, textStatus, jqXHR) {
                    data = $.parseJSON(data);
                    if (data.length == 0) {
                        $("#modalErroLogin").modal("show");
                    } else {
                        if (data.tipoID == 1 || data.tipoID == 2) {
                            window.location = 'app/admin.php';
                        } else {
                            window.location = 'app/usuario.php';
                        }
                    }
                }
            });
        }
    });

    $("#login, #password").keyup(function (e) {
        if (e.keyCode == 13) {
            $(".btn-login").trigger("click");
        }
    });
});

