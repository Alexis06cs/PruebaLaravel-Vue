<template>
  <transition name="fade">
    <div
      v-if="visible"
      class="fixed top-5 right-5 bg-white border border-green-300 shadow-lg px-4 py-3 rounded-lg flex items-center space-x-3"
    >
      <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
        viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M5 13l4 4L19 7" />
      </svg>
      <span class="text-sm text-green-800">{{ mensaje }}</span>
      <button @click="cerrar" class="ml-2 text-gray-500 hover:text-gray-700">✖</button>
    </div>
  </transition>
</template>

<script>
export default {
  props: {
    mensaje: String,
    tiempo: {
      type: Number,
      default: 3000
    }
  },
  data() {
    return {
      visible: true
    }
  },
  mounted() {
    setTimeout(() => {
      this.visible = false
      this.$emit('cerrado')
    }, this.tiempo)
  },
  methods: {
    cerrar() {
      this.visible = false
      this.$emit('cerrado')
    }
  }
}
</script>


