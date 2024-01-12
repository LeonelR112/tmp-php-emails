let form_enviar = document.querySelector('form');
let form_chekcs_plantillas = document.getElementsByClassName('form-check-input');
let input_email = document.getElementById('input_email');
let msgEmail = document.getElementById('msgEmail');
let msgPlantillas = document.getElementById('msgPlantillas');

form_enviar.addEventListener('submit', e => {
    e.preventDefault();

    if(validarEmail() && validarPlantilla()){
        button_submit.setAttribute('disabled', '');
        button_submit.innerHTML = `
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div> Guardando...
        `;
        form_enviar.submit();
    }
})

function validarEmail(){
    let regWl = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    let valor_email = input_email.value;
    if(valor_email.length == 0){
        input_email.classList.add('is-invalid');
        msgEmail.innerHTML = `Ingrese un email`;
        return false;
    }
    else if(!regWl.test(valor_email)){
        input_email.classList.add('is-invalid');
        msgEmail.innerHTML = `El email ingresado no es válido!`;
        return false;
    }
    else{
        input_email.classList.remove('is-invalid');
        msgEmail.innerHTML = ``;
        return true;
    }
}

function validarPlantilla(){
    let plantilla_seleccionada = null;
    for(let check of form_chekcs_plantillas){ check.checked ? plantilla_seleccionada = check.value : ""};
    if(plantilla_seleccionada == null){
        msgPlantillas.innerHTML = `Debe seleccionar una plantilla para enviar el email!`;
        return false;
    }
    else{
        msgPlantillas.innerHTML  = '';
        return true;
    }
}