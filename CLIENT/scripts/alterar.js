function alterar(){
    if ($("#senha").val() == '' || $("#newsenha").val() == '' || $("#newsenha2").val() == '') {
        $("#alert").text("*Preencha todos os campos.");
        return;
    }

    if ($("#newsenha").val().length < 6) {
        $("#alert").text("*A senha precisa ter mais que 5 caracteres.");
        return;
    }
    
    if ($("#newsenha").val() != $("#newsenha2").val()) {
        $("#alert").text("*As senhas não coincidem.");
        return;
    }

    $("#alert").text("");

    var Data = {newsenha: $("#newsenha").val(), senha: $("#senha").val()};

    $.post("alterar_senha.php", Data, function(response) {
        if (response == true){
            window.location.href="minha_conta.php";
        } else {
            $("#alert").text("*A senha está errada." );
        }
    }, 'json');
}

$("#changebutton").click(alterar);