// Función interna para mostrar cualquier tipo de toast
function toastBoostrap(type, cadena) { 
    // Verifica si la cadena no es indefinida ni nula, luego actualiza el contenido del toast y lo muestra
    try {
        $('#toast-' + type).toast('show');
        $('#text-' + type).html(cadena);
    } catch (error) {
        dangerToast(error)
    }finally{
        type = cadena = null;
    }
}

// Función para mostrar un toast de éxito con un mensaje específico
function questionToast(cadena, callback) { 
    toastBoostrap('question', cadena);

    // Asigna la función al evento de clic en el botón
    $('#toast-question-aceptar').off('click').on('click', function() {

        // Ejecuta la función proporcionada como callback
        if (typeof callback === 'function') {
            callback();
        }
    });
}
// Función para mostrar un toast de éxito con un mensaje específico
function successToast(cadena) { 
    toastBoostrap('success', cadena);
}

// Función para mostrar un toast de advertencia (warning)
function warningToast(cadena) { 
    toastBoostrap('warning', cadena);
}

// Función para mostrar un toast de peligro (danger)
function dangerToast(cadena) { 
    toastBoostrap('danger', cadena);
}

// Función para mostrar un toast de peligro (danger)
function infoToast(cadena) { 
    toastBoostrap('info', cadena);
}

$('.close').on('click', function(event) {
    // Obtiene el ID del elemento padre en el que se hizo clic
    var idDelElementoPadre = $(event.currentTarget).parent().parent().attr('id');
    $('#'+idDelElementoPadre).toast('hide');
});

$('.close-question ').on('click', function() {
    $('#toast-question').toast('hide');
});