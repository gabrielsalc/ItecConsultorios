// document.querySelector("#SeleccionarPerillo").onclick = function(){
// if (document.querySelector('#SeleccionarPerillo').innerHTML == 'Solicitar Turno') {
//         document.querySelector("#SeleccionarPerillo").setAttribute("href", "http://181.14.240.149/medexisportal/?to=9&cp=HB2PB++CGGJXUQGY");
//         document.querySelector("#SeleccionarPerillo").setAttribute("target", "_blanc");
// } 
// else  
//     document.querySelectorAll(".recibeagustin").forEach(ObrasSociales=>ObrasSociales.removeAttribute('hidden'));
//     document.querySelector("#SeleccionarPerillo").innerHTML = "Solicitar Turno";
// }

function MostrarComponentes(id) {

    const MAX_MEDICOS = 20;

    const seleccionado = document.getElementById("medico" + id);

    if (!seleccionado) return;

    const abrir = seleccionado.hasAttribute("hidden");

    // ocultar todos
    for (let i = 1; i <= MAX_MEDICOS; i++) {

        const el = document.getElementById("medico" + i);

        if (el) el.setAttribute("hidden", true);

    }

    // abrir solo si estaba cerrado
    if (abrir) {
        seleccionado.removeAttribute("hidden");
    }

}