<template>
  <div class="p-6">
    <div class="flex justify-between items-center mb-4">
      <div>
        <h2 class="text-xl font-semibold text-gray-800">Turnos</h2>
        <p class="text-sm text-gray-500">Listado de turnos disponibles.</p>
      </div>
      <button
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded"
        @click="abrirModalCrear"
      >
        Nuevo Turno
      </button>
    </div>

    <div v-if="cargando" class="flex justify-center items-center h-40">
      <div class="animate-spin rounded-full h-10 w-10 border-t-4 border-violet-600"></div>
    </div>

    <table  v-else class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Id</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Inicio</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelicula</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="turno in turnos" :key="turno.id" class="hover:bg-gray-50">
          <td class="px-6 py-4 text-sm text-gray-700">{{ turno.id }}</td>
          <td class="px-6 py-4 text-sm text-gray-700">{{ turno.hora_inicio }}</td>
          <td class="px-6 py-4">
            <span
              v-if="turno.estado === 'activo'"
              class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
            >
              Activo
            </span>
            <span
              v-else
              class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800"
            >
              Inactivo
            </span>
          </td>
          <td class="px-6 py-4 italic text-sm text-gray-700">
            {{ turno.pelicula?.titulo || 'No asignado' }}
          </td>
          <td class="px-6 py-4 text-left space-x-2">
            <button @click="editarTurno(turno)" class="text-blue-600 hover:underline text-sm">✏️</button>
           <button @click="confirmarEliminar(turno)" class="text-red-600 hover:underline text-sm">🗑️</button>

          </td>
        </tr>
      </tbody>
    </table>

    <!-- Modal Crear/Editar -->
    <TurnoModal
      :visible="mostrarModal"
      :editMode="modoEditar"
      :modelValue="turnoSeleccionado"
      @update:visible="mostrarModal = $event"
      @save="guardarTurno"
    />

    <!-- Notificación -->
    <NotificationToast
      v-if="notificacion.mostrar"
      :mensaje="notificacion.mensaje"
      @cerrado="notificacion.mostrar = false"
    />
    <ModalConfirmarEliminar
      v-if="mostrarConfirmacionEliminar"
      @cancelar="mostrarConfirmacionEliminar = false"
      @confirmar="realizarEliminacion"
    />

  </div>
</template>

<script>
import TurnoService from '@/services/TurnoService'
import NotificationToast from '@/components/notificaciones/NotificationToast.vue'
import ModalConfirmarEliminar from '@/components/modals/ModalConfirmarEliminar.vue'
import TurnoModal from '@/components/modals/TurnoModal.vue'

export default {
  components: {
    TurnoModal,
    NotificationToast,
    ModalConfirmarEliminar
  },
  data() {
    return {
      turnos: [],
      mostrarModal: false,
      cargando: false,
      modoEditar: false,
      turnoSeleccionado: null,
      notificacion: {
        mostrar: false,
        mensaje: ''
      },
      mostrarConfirmacionEliminar: false,
      turnoAEliminar: null
    }
  },
  mounted() {
    this.obtenerTurnos()
  },
  methods: {
    async obtenerTurnos() {
      this.cargando = true
      try {
      const res = await TurnoService.getAll()
      this.turnos = res.data
      } catch (error) {
      this.notificacion.mensaje = 'Error al cargar los turnos'
      this.notificacion.mostrar = true
      } finally {
      this.cargando = false
      }
    },
    abrirModalCrear() {
      this.turnoSeleccionado = {
        hora_inicio: '',
        hora_fin: '',
        sala: '',
        estado: 'activo'
      }
      this.modoEditar = false
      this.mostrarModal = true
    },
    editarTurno(turno) {
      this.turnoSeleccionado = { ...turno }
      this.modoEditar = true
      this.mostrarModal = true
    },
    async guardarTurno(data) {
      if (this.modoEditar) {
        await TurnoService.update(this.turnoSeleccionado.id, data)
        this.notificacion.mensaje = 'Turno actualizado exitosamente'
      } else {
        await TurnoService.create(data)
        this.notificacion.mensaje = 'Turno creado exitosamente'
      }
      this.notificacion.mostrar = true
      this.mostrarModal = false
      this.obtenerTurnos()
    },
        confirmarEliminar(turno) {
      this.turnoAEliminar = turno
      this.mostrarConfirmacionEliminar = true
    },
    async realizarEliminacion() {
      await TurnoService.delete(this.turnoAEliminar.id)
      this.notificacion.mensaje = 'Turno eliminado exitosamente'
      this.notificacion.mostrar = true
      this.turnoAEliminar = null
      this.mostrarConfirmacionEliminar = false
      this.obtenerTurnos()
    },

  }
}
</script>
