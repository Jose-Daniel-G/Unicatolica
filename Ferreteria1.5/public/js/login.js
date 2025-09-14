 (function validarLogin() {
    $("#frm_session").on("submit", function (event) {
        event.preventDefault();
        var user = $("#user").val();
        var password = $("#password").val();
        
        if (user != "" && password != "") {
            var formData = new FormData(event.target);
            formData.append("function", "validate_session");
            $.ajax({
                url: "app/controller/SessionController.php",
                method: "POST",
                dataType: "json",
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            }).done((res) => {
                if (res.typeAnswer == "success") {
                    location.href = "web/pages/index.php";
                    // location.href = "web/pages/Home.html.php";

                    
                } else if (res.typeAnswer == "error") {
                    swal({
                        title: 'usuario o contraseña incorrecto',
                        type: 'warning',
                    });
                } else if (res.typeAnswer == "fail") {
                    swal({
                        title: 'El usuario ingresado no existe',
                        type: 'warning',
                    });
                }
            });

        } 
    });
}());

 (function userRegister() {
    $("#frm_register").on("submit", function (event) {
        event.preventDefault();
        var user = $("#user").val();
        var password = $("#password").val();
        var verifyPassword = $("#verifyPassword").val();
        
        if (user != "" && password != "" && verifyPassword != "") {
            var formData = new FormData(event.target);
            formData.append("function", "register_user");
            $.ajax({
                url: "../../app/controller/SessionController.php",
                method: "POST",
                dataType: "json",
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            }).done((res) => {

                if (res.typeAnswer == "success") {
                    swal({
                        title: 'Exito usuario creado',
                        type: 'warning',
                    });
                    // location.href = "Session.html.php";

                } else if (res.typeAnswer == "error") {
                    swal({
                        title: 'No se pudo realizar el registro',
                        type: 'warning',
                    });
                } else if (res.typeAnswer == "fail") {
                    swal({
                        title: 'La contraseña no coincide',
                        type: 'warning',
                    });
                } 
            });

        } 
    });
}());
(function closeSession(){
    $(document).on("click", "#exit", function (event) {
        $.ajax({
            url: "../../app/controller/SessionController.php",
            method: "post",
            data: {
                function: "close_session",
            }
        }).done(() => {
            window.location.href = "../../";
        });
    });

}());

(function generateInclude() {//no sirve
    $(document).on("click", "#cargar", function () {
        var dato =  $(this).attr("data-url");			
        console.log(dato);
        // var formData = new FormData(event.target);
        // formData.append("function", "generate_include");
        // $.ajax({
        //     url: "app/Lib/Helper.php",
        //     method: "POST",
        //     dataType: "json",
        //     data: formData,
        //     cache: false,
        //     contentType: false,
        //     processData: false
        // }).done((res) => {
        //     if (res.typeAnswer == "success") {
        //         swal({
        //             title: 'no existe',
        //             type: 'warning',
        //         });	
        //     } else if (res.typeAnswer == "error") {
        //         swal({
        //             title: 'no existe',
        //             type: 'warning',
        //         });
        //     } 
        // }); 
    });
}());

