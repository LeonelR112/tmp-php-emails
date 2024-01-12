
// devuelve el día de la semana según una fecha
function diaDeLaSemana(fecha){
    let dia = [
    'Lunes',
    'Martes',
    'Miércoles',
    'Jueves',
    'Viernes',
    'Sábado',
    'Domingo'][new Date(fecha).getDay()];
    return dia;
}