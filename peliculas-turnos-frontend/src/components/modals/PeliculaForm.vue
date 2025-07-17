<template>
  <div class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
    <div class="bg-white p-4 rounded-md shadow-md w-full max-w-sm relative">
      <h2 class="text-lg font-semibold mb-3 text-gray-800 text-center">
        {{ pelicula?.id ? 'Editar Película' : 'Nueva Película' }}
      </h2>

      <form @submit.prevent="enviarFormulario" class="space-y-3">
        <!-- Título -->
        <div>
          <label class="text-base/7 font-semibold text-gray-900">Título</label>
          <input
            v-model="form.titulo"
            type="text"
            class="w-full border rounded p-1.5 text-sm shrink-0 text-base text-gray-500 select-none sm:text-sm/6"
            :class="{ 'border-red-500': submitted && !form.titulo }"
           
          />
          <p v-if="submitted && !form.titulo" class="text-red-500 text-xs mt-1">Este campo es obligatorio.</p>
        </div>

        <!-- Descripción -->
        <div>
          <label class="block text-sm">Descripción</label>
          <textarea
            v-model="form.descripcion"
            rows="2"
            class="w-full border rounded p-1.5 text-sm"
            :class="{ 'border-red-500': submitted && !form.descripcion }"
            
          ></textarea>
          <p v-if="submitted && !form.descripcion" class="text-red-500 text-xs mt-1">El Titulo es obligatorio.</p>
        </div>

        <!-- Género -->
        <div>
          <label class="block text-sm">Género</label>
          <input
            v-model="form.genero"
            type="text"
            class="w-full border rounded p-1.5 text-sm"
            :class="{ 'border-red-500': submitted && !form.genero }"
           
          />
          <p v-if="submitted && !form.genero" class="text-red-500 text-xs mt-1">Este campo es obligatorio.</p>
        </div>

        <!-- Duración -->
        <div>
          <label class="block text-sm">Duración (min)</label>
          <input
            v-model.number="form.duracion"
            type="number"
            min="1"
            class="w-full border rounded p-1.5 text-sm"
            :class="{ 'border-red-500': submitted && !form.duracion }"
            
          />
          <p v-if="submitted && !form.duracion" class="text-red-500 text-xs mt-1">Debe indicar la duración en minutos.</p>
        </div>

        <!-- Fecha de estreno -->
        <div>
          <label class="block text-sm">Fecha de estreno</label>
          <input
            v-model="form.fecha_estreno"
            type="date"
            class="w-full border rounded p-1.5 text-sm"
            :class="{ 'border-red-500': submitted && !form.fecha_estreno }"
          
          />
          <p v-if="submitted && !form.fecha_estreno" class="text-red-500 text-xs mt-1">Seleccione una fecha válida.</p>
        </div>

    

        <!-- Botones -->
        <div class="flex justify-end gap-2 mt-3">
          <button
            type="button"
            @click="$emit('cancelar')"
            class="px-3 py-1 bg-gray-200 text-gray-800 text-sm rounded hover:bg-gray-300"
          >
            Cancelar
          </button>
          <button type="submit" class="px-3 py-1 bg-indigo-600 text-white text-sm rounded hover:bg-indigo-700">
            Guardar
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  props: ['pelicula'],
  data() {
    return {
      submitted: false,
      form: {
        titulo: '',
        descripcion: '',
        genero: '',
        duracion: '',
        fecha_estreno: ''
      }
    };
  },
  watch: {
    pelicula: {
      immediate: true,
      handler(nueva) {
        this.form = nueva
          ? { ...nueva }
          : {
              titulo: '',
              descripcion: '',
              genero: '',
              duracion: '',
              fecha_estreno: ''
            };
      }
    }
  },
  methods: {
    enviarFormulario() {
      this.submitted = true;
      if (
        !this.form.titulo ||
        !this.form.descripcion ||
        !this.form.genero ||
        !this.form.duracion ||
        !this.form.fecha_estreno

      ) {
        return;
      }

      this.$emit('guardar', { ...this.form });
    }
  }
};
</script>
