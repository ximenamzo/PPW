const app = {
    routes : {
		inisession : "/PPW/Ejercicio4/resources/views/auth/login.php",
		endsession : "/PPW/Ejercicio4/app/app.php?_logout",
		login : "/PPW/Ejercicio4/app/app.php",
        register: "/PPW/Ejercicio4/resources/views/auth/register.php",
        doregister: "/PPW/Ejercicio4/app/app.php",
        home : "/PPW/Ejercicio4/resources/views/home.php",
		prevpost : "/PPW/Ejercicio4/app/app.php?_pp",
		lastpost : "/PPW/Ejercicio4/app/app.php?_lp",
        openpost : "/PPW/Ejercicio4/app/app.php?_op",
        newpost : "/PPW/Ejercicio4/resources/views/autores/newPost.php",
        myposts : "/PPW/Ejercicio4/resources/views/autores/myposts.php",
        savecomment : "/PPW/Ejercicio4/app/app.php?_sc",
	},

    user : {
        sv : false,
        id : 0,
        tipo : ""
    },
    pp : $("#prev-post"),
	lp : $("#content"),

	view : function(route){
		location.replace(this.routes[route]);
	},

    previousPost : function(){
		let html = `<b>Aún no hay publicaciones en este blog</b>`;
		this.pp.html("");
		fetch(this.routes.prevpost)
			 .then(resp => resp.json())
			 .then(ppresp => {
                if(ppresp.length > 0){
			 		html = "";
			 		//let primera = true; //${ primera ? `active` : `` } ${primera ? `light` : `muted`}
			 		for(let post of ppresp){
			 			html += `
                            <a href="#" onclick="app.openPost(event, ${post.id}, this)"
                                class="list-group-item list-group-item-action pplg"> 
                                <div class="w-100 border-bottom">
                                    <h5 class="mb-1">${post.title}</h5>
                                    <small class="text-muted blanco">
                                        <i class="bi bi-calendar-week blanco"></i> ${post.fecha}
                                    </small>
                                </div>
                                <small>
                                    <i class="bi bi-person-circle"></i>
                                    <b>${ post.name }</b>
                                </small>
                            </a>
                        `;
                        //primera = false;
                        // para el html, no se recomienda usar id por buena programacion, pero si agregar el ${post.id}
                    }
                    this.pp.html(html);
                    let items = document.querySelectorAll('.pplg');
                    items.forEach(item => {
                        item.addEventListener('click', function(){
                            items.forEach(item => {
                                item.classList.remove('active');
                                let fecha = item.querySelector('.blanco');
                                fecha.classList.remove('text-light');
                                fecha.classList.add('text-muted');
                            });
                            this.classList.add('active');
                            let fecha = this.querySelector('.blanco');
                            fecha.classList.remove('text-muted');
                            fecha.classList.add('text-light');
                        });
                    });
                }
            }).catch( err => console.error( err ));
    },

    lastPost : function(limit){
        let html = "<h2>Aún no hay publicaciones</h2>";
        this.lp.html("");

        fetch(this.routes.lastpost + "&limit=" + limit)
			.then(response => response.json())
			.then(lpresp => {
				if(lpresp.length > 0){
					html = this.postHTMLLoad(lpresp);
                }
                this.lp.html(html);
			}).catch(err => console.error(err));
    },

    openPost : function(event, pid, element){
        event.preventDefault(); //profe
        $(".pplg").removeClass("active"); //profe
        element.classList.add("active"); //profe
        let html = "<h2>Aún no hay publicaciones</h2>";
        this.lp.html("");
        fetch(this.routes.openpost + "&pid=" + pid)
			.then(response => response.json())
			.then(post => {
				if(post.length > 0){
                    html = this.postHTMLLoad(post);
                }
                this.lp.html(html);
			}).catch(err => console.error(err));
    },
    
    postHTMLLoad : function (post){
        return `<div class="w-100 border-bottom mt-4">
                    <h5 class="mb-1">${post[0].title}</h5>
                    <small class="text-muted mt-3"> 
                        <i class="bi bi-person-circle mx-1"></i>${post[0].name} | 
                        <i class="bi bi-calendar-week mx-1"></i>${post[0].fecha} 
                    </small>
                    <p class="mt-2 pb-3 border-bottom fs-5" style="text-align:justify;">
                        ${post[0].body}
                    </p>
                    <i class="bi bi-hand-thumbs-up"></i> <span id="likes">${0}</span>
                    <p class="float-end">
                        <span id="comentarios"><i class="bi bi-chat-right"></i> ${ 0 } comentarios</span>
                    </p>
                    <div class="input-group mt-3 mb-2">
                        <input type="text" class="form-control" ${ this.user.sv ? '' : 'disabled readonly'}
                            placeholder="${ this.user.sv ? 'Deja tu comentario...' : 'Ingresa para poder realizar comentarios'}" 
                            name="comment" id="comment"
                            aria-label="Deja tu comentario..." 
                            aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="app.saveComment(${post[0].id});">
                            <i class="bi bi-send"></i>
                        </button>
                    </div>
                </div>
            `;
    },

    saveComment(pid, uid){
        const datos = new FormData();
        datos.append('pid',pid);
        datos.append("comment",$("#comment").val());
        datos.append('_sc',"");
        fetch(this.routes.savecomment,{
            method:"POST",
            body: datos
        }).then( () => {
            $("#comment").val("");
        }).catch(err => console.error("Hay un error: ", err));
    }
}