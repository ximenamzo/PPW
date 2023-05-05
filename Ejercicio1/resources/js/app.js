const app = {
    urlDatos : "./resources/data/datos.json",
    filtro : "todos",

    cargarFichas : function(){ //metodo para acceder a la funcion
        const fichas = document.querySelector("#fichas");
        let html = "";
        fetch(this.urlDatos)
            .then( response => response.json())
            .then( autos => {
                for(auto of autos){
                    if(auto.tipo === this.filtro || this.filtro === "todos"){
                        html += `
                        <div class="ficha" id="ficha">
                        <img src="./resources/img/${ auto.foto }" alt="${ auto.marca }">
                            <div class="datos" id="datos" onmouseover="addDetalles()" onmouseout="backToNormal()">
                                <h3>${auto.marca}</h3>
                                <span>${auto.modelo}</span>
                                <span>${auto.anio}</span>
                                <br>
                                <small>${auto.motor.potencia},
                                       ${auto.motor.kilometraje},
                                       ${auto.motor.desplazamiento}
                                </small>
                                <div class="detalles" id="detalles">
                                    <!--<small class="detalles"></br>Detalles:<br>${auto.detalles}</small>-->
                                </div>
                            </div>
                        </div>
                        `;
                    }
                }
                fichas.innerHTML = html;
            }).catch(err => console.error(err));
    }
    /*,
    addDetalles : function(){
        const detalles = document.querySelector("#detalles");
        let html = "";
        fetch(this.urlDatos)
        .then( response => response.json())
        .then( autos => {
            for(auto of autos){
                if(auto.tipo === this.filtro || this.filtro === "todos"){
                    html += `<small></br>Detalles:<br>${auto.detalles}</small>`;
                }
            }
            detalles.innerHTML = html;
        }).catch(err => console.error(err));
    },
    
    backToNormal : function(){
        const detalles = document.querySelector("#detalles");
        let html = "";
        fetch(this.urlDatos)
        .then( response => response.json())
        .then( autos => {
            for(auto of autos){
                html += ``;
            }
            detalles.innerHTML = html;
        }).catch(err => console.error(err));
    }*/
}

window.onload = function(){
    app.cargarFichas();
    /*app.addDetalles();
    app.backToNormal();*/
    
    const mitem = document.querySelectorAll("a.mitem"); //a es la etiqueta y se usa punto porque es clase, id es #
    mitem.forEach( menuItem => { //otra opcion es poner function
        menuItem.addEventListener("click", event => {
            event.preventDefault();
            app.filtro = menuItem.getAttribute("data-tipo-auto"); //objeto principal
            app.cargarFichas(); //CUIDA ORTOGRAFIA PERRA
        });
    }); 
}


function addDetalles(){
    const detalles = document.querySelector("#detalles");
    let html = "";
    html += `<small></br>Detalles:<br>${auto.detalles}</small>`;
    detalles.innerHTML = html;
    fetch(this.urlDatos)
        .then( response => response.json())
        .then( autos => {
            for(auto of autos){
                    html += `<small class="detalles"></br>Detalles:<br>${auto.detalles}</small>`;
            }
            detalles.innerHTML = html;
        }).catch(err => console.error(err));
}

/**https://stackoverflow.com/questions/52823007/how-do-i-assign-json-data-to-a-paragraph-when-hovering-over-that-element */

function backToNormal(){
    const detalles = document.querySelector("#detalles");
    let html = "";
    html += ``;
    detalles.innerHTML = html;
}





/*let datosDiv = document.querySelector('.datos');
// Crear div element
let detallesDiv = document.createElement('div');
detallesDiv.classList.add('detalles');
datosDiv.appendChild(detallesDiv);

// Evenet listener en ficha
document.getElementById('ficha').addEventListener('mouseover', addDetalles);

function addDetalles(){
    let detallesTexto = `
        <div class="detalles" id="detalles">
            <small class="detalles"></br>Detalles:<br>${auto.detalles}</small>
        </div>
    `;
    detallesDiv.insertAdjacentHTML('beforeend',detallesTexto);
}*/




/*function onTabClick(event) {
    let activeTabs = document.querySelectorAll('.datos');
  
    // deactivate existing active tab and panel 
    activeTabs.forEach(function(tab) {
      tab.className = tab.className.replace('detalles', '');
    });
  
    // activate new tab and panel
    event.target.parentElement.className += ' detalles';
    document.getElementById(event.target.href.split('#')[1]).className += ' detalles';
  }
  const element = document.getElementById('datos');
  element.addEventListener('click', onTabClick, false);*/