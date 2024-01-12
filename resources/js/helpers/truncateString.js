/**
 * Corta una cadena de string según la cantidad de caracteres a mostrar
 */
function truncateString(string, numero) {
    if (string.length > numero) {
        return string.slice(0, numero) + "...";
    } else {
        return string;
    }
}