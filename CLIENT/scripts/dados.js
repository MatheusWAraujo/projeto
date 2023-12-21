$.post("fechar_compra.php", true, function(Data) {
    $("#nomeinput").text("Nome: " + Data.Nome);
    $("#estado").text("Estado: " + Data.Estado);
    $("#cidade").text("Cidade: " + Data.Cidade);
    $("#bairro").text("Bairro: " + Data.Bairro);
    $("#logradouro").text("Logradouro: " + Data.Logradouro);
    $("#casanumero").text("Número: " + Data.Numero);

    $("#email").text("Email: " + Data.Email);
    $("#senha").text("Senha: " + Data.Senha);
}, 'json');