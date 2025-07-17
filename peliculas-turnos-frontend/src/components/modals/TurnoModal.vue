<template>
  <div v-if="visible" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md relative">
      <h2 class="text-xl font-bold mb-4">{{ editMode ? 'Editar Turno' : 'Nuevo Turno' }}</h2>

      <form @submit.prevent="handleSubmit" class="space-y-4">
        <div>
          <label class="block text-sm font-medium">Hora inicio</label>
          <input type="time" v-model="turno.hora_inicio" class="w-full border px-3 py-2 rounded" required />
        </div>

        <div>
          <label class="block text-sm font-medium">Hora fin</label>
          <input type="time" v-model="turno.hora_fin" class="w-full border px-3 py-2 rounded" required />
        </div>

        <div>
          <label class="block text-sm font-medium">Sala</label>
          <input type="text" v-model="turno.sala" class="w-full border px-3 py-2 rounded" required />
        </div>

        <div>
          <label class="block text-sm font-medium">Película</label>
          <select v-model="turno.pelicula_id" class="w-full border px-3 py-2 rounded">
            <option value="">No asignada</option>
            <option v-for="pelicula in peliculas" :key="pelicula.id" :value="pelicula.id">
              {{ pelicula.titulo }}
            </option>
          </select>
        </div>

        <div class="flex items-center">
          <input type="checkbox" v-model="turno.estadoActivo" class="mr-2" id="estado">
          <label for="estado">¿Activo?</label>
        </div>

        <div class="flex justify-end gap-2">
          <button type="button" class="px-4 py-2 bg-gray-400 text-white rounded" @click="cerrar">Cancelar</button>
          <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">
            {{ editMode ? 'Actualizar' : 'Guardar' }}
          </button>
        </div>
      </form>

      <button class="absolute top-2 right-3 text-gray-500 hover:text-black" @click="cerrar">✖</button>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: {
    visible: Boolean,
    editMode: Boolean,
    modelValue: Object
  },
  emits: ['update:visible', 'save'],
  data() {
    return {
      turno: {
        hora_inicio: '',
        hora_fin: '',
        sala: '',
        pelicula_id: '',
        estadoActivo: true
      },
      peliculas: []
    };
  },
  watch: {
    modelValue: {
      immediate: true,
      handler(newVal) {
        if (newVal) {
          this.turno = {
            ...newVal,
            estadoActivo: newVal.estado === 'activo'
          };
        } else {
          this.turno = {
            hora_inicio: '',
            hora_fin: '',
            sala: '',
            pelicula_id: '',
            estadoActivo: true
          };
        }
      }
    }
  },
  mounted() {
    this.cargarPeliculas();
  },
  methods: {
    async cargarPeliculas() {
      try {
        const res = await axios.get('http://127.0.0.1:8000/api/peliculas');
        this.peliculas = res.data;
      } catch (error) {
        console.error('Error cargando películas:', error);
      }
    },
    handleSubmit() {
      const data = {
        ...this.turno,
        estado: this.turno.estadoActivo ? 'activo' : 'inactivo'
      };
      this.$emit('save', data);
      this.cerrar();
    },
    cerrar() {
      this.$emit('update:visible', false);
    }
  }
};
</script>
