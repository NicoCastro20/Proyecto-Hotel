// =========================================================
// 1. FUNCIONES GLOBALES PARA EL MODAL (¡NECESARIAS PARA ONCLICK!)
// =========================================================

/**
 * Muestra el modal personalizado con un mensaje y estilo navideño.
 @param {string} mensaje
 * @param {boolean} esCorrecto - True para estilo Correcto (verde), False para estilo Incorrecto (rojo).
 */
function mostrarModal(mensaje, esCorrecto) {
    const modal = document.getElementById('modalNavidad');
    const modalMensaje = document.getElementById('modalMensaje');
    const modalContenido = document.querySelector('.modal-contenido');

    if (!modal) {
        // En caso de que el modal HTML no exista, usa una alerta simple como fallback
        alert(mensaje);
        return;
    }

    // 1. Establecer el mensaje
    modalMensaje.textContent = mensaje;

    // 2. Aplicar estilos según si es correcto o incorrecto
    if (esCorrecto) {
        modalContenido.style.backgroundColor = '#27AE60'; // Verde de Navidad
        modalMensaje.style.color = '#FFFFFF'; // Texto blanco
    } else {
        modalContenido.style.backgroundColor = '#C0392B'; // Rojo de Navidad
        modalMensaje.style.color = '#F7DC6F'; // Texto dorado
    }

    // 3. Mostrar el modal
    modal.style.display = 'block';
}

/**
 * Oculta el modal personalizado.
 */
function cerrarModal() {
    const modal = document.getElementById('modalNavidad');
    if (modal) {
        modal.style.display = 'none';
    }
}


// =========================================================
// 2. FUNCIÓN PRINCIPAL DE VERIFICACIÓN
// =========================================================

/**
 * Verifica la respuesta seleccionada y actualiza la interfaz (imagen, divs).
 * @param {string} pregunta - El identificador de la pregunta actual (ej: "pregunta1").
 */
function verificarRespuesta(pregunta) {
    // Obtener el valor seleccionado del grupo de entrantes
    const opciones = document.getElementsByName('entrante');
    let seleccionada = null;

    // Buscar cuál opción está seleccionada
    for (let i = 0; i < opciones.length; i++) {
        if (opciones[i].checked) {
            seleccionada = opciones[i].value;
            break;
        }
    }

    // Verificar si se seleccionó alguna opción
    if (seleccionada === null) {
        // Usamos el modal navideño para esta alerta también
        mostrarModal("Por favor, selecciona una respuesta antes de continuar.", false);
        return; // Detiene la ejecución si no hay selección
    }

    // Creamos las variables para controlar el nivel de difuminado
    let img_difuminar = null;
    let difuminado = null;
    let div_aparece = null;
    let div_desaparece = null;
    let respuestaCorrecta = null; 

    // Definimos la respuesta correcta para cada pregunta
    switch (pregunta) {
        case "pregunta1":
            respuestaCorrecta = "respuesta2";
            img_difuminar = "img_entrantes";
            difuminado = "blur(6px)";
            div_desaparece = "div_p1";
            div_aparece = "div_p2";
            break;
        case "pregunta2":
            respuestaCorrecta = "respuesta8";
            img_difuminar = "img_entrantes";
            difuminado = "blur(3px)";
            div_desaparece = "div_p2";
            div_aparece = "div_p3";
            break;
        case "pregunta3":
            respuestaCorrecta = "respuesta11";
            img_difuminar = "img_entrantes";
            difuminado = "blur(0px)";
            div_desaparece = "div_p3";
            div_aparece = "div_continuar";
            break;
        case "pregunta4":
            respuestaCorrecta = "resp_prin2";
            img_difuminar = "img_principales";
            difuminado = "blur(6px)";
            div_desaparece = "div_p1";
            div_aparece = "div_p2";
            break;
        case "pregunta5":
            respuestaCorrecta = "resp_prin5";
            img_difuminar = "img_principales";
            difuminado = "blur(3px)";
            div_desaparece = "div_p2";
            div_aparece = "div_p3";
            break;
        case "pregunta6":
            respuestaCorrecta = "resp_prin11";
            img_difuminar = "img_principales";
            difuminado = "blur(0px)";
            div_desaparece = "div_p3";
            div_aparece = "div_continuar";
            break;
        case "pregunta7":
            respuestaCorrecta = "resp_postre3";
            img_difuminar = "img_postres";
            difuminado = "blur(5px)";
            div_desaparece = "div_p1";
            div_aparece = "div_p2";
            break;
        case "pregunta8":
            respuestaCorrecta = "resp_postre8";
            img_difuminar = "img_postres";
            difuminado = "blur(0px)";
            div_desaparece = "div_p2";
            div_aparece = "div_continuar";
            break;
        case "pregunta9":
            respuestaCorrecta = "resp_bebida4";
            img_difuminar = "img_bebidas";
            difuminado = "blur(9px)";
            div_desaparece = "div_p1";
            div_aparece = "div_p2";
            break;
        case "pregunta10":
            respuestaCorrecta = "resp_bebida7";
            img_difuminar = "img_bebidas";
            difuminado = "blur(6px)";
            div_desaparece = "div_p2";
            div_aparece = "div_p3";
            break;
        case "pregunta11":
            respuestaCorrecta = "resp_bebida10";
            img_difuminar = "img_bebidas";
            difuminado = "blur(3px)";
            div_desaparece = "div_p3";
            div_aparece = "div_p4";
            break;
        case "pregunta12":
            respuestaCorrecta = "resp_bebida9";
            img_difuminar = "img_bebidas";
            difuminado = "blur(0px)";
            div_desaparece = "div_p4";
            div_aparece = "div_continuar";
            break;
        default:
            respuestaCorrecta = "ninguna";
    }

    // Verificar si la respuesta es correcta
    if (seleccionada === respuestaCorrecta) {
        // LLAMADA AL MODAL CORRECTO
        mostrarModal("¡Respuesta correcta! 🔔 ¡Felices Fiestas!", true); 

        // Aplicar la lógica de transición
        const imgElement = document.getElementById(img_difuminar);
        const divDesapareceElement = document.getElementById(div_desaparece);
        const divApareceElement = document.getElementById(div_aparece);

        if (imgElement) imgElement.style.filter = difuminado;
        if (divDesapareceElement) divDesapareceElement.style.display = "none";
        if (divApareceElement) divApareceElement.style.display = "block";
        
    } else {
        // LLAMADA AL MODAL INCORRECTO
        mostrarModal("¡Respuesta incorrecta! 🎁 Vuelve a intentarlo.", false); 
    }
}