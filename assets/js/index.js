$(document).ready(function() {
    //console.log("Hola Mundo");

    var botonEdit = document.getElementById("botonEditPedido");
    //console.log(botonEdit);

    botonEdit.addEventListener("click", function() {

        var buttonSubmit = document.getElementById("buttonSubmit");
        //console.log(buttonSubmit);

        buttonSubmit.addEventListener("click", function() {
            var formEditar = document.getElementById("formEditStatus").submit();
        });
    });
});
