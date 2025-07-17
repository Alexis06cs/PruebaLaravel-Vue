<template>
  <transition name="fade">
    <div class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
      <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg transform transition-all duration-300 scale-95 hover:scale-100">
        <h2 class="text-xl font-semibold mb-4">Asignar turno a "{{ pelicula?.titulo }}"</h2>

        <div v-if="turnos.length">
          <ul class="space-y-3">
            <li
              v-for="turno in turnos"
              :key="turno.id"
              class="flex justify-between items-center border-b pb-2"
            >
              <div>
                <p class="text-sm font-medium text-gray-800">Hora: {{ turno.hora_inicio }} - {{ turno.hora_fin }}</p>
                <p class="text-xs text-gray-500">Sala: {{ turno.sala }}</p>
              </div>
              <button
                class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 text-sm"
                @click="asignar(turno.id)"
              >
                Asignar
              </button>
            </li>
          </ul>
        </div>
        <div v-else class="text-gray-600 text-sm italic">
          No hay turnos disponibles para asignar.
        </div>

        <div class="mt-6 text-right">
          <button @click="$emit('cerrar')" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
            Cerrar
          </button>
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
export default {
  props: {
    pelicula: Object,
    turnos: Array
  },
  emits: ['cerrar', 'asignar'],
  methods: {
    asignar(turnoId) {
      this.$emit('asignar', turnoId)
    }
  }
}
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
