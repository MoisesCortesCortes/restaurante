var i = 1;
function addPlato() {
    
    var platosContainer = document.getElementById("platos");
    
    var nuevoPlato = document.createElement("div");
    nuevoPlato.className = "row";
    nuevoPlato.setAttribute("id", "plato" + i);
    
    var divCantidad = document.createElement("div");
    divCantidad.className = "col-md-3";

    var divPlato = document.createElement("div");
    divPlato.className = "col";

    var cantidadSelect = document.createElement("select");
    cantidadSelect.className = "form-select";
    cantidadSelect.setAttribute("aria-label", "Default select example");
    cantidadSelect.setAttribute("name", "cantidad[" + i+"]");

    var platoSelect = document.getElementsByName("plato["+(i-1)+"]")[0].cloneNode(true);
    platoSelect.className = "form-select";
    platoSelect.setAttribute("aria-label", "Default select example");
    platoSelect.setAttribute("name", "plato[" + i+"]");
    
    var cantidadOptions = [
        {
            value: "1",
            text: "1",
        },
        {
            value: "2",
            text: "2",
        },
        {
            value: "3",
            text: "3",
        },
        {
            value: "4",
            text: "4",
        },
        {
            value: "5",
            text: "5",
        },
        {
            value: "6",
            text: "6",
        },
        {
            value: "7",
            text: "7",
        },
        {
            value: "8",
            text: "8",
        },
        {
            value: "9",
            text: "9",
        },
        {
            value: "10",
            text: "10",
        },
    ];
    cantidadOptions.forEach(function (option) {
        var cantidadOption = document.createElement("option");
        cantidadOption.value = option.value;
        cantidadOption.text = option.text;
        cantidadSelect.add(cantidadOption);
    });
    
    var divMenos = document.createElement("div");
    divMenos.className = "col-md-2";
    var menos = document.createElement("input");
    menos.setAttribute("type", "button");
    menos.setAttribute("onclick", "deletePlato(" + (i - 1) + ")");
    menos.setAttribute("class", "rounded-circle");
    menos.setAttribute("value", "-");
    
    divCantidad.appendChild(cantidadSelect);
    divPlato.appendChild(platoSelect);
    divMenos.appendChild(menos);
    nuevoPlato.appendChild(divCantidad);
    nuevoPlato.appendChild(divPlato);
    var platoAnterior = document.getElementById("plato" + (i - 1));
    platoAnterior.appendChild(divMenos);
    var botonAdd = document.getElementById("add");
    nuevoPlato.appendChild(botonAdd);
    platosContainer.insertBefore(nuevoPlato, platosContainer.lastChild);
    i++;
}

function deletePlato(numPlato) {
    var plato = document.getElementById("plato" + numPlato);
    if (plato) {
        padre = plato.parentNode;
        padre.removeChild(plato);
        cambiarIdPlatosSiguientes(numPlato + 1);
    }
}

function cambiarIdPlatosSiguientes(numPlato) {
    console.log('cambiando plato '+numPlato);
    var plato = document.getElementById("plato" + numPlato);
    if (plato) {
        plato.setAttribute("id", "plato" + (numPlato - 1));
        var cantidad = document.getElementsByName("cantidad[" + numPlato+"]")[0];
        cantidad.setAttribute("name", "cantidad[" + (numPlato - 1)+"]");
        var platoSelect = document.getElementsByName("plato[" + numPlato+"]")[0];
        platoSelect.setAttribute("name", "plato[" + (numPlato - 1)+"]");
        cambiarIdPlatosSiguientes(numPlato + 1);
    }
}



