$("#usuario").hide();

function click() {
    if ($("#nome").val() == '' || $("#estado").val() == '' || $("#cidade").val() == '' || $("#bairro").val() == '' || $("#logradouro").val() == '' ||
    $("#casanumero").val() == ''){
        $("#alert").text("*Preencha todos os campos.")
        return;
    };

    $numero = $("#casanumero").val();

    if (isNaN($numero)){
        $("#alert").text("*Coloque um valor númerico no número da casa.");
        return; 
    }

    $("#alert").text("");
    $("#pessoa").hide();
    $("#usuario").show();
}

function cadastrar() {
    if ($("#email").val() == '' || $("#senha").val() == '' || $("#senha2").val() == '') {
        $("#alert2").text("*Preencha todos os campos.");
        return;
    }

    if ($("#senha").val().length < 6) {
        $("#alert2").text("*A senha precisa ter mais que 5 caracteres.");
        return;
    }
    
    if ($("#senha").val() != $("#senha2").val()) {
        $("#alert2").text("*As senhas não coincidem.");
        return;
    }
    
    $("#alert2").text("");

    var Data = {
        nome: $("#nome").val(),
        estado: $("#estado").val(),
        cidade: $("#cidade").val(),
        bairro: $("#bairro").val(),
        logradouro: $("#logradouro").val(),
        casanumero: $("#casanumero").val(),

        email: $("#email").val(),
        senha: $("#senha").val(),
    }
    
    $.post("../CLIENT/cadastro.php", Data, function(response) {
        if (response == true){
            window.location.href="home.php";
        } else if (response == false) {
            $("#alert2").text("*O email já existe." );
        }
    }, 'json');
}

$("#continue").click(click);
$("#cadastrar").click(cadastrar);