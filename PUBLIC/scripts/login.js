function login() {
    if ($("#email").val() == '' || $("#senha").val() == '') {
        $("#alert").text("*Preencha todos os campos.");
        return;
    }

    $("#alert").text("");

    var Data = {
        email: $("#email").val(),
        senha: $("#senha").val(),
    }

    $.post("login.php", Data, function(response) {
        if (response == true){
            window.location.href="home.php";
        } else {
            $("#alert").text("*Credenciais erradas." );
        }
    }, 'json');
}

$("#loginbutton").click(login);
