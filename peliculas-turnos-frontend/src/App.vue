<template>
  <div class="w-full bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <nav class="flex justify-center space-x-8 border-b border-gray-200 py-4" aria-label="Tabs">
        <router-link
          to="/peliculas"
          class="inline-flex items-center px-1 border-b-2 text-sm font-medium"
          :class="$route.path === '/peliculas'
            ? 'border-indigo-500 text-indigo-600'
            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
        >
          🎬 Películas
        </router-link>

        <router-link
          to="/turnos"
          class="inline-flex items-center px-1 border-b-2 text-sm font-medium"
          :class="$route.path === '/turnos'
            ? 'border-indigo-500 text-indigo-600'
            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
        >
          🕒 Turnos
        </router-link>
      </nav>
    </div>
  </div>

  <div class="max-w-7xl mx-auto p-4">
    <router-view />
  </div>
</template>
