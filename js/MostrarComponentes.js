// document.querySelector("#SeleccionarPerillo").onclick = function(){
// if (document.querySelector('#SeleccionarPerillo').innerHTML == 'Solicitar Turno') {
//         document.querySelector("#SeleccionarPerillo").setAttribute("href", "http://181.14.240.149/medexisportal/?to=9&cp=HB2PB++CGGJXUQGY");
//         document.querySelector("#SeleccionarPerillo").setAttribute("target", "_blanc");
// } 
// else  
//     document.querySelectorAll(".recibeagustin").forEach(ObrasSociales=>ObrasSociales.removeAttribute('hidden'));
//     document.querySelector("#SeleccionarPerillo").innerHTML = "Solicitar Turno";
// }

function MostrarComponentes(id){
    var i;
    for (i = 1; i < 23; i++) {
        document.getElementById("medico" + i).hidden = true; 
        document.getElementById("seleccionar" + i).removeAttribute("hidden");  
    }
    document.getElementById("medico" + id).removeAttribute("hidden"); 
    document.getElementById("seleccionar" + id).hidden = true;   
}

