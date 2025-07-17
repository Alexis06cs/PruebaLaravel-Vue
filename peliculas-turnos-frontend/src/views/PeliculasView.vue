<template>
  <div class="p-6 bg-white rounded-xl shadow">
    <div class="flex justify-between items-center mb-6">
      <div>
        <h2 class="text-xl font-semibold text-gray-800">Películas</h2>
        <p class="text-sm text-gray-500">Listado de películas disponibles en cartelera.</p>
      </div>
      <button
        @click="nuevaPelicula"
        class="px-4 py-2 bg-violet-600 text-white rounded hover:bg-violet-700 transition"
      >
        Nueva película
      </button>
    </div>
    <div v-if="cargando" class="flex justify-center items-center h-40">
      <div class="animate-spin rounded-full h-10 w-10 border-t-4 border-violet-600"></div>
    </div>

    <table  v-else class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">F. Publicación</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
          <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <tr v-for="p in peliculas" :key="p.id" class="hover:bg-gray-50">
          <td class="px-6 py-4 text-sm text-gray-700">{{ p.id }}</td>
          <td class="px-6 py-4 text-sm text-gray-900 font-medium">{{ p.titulo }}</td>
          <td class="px-6 py-4 text-sm text-gray-700">{{ formatFecha(p.fecha_estreno) }}</td>
          <td class="px-6 py-4">
            <span
              v-if="p.turnos && p.turnos.length"
              :class="p.turnos[0].estado === 'activo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
              class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
            >
              {{ capitalize(p.turnos[0].estado) }}
            </span>
            <span v-else class="text-gray-400 italic text-sm">Sin turno</span>
          </td>
          <td class="px-6 py-4 text-right space-x-2">
            <button @click="editarPelicula(p)" class="text-blue-600 hover:underline text-sm">✏️</button>
            <button @click="abrirModalTurnos(p)" class="text-yellow-500 hover:underline text-sm">≡</button>
            <button @click="verDetalles(p)" class="text-purple-600 hover:underline text-sm">📄</button>
            <button @click="confirmarEliminar(p)" class="text-red-600 hover:underline text-sm">🗑️</button>

          </td>
        </tr>
      </tbody>
    </table>

    <!-- Formulario Película -->
    <PeliculaForm
      v-if="mostrarFormulario"
      :pelicula="peliculaSeleccionada"
      @guardar="guardarPelicula"
      @cancelar="cancelar"
    />

    <!-- Modal para asignar turno -->
    <ModalAsignarTurno
      v-if="modalTurnos"
      :pelicula="peliculaSeleccionada"
      :turnos="turnosDisponibles"
      @asignar="asignarTurno"
      @cerrar="modalTurnos = false"
    />
    <ModalConfirmarEliminar
      v-if="mostrarModalEliminar"
      @cancelar="mostrarModalEliminar = false"
      @confirmar="realizarEliminacion"
    />
    <NotificationToast
      v-if="notificacion.mostrar"
      :mensaje="notificacion.mensaje"
      @cerrado="notificacion.mostrar = false"
    />


  </div>
</template>

<script>
import PeliculaService from '@/services/PeliculaService'
import TurnoService from '@/services/TurnoService'
import PeliculaForm from '@/components/modals/PeliculaForm.vue'
import ModalAsignarTurno from '@/components/modals/ModalAsignarTurno.vue'
import ModalConfirmarEliminar from '@/components/modals/ModalConfirmarEliminar.vue'
import NotificationToast from '@/components/notificaciones/NotificationToast.vue'

export default {
  components: {
    PeliculaForm,
    ModalAsignarTurno,
    ModalConfirmarEliminar,
    NotificationToast
  },
  data() {
    return {
      peliculas: [],
      turnosDisponibles: [],
      cargando: false,
      mostrarFormulario: false,
      peliculaSeleccionada: null,
      modalTurnos: false,
      peliculaAEliminar: null,
      mostrarModalEliminar: false,
      notificacion: {
        mostrar: false,
        mensaje: ''
      }


    }
  },
  methods: {
   cargarPeliculas() {
        this.cargando = true
        PeliculaService.getAll()
          .then(res => {
            this.peliculas = res.data
          })
          .finally(() => {
            this.cargando = false
          })
      },
    nuevaPelicula() {
      this.peliculaSeleccionada = null
      this.mostrarFormulario = true
    },
    editarPelicula(pelicula) {
      this.peliculaSeleccionada = { ...pelicula }
      this.mostrarFormulario = true
    },
    confirmarEliminar(pelicula) {
  this.peliculaAEliminar = pelicula
  this.mostrarModalEliminar = true
  },
realizarEliminacion() {
  PeliculaService.delete(this.peliculaAEliminar.id).then(() => {
    this.mostrarModalEliminar = false
    this.peliculaAEliminar = null
    this.cargarPeliculas()

    // Mostrar toast
    this.notificacion.mensaje = 'Película eliminada exitosamente'
    this.notificacion.mostrar = true
  })
},

    guardarPelicula(pelicula) {
  const operacion = pelicula.id
    ? PeliculaService.update(pelicula.id, pelicula)
    : PeliculaService.create(pelicula)

  operacion.then(() => {
    this.mostrarFormulario = false
    this.cargarPeliculas()

    this.notificacion.mensaje = pelicula.id
      ? 'Película actualizada exitosamente'
      : 'Película registrada exitosamente'

    this.notificacion.mostrar = true
  })
}
,
    cancelar() {
      this.mostrarFormulario = false
    },
    abrirModalTurnos(pelicula) {
      this.peliculaSeleccionada = pelicula
      TurnoService.getDisponibles().then(res => {
        this.turnosDisponibles = res.data
        this.modalTurnos = true
      })
    },
    asignarTurno(turnoId) {
      TurnoService.asignarTurno(turnoId, this.peliculaSeleccionada.id).then(() => {
        this.modalTurnos = false
        this.cargarPeliculas()
      })
    },
    verDetalles(p) {
      alert(`Detalles de: ${p.titulo}`)
    },
    formatFecha(fecha) {
      return new Date(fecha).toLocaleDateString('es-PE')
    },
    capitalize(text) {
      return text ? text.charAt(0).toUpperCase() + text.slice(1) : ''
    }
  },
  mounted() {
    this.cargarPeliculas()
  }
}
</script>
