$(document).ready(function() {
    //console.log("Hola Mundo");
});

(function () {
    //alert("Hola Mundo");  
    // var botonEdit = document.getElementById("botonEditPedido");
    // console.log(botonEdit);

    // if(botonEdit)
    // {
    //     botonEdit.addEventListener("click", function() {
            
    //         var buttonSubmit = document.querySelector(".btn-actualizar");
    //         console.log(buttonSubmit);
            
    //         buttonSubmit.addEventListener("click", function() {
    //             document.getElementById("formEditStatus").submit();
    //         });
    //     });
    // }

    var botonEdit = document.querySelectorAll(".button-gestion");
    if(botonEdit)
    {
        for(var i=0;i<botonEdit.length;i++) {
            botonEdit[i].addEventListener("click", function() //Capturar el evento click del modal para actualizar el pedido en gestionar pedidos
            {
                var id = this.id;
                // console.log(id);

                var buttonSubmit = document.getElementById("buttonSubmit" + id.substr(-2,2));

                buttonSubmit.addEventListener("click", (e) => {
                    // console.log(buttonSubmit);
                    document.getElementById("formEditStatus" + id.substr(-2,2)).submit();
                });
            }); 
        }
    }

})();
