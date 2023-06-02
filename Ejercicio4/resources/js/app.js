let lastPostId = null;
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
        togglelike : "/PPW/Ejercicio4/app/app.php?_tl",
        toggledislike : "/PPW/Ejercicio4/app/app.php?_td",
        togglehaha : "/PPW/Ejercicio4/app/app.php?_th",
        postcomments : "/PPW/Ejercicio4/app/app.php?_pm",
        savecomment : "/PPW/Ejercicio4/app/app.php?_sc",
	},

    user : {
        sv : false,
        id : 0,
        tipo : ""
    },
    pp : $("#prev-post"),
	lp : $("#content"),

    likesValue : 0,
    dislikesValue : 0,
    hahasValue : 0,

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
			 		let primera = true; //${ primera ? `active` : `` } ${primera ? `light` : `muted`}
			 		for(let post of ppresp){
                        console.log(post);
                        if(post.active == 1){
			 			html += `
                                <a href="#" onclick="app.openPost(event, ${post.id}, this)"
                                    class="list-group-item list-group-item-action pplg ${ primera ? `active` : `` } prevpost"> 
                                    <div class="w-100 border-bottom">
                                        <h5 class="mb-1">${post.title}</h5>
                                        <small class="text-muted blanco ${primera ? `text-light` : ``}">
                                            <i class="bi bi-calendar-week blanco ${primera ? `text-light` : ``}"
                                               ${primera ? `style="color:white;"` : ``}>
                                            </i> <span ${primera ? `style="color:white;"` : ``}
                                                       class="blanco ${primera ? `text-light` : ``}">${post.fecha}</span>
                                        </small>
                                    </div>
                                    <small>
                                        <i class="bi bi-person-circle"></i>
                                        <b>${ post.name }</b>
                                    </small>
                                </a>
                            `;
                        }
                        primera = false;
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
                    this.lastPostId = lpresp[0].id;
                    console.log(this.lastPostId);
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
        //console.table(post);
        return `<div class="w-100 border-bottom mt-4 bg-body rounded-5 p-4">
                    <h5 class="mb-1">${post[0].title}</h5>
                    <small class="text-muted mt-3"> 
                        <i class="bi bi-person-circle mx-1"></i>${post[0].name} | 
                        <i class="bi bi-calendar-week mx-1"></i>${post[0].fecha} 
                    </small>
                    <p class="mt-2 pb-3 border-bottom fs-5" style="text-align:justify;">
                        ${post[0].body}
                    </p>



                    <!-- I  N  T  E  R  A  C  C  I  O  N  E  S -->
                    <a href="#" class="btn btn-link btn-sm text-decoration-none ${this.user.sv ? '' : 'disabled'}" style="color:blue;"
                        onclick="app.toggleLike(event, ${app.user.id}, ${post[0].id}, this, ${post[3].id}, ${post[5].id}, ${post[7].id})">
                        <i class="bi bi-hand-thumbs-up${post[3].tt > 0 ? '-fill' : ''}"
                            id="like${post[3].id}"></i> <span id="likes">${post[2].tt}</span>
                    </a>

                    <a href="#" class="btn btn-link btn-sm text-decoration-none ${this.user.sv ? '' : 'disabled'}" style="color:red;"
                        onclick="app.toggleDislike(event, ${app.user.id}, ${post[0].id}, this, ${post[3].id}, ${post[5].id}, ${post[7].id})">
                        <i class="bi bi-hand-thumbs-down${post[5].tt > 0 ? '-fill' : ''}"
                            id="dislike${post[5].id}"></i> <span id="dislikes">${post[4].tt}</span>
                    </a>

                    <a href="#" class="btn btn-link btn-sm text-decoration-none ${this.user.sv ? '' : 'disabled'}" style="color:#f4d03f;"
                        onclick="app.toggleHaha(event, ${app.user.id}, ${post[0].id}, this, ${post[3].id}, ${post[5].id}, ${post[7].id})">
                        <i class="bi bi-emoji-laughing${post[7].tt > 0 ? '-fill' : ''}"
                            id="haha${post[7].id}"></i> <span id="hahas">${post[6].tt}</span>
                    </a>



                    <!-- C  O  M  E  N  T  A  R  I  O  S -->
                    <p class="float-end">
                        <span id="comentarios">
                            <a href="#" role="button"
                                onclick="app.toggleComments(event, ${post[0].id}, '#post-comments')"
                                class="btn btn-link btn-sm text-decoration-none link-secondary ${ post[1].tt > 0 ? '' : 'disabled'}">
                                <i class="bi bi-chat-right"></i> 
                                ${ post[1].tt } ${post[1].tt == 1 ? 'comentario' : 'comentarios'}
                            </a>
                        </span>
                    </p>

                    <div class="input-group mt-3 mb-2">
                        <input type="text" class="form-control rounded-5 bg-body-secondary" ${this.user.sv ? '' : 'disabled readonly'}
                            placeholder="${this.user.sv ? 'Deja tu comentario...' : 'Ingresa para poder realizar comentarios'}" 
                            name="comment" id="comment"
                            aria-label="Deja tu comentario..." 
                            aria-describedby="button-addon2" required>
                        <button class="btn btn-outline-secondary rounded-5" type="button" 
                         id="button-addon2" onclick="app.saveComment(${post[0].id});"
                         ${this.user.sv ? '' : 'disabled'}>
                            <i class="bi bi-send"></i>
                        </button>
                    </div>
                    <div class="container mb-2 fs-6">
                        <ul class="list-group d-none" id="post-comments"></ul>
                    </div>
                </div>
            `;
    },

    toggleLike : function (e, uid, pid, anchor, likeid, dislikeid, hahaid) {
        e.preventDefault();
        fetch(this.routes.togglelike + "&uid=" + uid + "&pid=" + pid)
            .then( response => response.json())
            .then( likes => {
                var iconli = document.querySelector('#like' + likeid);
                iconli.classList.toggle('bi-hand-thumbs-up');
                iconli.classList.toggle('bi-hand-thumbs-up-fill');
                $("#likes").html(likes[0].tt);
                likesValue = likes[0].tt;

                var icondis = document.querySelector('#dislike' + dislikeid);
                icondis.classList.remove('bi-hand-thumbs-down-fill');
                icondis.classList.add('bi-hand-thumbs-down');
                if (dislikesValue > 0) {dislikesValue--;}
                $("#dislikes").html(dislikesValue);

                var iconha = document.querySelector('#haha' + hahaid);
                iconha.classList.remove('bi-emoji-laughing-fill');
                iconha.classList.add('bi-emoji-laughing');
                if (hahasValue > 0) {hahasValue--;}
                $("#hahas").html(hahasValue);
            }).catch(err => console.error("Hubo un error: ", err));
    },

    toggleDislike : function (e, uid, pid, anchor, likeid, dislikeid, hahaid) {
        e.preventDefault();
        fetch(this.routes.toggledislike + "&uid=" + uid + "&pid=" + pid)
            .then( response => response.json())
            .then( dislikes => {
                var icondis = document.querySelector('#dislike' + dislikeid);
                icondis.classList.toggle('bi-hand-thumbs-down');
                icondis.classList.toggle('bi-hand-thumbs-down-fill');
                $("#dislikes").html(dislikes[0].tt);
                dislikesValue = dislikes[0].tt;

                var iconli = document.querySelector('#like' + likeid);
                iconli.classList.remove('bi-hand-thumbs-up-fill');
                iconli.classList.add('bi-hand-thumbs-up');
                if (likesValue > 0) {likesValue--;}
                $("#likes").html(likesValue);

                var iconha = document.querySelector('#haha' + hahaid);
                iconha.classList.remove('bi-emoji-laughing-fill');
                iconha.classList.add('bi-emoji-laughing');
                if (hahasValue > 0) {hahasValue--;}
                $("#hahas").html(hahasValue);
            }).catch(err => console.error("Hubo un error: ", err));
    },

    toggleHaha : function (e, uid, pid, anchor, likeid, dislikeid, hahaid) {
        e.preventDefault();
        fetch(this.routes.togglehaha + "&uid=" + uid + "&pid=" + pid)
            .then( response => response.json())
            .then( hahas => {
                var iconha = document.querySelector('#haha' + hahaid);
                iconha.classList.toggle('bi-emoji-laughing');
                iconha.classList.toggle('bi-emoji-laughing-fill');
                $("#hahas").html(hahas[0].tt);
                hahasValue = hahas[0].tt;
                //otraFuncion(hahas[0].tt);

                var icondis = document.querySelector('#dislike' + dislikeid);
                icondis.classList.remove('bi-hand-thumbs-down-fill');
                icondis.classList.add('bi-hand-thumbs-down');
                if (dislikesValue > 0) {dislikesValue--;}
                $("#dislikes").html(dislikesValue);

                var iconli = document.querySelector('#like' + likeid);
                iconli.classList.remove('bi-hand-thumbs-up-fill');
                iconli.classList.add('bi-hand-thumbs-up');
                if (likesValue > 0) {likesValue--;}
                $("#likes").html(likesValue);
            }).catch(err => console.error("Hubo un error: ", err));
    },

    toggleComments : function (e,pid,element) {
        if(e){
            e.preventDefault();
            $(element).toggleClass("d-none");
        }else{
            $(element).removeClass("d-none");
        }
        fetch(this.routes.postcomments + "&pid=" + pid)
            .then( resp => resp.json())
            .then( comments => {
                if (comments.length > 0) {
                    let html = "";
                    for (let c of comments) {
                        html += `
                            <li class="list-group-item">
                                <p class="fw-bold mb-0">${c.name}</p>
                                <p>${c.comment}</p>
                            </li>
                        `;
                    }
                    $(element).html(html);
                }
            }).catch(err => console.error("Hay un error: ", err ));
    },

    saveComment : function (pid, uid) {
        if($("#comment").val() !== ""){
            const commentInput = $("#comment");
            const commentText = commentInput.val().trim();

            if(commentText != ""){
                const datos = new FormData();
                datos.append('pid',pid);
                datos.append("comment",$("#comment").val());
                datos.append('_sc',"");
                fetch(this.routes.savecomment,{
                    method:"POST",
                    body: datos
                }).then( () => {
                    $("#comment").val("");
                    this.toggleComments(null,pid,"#post-comment");
                }).catch(err => console.error("Hay un error: ", err));
            }
        }
    },
}