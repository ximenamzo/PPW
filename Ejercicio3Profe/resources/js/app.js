const app = {

    routes : {
        inisession : "/resources/views/auth/login.php",
        endsession : "/app/app.php?_logout",
        login : "/app/app.php",
        prevposts : "/app/app.php?_pp",
    },
    pp : $("#prev-posts"),
    view : function(route){
        location.replace(this.routes[route]);
    },
    previousPosts : function(){
        let html = `<b>Aún no hay publicaciones en este blog</b>`;
        this.pp.html("");
        fetch(this.routes.prevposts)
            .then( resp => resp.json())
            .then( ppresp => {
                if( ppresp.length > 0){
                    html = "";
                    let primera = true;
                    for( let post of ppresp ){
                        html += `
                            <a href="#" onclick="app.openPost(event,${ post.id },this)"
                                class="list-group-item list-group-item-action ${ primera ? `active`:``} pplg">
                                <div class="w-100 border-bottom">
                                    <h5 class="mb-1">${ post.title }</h5>
                                    <small class="text-${ primera ? `light` : `muted` }">
                                        <i class="bi bi-calendar-week"></i> 
                                        ${ post.created_at }
                                    </small>
                                </div>
                                <small>
                                    <i class="bi bi-person-circle"></i>
                                    <b>${ post.name }</b>
                                </small>
                            </a>
                        `;
                        primera = false;
                    }
                    this.pp.html(html);
                }
            }).catch( err => console.error( err ));

    }
}