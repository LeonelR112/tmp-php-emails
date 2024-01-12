let form_crear_mensajes = document.getElementById('form_crear_mensajes');
let input_asunto = document.getElementById('input_asunto');
let msgAsunto = document.getElementById('msgAsunto');
let input_link = document.getElementById('input_link');
let msgLink = document.getElementById('msgLink');
let input_mensaje = document.getElementById('input_mensaje');
let msgCuerpo = document.getElementById('msgCuerpo');
let input_submit = document.getElementById('input_submit');

form_crear_mensajes.addEventListener('submit', e => {
    e.preventDefault();

    if(validarAsunto() && validarMensaje()){
        input_submit.setAttribute('disabled', '');
        input_submit.innerHTML = `
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div> Guardando...
        `;
        form_crear_mensajes.submit();
    }
})

function validarAsunto(){
    let regbl = /[<>\'\"\`\=]+/;
    if(input_asunto.value.length == 0){
        input_asunto.classList.add("is-invalid");
        msgAsunto.innerHTML = `Ingrese un asunto`;
        return false;
    }
    else if(regbl.test(input_asunto.value)){
        input_asunto.classList.add("is-invalid");
        msgAsunto.innerHTML = `Asunto inválido!`;
        return false;
    }
    else{
        input_asunto.classList.remove("is-invalid");
        msgAsunto.innerHTML = ``;
        return true;
    }
}

function validarMensaje(){
    let contenido_mensaje = $('#input_mensaje').trumbowyg('html');
    if(contenido_mensaje.length == 0){
        input_mensaje.classList.add('is-invalid');
        msgCuerpo.innerHTML = `Debe ingresar un mensaje!`;
        return false;
    }
    else{
        input_mensaje.classList.remove('is-invalid');
        msgCuerpo.innerHTML = ``;
        return true;
    }
}

document.addEventListener('DOMContentLoaded', e => {
    $('#input_mensaje').trumbowyg({
        btns: [
            ['viewHTML'],
            ['foreColor', 'backColor'],
            ['undo', 'redo'],
            ['formatting'],
            ['strong', 'em', 'del'],
            ['superscript', 'subscript'],
            ['link'],
            ['insertImage'],
            ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
            ['unorderedList', 'orderedList'],
            ['horizontalRule'],
            ['removeformat'],
            ['emoji'],
            ['fullscreen']
        ],
        changeActiveDropdownIcon: true,
        urlProtocol: true,
        imageWidthModalEdit: true
    });

})