<template>
  <div class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-lg animate-fade-in">
      <h2 class="text-lg font-semibold text-gray-800 mb-4">¿Estás seguro?</h2>
      <p class="text-sm text-gray-600">Esta acción eliminará el turno permanentemente.</p>
      <div class="mt-6 flex justify-end space-x-3">
        <button @click="$emit('cancelar')" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
          Cancelar
        </button>
        <button @click="$emit('confirmar')" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
          Eliminar
        </button>
      </div>
    </div>
  </div>
</template>

<style scoped>
@keyframes fade-in {
  from {
    opacity: 0;
    transform: scale(0.95);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}
.animate-fade-in {
  animation: fade-in 0.2s ease-out;
}
</style>
