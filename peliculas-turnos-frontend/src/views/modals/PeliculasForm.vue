<template>
  <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded shadow-md w-full max-w-md relative">
      <h2 class="text-xl font-bold mb-4">{{ pelicula?.id ? 'Editar Película' : 'Nueva Película' }}</h2>

      <form @submit.prevent="enviarFormulario">
        <div class="mb-4">
          <label class="block mb-1 font-medium">Título</label>
          <input v-model="form.titulo" class="w-full border rounded p-2" required />
        </div>

        <div class="mb-4">
          <label class="block mb-1 font-medium">Género</label>
          <input v-model="form.genero" class="w-full border rounded p-2" required />
        </div>

        <div class="mb-4">
          <label class="block mb-1 font-medium">Año</label>
          <input v-model="form.anio" type="number" class="w-full border rounded p-2" required />
        </div>

        <div class="flex justify-end space-x-2 mt-6">
          <button type="button" @click="$emit('cancelar')" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancelar</button>
          <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Guardar</button>
        </div>
      </form>

      <!-- Botón para cerrar (esquina) -->
      <button @click="$emit('cancelar')" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-xl">×</button>
    </div>
  </div>
</template>

<script>
export default {
  props: ['pelicula'],
  data() {
    return {
      form: {
        titulo: '',
        genero: '',
        anio: ''
      }
    }
  },
  watch: {
    pelicula: {
      immediate: true,
      handler(nueva) {
        this.form = nueva
          ? { ...nueva }
          : { titulo: '', genero: '', anio: '' }
      }
    }
  },
  methods: {
    enviarFormulario() {
      this.$emit('guardar', { ...this.form })
    }
  }
}
</script>
