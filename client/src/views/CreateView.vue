<template>
    <div class="row mt-3">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header bg-dark text-white text-center">
                    <h1>Crear Empleado</h1>
                </div>

                <div class="card-body">
                    <form v-on:submit="guardar">
                        <div class="row">
                            <div class="col">
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fa-regular fa-address-card"></i></span>
                                    <input v-model="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre">
                                </div>
                            </div>

                            <div class="col">
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fa-regular fa-address-card"></i></span>
                                    <input v-model="apellido" name="apellido" type="text" class="form-control" placeholder="Apellido">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-regular fa-envelope"></i></span>
                                <input v-model="correo" name="correo" type="email" class="form-control" placeholder="Email">
                            </div>
                        </div>

                        <div class="d-grid col-6 mx-auto">
                            <button class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mostrar_alerta, enviarSolicitud } from '@/funciones'

export default {
    data() {
        return {
            nombre: '',
            apellido: '',
            correo: '',
            url: 'http://localhost/Vuety/Solutions/Php/Crud/server/api/crear.php'
        }
    },
    methods: {
        guardar() {
            event.preventDefault()
            if (this.nombre.trim() === '') {
                mostrar_alerta('El campo Nombre es obligatorio', 'warning', 'nombre')
            } else if (this.apellido.trim() === '') {
                mostrar_alerta('El campo Apellidos es obligatorio', 'warning', 'apellido')
            } else if (this.correo.trim() === '') {
                mostrar_alerta('El campo Email es obligatorio', 'warning', 'email')
            } else {
                let parametros = {nombre: this.nombre.trim(),apellido: this.apellido.trim(),correo: this.correo.trim()}
                enviarSolicitud('POST', parametros, this.url, 'Empleado Guardado')
                console.log(parametros)
            }
        }
    }
}
</script>