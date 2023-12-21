$(document).ready(function() {
    for (var i = 1; i <= 100; i++){
        let id = '#product-cart-click' + i;
        let Nome = $(id).text();

        $(id).click(function(){
            var Data = {nome: Nome};

            $.post("pesquisa.php", Data, function(response) {
            }, 'json');
        })
    }  
})