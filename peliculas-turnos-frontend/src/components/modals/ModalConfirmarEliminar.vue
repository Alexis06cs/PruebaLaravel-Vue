<template>
  <div class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md">
      <div class="flex items-start space-x-3">
        <div class="text-red-600 mt-1">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M12 9v2m0 4h.01M4.93 4.93l14.14 14.14M4.93 19.07L19.07 4.93" />
          </svg>
        </div>
        <div>
          <h2 class="text-lg font-semibold text-gray-900">Eliminar película</h2>
          <p class="text-sm text-gray-600 mt-1">
            ¿Estás seguro de que deseas eliminar esta película? Esta acción no se puede deshacer.
          </p>
        </div>
      </div>
      <div class="mt-6 flex justify-end space-x-2">
        <button
          @click="$emit('cancelar')"
          class="px-4 py-2 rounded border border-gray-300 text-gray-700 hover:bg-gray-100"
        >
          Cancelar
        </button>
        <button
          @click="$emit('confirmar')"
          class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700"
        >
          Eliminar
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ModalConfirmarEliminar'
}
</script>
