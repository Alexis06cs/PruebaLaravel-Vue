import { createRouter, createWebHistory } from "vue-router";
import PeliculasView from "../views/PeliculasView.vue";
import TurnosView from "../views/TurnosView.vue";

const routes = [
  { path: "/", redirect: "/peliculas" },
  { path: "/peliculas", component: PeliculasView },
  { path: "/turnos", component: TurnosView },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
