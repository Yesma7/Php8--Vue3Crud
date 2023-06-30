<template>
  <div class="row">
    <div class="col-lg-8 offset-lg-2">
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Correo</th>
              <th>Acciones</th>
            </tr>
          </thead>

          <tbody class="table-group-divider" id="contenido">
            <tr v-for="emp, i in empleados" :key="emp.id">
              <td>{{ (i+1) }}</td>
              <td>{{ emp.nombre }}</td>
              <td>{{ emp.apellido }}</td>
              <td>{{ emp.correo }}</td>
              <td>
                <router-link :to="{path:'/update/'+emp.id}" class="btn btn-warning"><i class="fa-solid fa-edit"></i></router-link>
                &nbsp;
                <button class="btn btn-danger" @click="eliminar(emp.id, emp.nombre)"><i class="fa-solid fa-trash"></i></button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import { confirmar } from '@/funciones'

export default {
  name: 'HomeView',
  data() {
    return {
      empleados: null
    }
  },
  mounted() {
    this.getEmpleados();
  },
  methods: {
    getEmpleados() {
      axios.get('http://localhost/Vuety/Solutions/Php/Crud/server/api/leer_todos.php').then(
        response => (
          this.empleados = response.data
          )
      )
    },
    eliminar(id, nombre) {
      confirmar(id, nombre)
    }
  }
}
</script>
