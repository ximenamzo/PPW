//Vue app = new.vue() //para importar librerias, como angular ###############################################################################

const app = { //objeto publico
    urlPost : "https://jsonplaceholder.typicode.com/posts", //propiedad publica
    urlComments : "https://jsonplaceholder.typicode.com/comments",
    urlUsers : "https://jsonplaceholder.typicode.com/users",
    
    userId : "",
    palabraClave : "",
    
    cargarPost : async function() {                                          //metodo //le ponemos argumentos
        //const cont = document.querySelector("#content");             //linea de codigo uso de DOM
        const cont = $("#content");                                    //jquery, lineas iguales, hacen lo mismo, la primera es mas veloz en ejecucion, es una llamada a travez de un componente
        cont.css("width","100%");                                      //facil DOM usando jquery
        cont.addClass("mx-auto mt-5");
        let html = "";
        let urlaux = "";
        if( this.userId !== "" ){
            urlaux = "?userId=" + this.userId;
        }
        let r = await fetch(this.urlUsers + "/" + this.userId) //r es array
                .then( resp => resp.json() ) //json es texto
                .catch( err => console.error(err));
        fetch(this.urlPost + urlaux)                                   //this es referencia estatica para referecnias al mismo objeto
            .then(resp => resp.json())                                 //formato de flecha es function abreviada
            .then( posts => {                                          // recibe la respuesta de resp., como uso llaves no ocupo return ni ;
                for ( let post of posts ){
                    let autor = (typeof r[post.userId-1] !== "undefined" ? r[post.userId-1].name : r.name);
                    if(post.body.indexOf(this.palabraClave) !== -1){ //index of devuelve un numero entre 0 y otro numero si la palabra esta contenida en el texto, si no, manda -1
                    html += `
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title"><b>${ post.title }</b></h5>
                            <h6 class="card-subtitle mb-2"><i class="bi bi-person-fill"></i>&nbsp;${autor} <b>|</b> <i class="bi bi-calendar2-week"></i>&nbsp;Fecha </6>
                        </div>
                        <div class="card-body">
                            <p class="card-text">${ post.body }</p>
                        </div>
                        <div class="card-footer text-muted">
                            <button class="btn btn-link" type="button"
                                id="btn-ver-com${post.id}"
                                onclick="app.cargarComments(${post.id})">
                                Ver comentarios
                            </button>
                            <button class="btn btn-link d-none" type="button"
                                id="btn-cer-com${post.id}"
                                onclick="app.cerrarComments(${post.id})">
                                Cerrar comentarios
                            </button>
                            <div class="card d-none" id="card-com${post.id}">
                                <ul class="list-group list-group-flush" id="comments${post.id}">
                                </ul>
                            </div>
                        </div>
                    </div>`;
                    }
                    //cont.innerHTML = html; //con DOM
                    cont.html(html); //codigo html de jquery
                }
            }).catch( err => console.error(err)); //array de objetos, js lo puede manipular
    },

    cargarComments : function(postId) {
        let html = "";
        const listaCom = $("#comments" + postId);
        fetch(this.urlComments + "?postId=" + postId)
            .then(resp => resp.json())
            .then( comments => {
                for ( let c of comments ){
                    html += `
                        <li class="list-group-item">
                            De: <b>${c.email}</b><br><small>${c.body}</small>
                        </li>
                    `;
                }
                listaCom.html(html);
                $("#card-com" + postId).toggleClass("d-none", false);
                $("#btn-ver-com" + postId).toggleClass("d-none", true);
                $("#btn-cer-com" + postId).toggleClass("d-none", false);
            }).catch( err => console.error(err)); //array de objetos, js lo puede manipular
    },

    cerrarComments : function(postId){
        $("#comments" + postId).html("");
        $("#card-com" + postId).toggleClass("d-none", true);
        $("#btn-ver-com" + postId).toggleClass("d-none", false);
        $("#btn-cer-com" + postId).toggleClass("d-none", true);
    },

    cargarUsers : function(){
        const users = $("#authors");
        let html = "";
        users.addClass("mt-5");
        users.html(html);
        fetch(this.urlUsers)
            .then( resp => resp.json() )
            .then( usuarios => {
                for( let u of usuarios ){
                    html += `
                        <button type="button" class="list-group-item list-group-item-action" aria-current="true"
                            id="up${u.id}" 
                            onclick="app.userPosts(${u.id})">
                            ${u.name}<br><small>${u.email}</small>
                        </button>
                    `;
                }
                users.html(html);
            }).catch( err => console.error(err) );
    },

    userPosts : function (userId) {
        $("#up" + this.userId).removeClass("active");
        this.userId = userId;
        $("#up" + userId).addClass("active");
        this.cargarPost();
    },

    buscarPalabra : function(){
        $("#up" + this.userId).removeClass("active");
        this.userId = "";
        this.palabraClave = $("#buscar-palabra").val(); //En DOM es value porque es una propiedad
        this.cargarPost();
    }
}

//cargar la funcion
window.onload = function(){
    app.cargarPost();
    app.cargarUsers();
}