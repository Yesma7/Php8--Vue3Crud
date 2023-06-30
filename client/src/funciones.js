import Swal from "sweetalert2"
import axios from 'axios'

export function mostrar_alerta(mensaje, icono, foco='') {
    if(foco != '') {
        document.getElementById(foco).focus();
    }
    Swal.fire({
        title: mensaje,
        icon: icono,
        customClass: {
            confirmButton: 'btn btn-primary',
            popup: 'animated zoomIn'
        },
        buttonsStyling: false
    })
}

export function confirmar(id, nombre) {
    let url = 'http://localhost/Vuety/Solutions/Php/Crud/server/api/eliminar.php'

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success me-3',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
        title: `¿Estas seguro de eliminar el registro ${nombre}?`,
        text: 'Si lo haces se perderá todo',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: '<i class="fa-solid fa-check"></i> Si, eliminar',
        cancelButtonText: '<i class="fa-solid fa-ban"></i> Mejor no'
    }).then((ressult) => {
        if(ressult.isConfirmed) {
            enviarSolicitud('delete',{id:id}, url, 'Empleado Eliminado')
        } else {
            mostrar_alerta('Operación cancelada', 'info')
        }
    })
}

export function enviarSolicitud(metodo, parametros, url, mensaje) {
    console.log(parametros)

    axios({method:metodo, url:url, data:parametros}).then(function(respuesta) {
        let status = respuesta.data
        console.log(status)

        if(status === 'success') {
            mostrar_alerta(mensaje, status)
            window.setTimeout(function () {
                window.location.href='/'
            },1000)
        } else {
            let listado = ''

            let errores = respuesta[1]['errors']
            Object.keys(errores).forEach(
                key=>listado+=errores[key][0]+'.'
            )
            mostrar_alerta(listado, 'error')
        }
    }).catch(function (error) {
        mostrar_alerta('Error en la solicitud', 'error')
    })
}