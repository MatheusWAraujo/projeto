$.post("minha_conta.php", true, function(Data) {
    $("#bemvindo").text("Bem vindo, " + Data.Nome + "!");
    
    $("#nomeinput").text("Nome: " + Data.Nome);
    $("#estado").text("Estado: " + Data.Estado);
    $("#cidade").text("Cidade: " + Data.Cidade);
    $("#bairro").text("Bairro: " + Data.Bairro);
    $("#logradouro").text("Logradouro: " + Data.Logradouro);
    $("#casanumero").text("Número: " + Data.Numero);

    $("#email").text("Email: " + Data.Email);
    $("#senha").text("Senha: " + Data.Senha);
}, 'json');