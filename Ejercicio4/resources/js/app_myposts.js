const app_myposts = {
    
    url : "/PPW/Ejercicio4/app/app.php",

    mp : $("#my-posts"),

    getMyPosts : function(uid){
        let html = `<tr><td colspan="3">Aún no tiene publicaciones.</td></tr>`;
        this.mp.html("");
        fetch(this.url + "?_mp&uid=" + uid)
            .then(resp => resp.json())
            .then(mpresp => {
                if(mpresp.length > 0){
                    html = "";
                    for(let post of mpresp){
                        html += `
                            <tr>
                                <td>${post.title}</td>
                                <td>${post.created_at}</td>
                                <td>
                                    <a href="#" class="link-primary" onclick="app_myposts.modalShow(${post.id}, 'staticBackdrop${post.id}')">
                                        <i class="bi bi-eye"></i></a>
                                        <div class="modal fade" id="staticBackdrop${post.id}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel${post.id}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel${post.id}">${post.title}</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                </div>
                                                <div class="modal-body">
                                                    ${post.body}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    <!--<button type="button" class="btn btn-primary">Understood</button>-->
                                                </div>
                                                </div>
                                            </div>
                                        </div>


                                    <a href="#" class="link-primary mx-1" onclick="">
                                        <i class="bi bi-pencil-square"></i></a>
                                    <a href="#" class="link-success" onclick="">
                                        <i class="bi bi-toggle-on"></i></a>


                                    <a href="#" class="link-secondary mx-1" onclick="app_myposts.modalDelete(${post.id}, 'exampleModal${post.id}')">
                                        <i class="bi bi-trash"></i></a>
                                        <div class="modal fade" id="exampleModal${post.id}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel${post.id}">Eliminar publicaci&oacute;n</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Est&aacute;s seguro de querer borrar la siguiente publicaci&oacute;n?
                                                    <br>"${post.title}"<br>
                                                    <p id="confcom${post.id}"></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="app_myposts.deletePost(${post.id}, 'staticBd${post.id}', 'exampleModal${post.id}')" data-bs-toggle="modal" data-bs-target="#staticBd${post.id}">Continuar y Eliminar</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="staticBd${post.id}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBdLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBdLabel">Modal title</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Publicaci&oacute;n eliminada correctamente.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onClick="window.location.reload();">Cerrar</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>

                                </td>
                            </tr>
                            `;
                    }
                }
                this.mp.html(html);
            }).catch(err => console.error(err));
    },

    modalShow : function(pid, modalId) {
        //let modal = $('#staticBackdrop');
        let modal = $('#' + modalId);
        fetch(this.url + "?_op&pid=" + pid)
            .then(resp => resp.json())
            .then(post => {
                if(post.length > 0){
                    modal.modal('show');
                }
            })
            .catch(err => console.error(err));
    },

    modalDelete : function(pid, modalId) {
        let modal = $('#' + modalId);
        fetch(this.url + "?_cc&pid=" + pid)
            .then(resp => resp.json())
            .then(comments => {
                let commentCount = comments.length;
                if (commentCount > 0) {
                    $('#confcom' + pid).html('<br><p style="color:gray;">Esta publicaci&oacute;n tiene comentarios asociados.</p>');
                } else {
                    $('#confcom' + pid).html('');
                }
                modal.modal('show');
            })
            .catch(err => console.error(err));
    },

    deletePost : function(pid, modaldelId, thismid) {
        let thismodal = $('#' + thismid);
        let modaldel = $('#' + modaldelId);
        fetch(this.url + "?_dp&pid=" + pid)
            .then(resp => resp.json())
            .then(post => {
                if(post.length > 0){
                    thismodal.modal('hide');
                    modaldel.modal('show');
                }
            })
            .catch(err => console.error(err));
    },
}