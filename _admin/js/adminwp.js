//Configuração
var config = {
    idCliente : 1007, //readCookie("IdCliente"),
    urlSeg : "http://seguranca.mundowebpix.com:5300/api/Seguranca/",
    idUsuarioDefalut : 999
};

var meu = "";
var item = "";
$.get(config.urlSeg + "Principal" +"/" + "buscarpaginas" + "/" + config.idCliente + "/"+ config.idUsuarioDefalut, {}, function (data) {
    console.log(data)

    meu = data;
    item = {
        "items" : meu 
    };
    console.log(item);
});
    
template = $('#item-template').html();
output = Mustache.render(template, item);
$("#GridWP").append(output);
