const formularios_ajax=document.querySelectorAll(".FormularioAjax");

function enviar_formulario_ajax(e){
    e.preventDefault();

    let send=confirm("¿Quieres enviar el formulario?");

    if(send==true){

        let data= new FormData(this);
        let method=this.getAttribute("method");
        let action=this.getAttribute("action");

        let headers= new Headers();

        let config={
            method: method,
            headers: headers,
            mode: 'cors',
            cache: 'no-cache',
            body: data
        };

        fetch(action,config)
        .then(answer => answer.text())
        .then(answer =>{ 
            let container=document.querySelector(".form-rest");
            container.innerHTML = answer;
        });
    }

}

formularios_ajax.forEach(formularios => {
    formularios.addEventListener("submit",enviar_formulario_ajax);
});

