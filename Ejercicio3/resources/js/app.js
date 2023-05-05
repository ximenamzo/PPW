const app = {
    routes : {
		inisession : "/PPW/Ejercicio3/resources/views/auth/login.php",
		endsession : "/PPW/Ejercicio3/app/app.php?_logout",
		login : "/PPW/Ejercicio3/app/app.php",
		prevpost : "/PPW/Ejercicio3/app/app.php?_pp",
		lastpost : "/PPW/Ejercicio3/app/app.php?_lp",
        openpost : "/PPW/Ejercicio3/app/app.php?_op",
        newpost : "/PPW/Ejercicio3/resources/views/autores/newPost.php",
        myposts : "/PPW/Ejercicio3/resources/views/autores/myposts.php",
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
					html = `
                        <div class="w-100 border-bottom mt-4">
                            <h5 class="mb-1">${lpresp[0].title}</h5>
                            <small class="text-muted"> 
                                <i class="bi bi-person-circle"></i>${lpresp[0].name} | 
                                <i class="bi bi-calendar-week"></i>${lpresp[0].fecha} 
                            </small>
                            <p class="mb-1">${lpresp[0].body}</p>
                        </div>
                    `;
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
			.then(opresp => {
				if(opresp.length > 0){
					html = `
                        <div class="w-100 border-top border-bottom mt-4">
                            <h5 class="mb-1 mt-1">${opresp[0].title}</h5>
                            <small class="text-muted"> 
                                <i class="bi bi-person-circle"></i>  ${opresp[0].name} | 
                                <i class="bi bi-calendar-week"></i>  ${opresp[0].fecha} 
                            </small>
                            <p class="mb-1 border-top text-justify mt-2 fs-6">${opresp[0].body}</p>
                        </div>
                    `;
                }
                this.lp.html(html);
			}).catch(err => console.error(err));
    }
}