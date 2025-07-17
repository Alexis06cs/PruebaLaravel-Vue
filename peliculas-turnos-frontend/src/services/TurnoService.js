import axios from 'axios';
const API = 'http://127.0.0.1:8000/api/turnos';

export default {
  getAll() {
    return axios.get(API);
  },
  getDisponibles() {
    return axios.get(`${API}/disponibles`);
  },
  create(turno) {
    return axios.post(API, turno);
  },
  asignarTurno(turnoId, peliculaId) {
    return axios.post(`${API}/asignar/${turnoId}`, { pelicula_id: peliculaId });
  },
  liberarTurno(turnoId) {
    return axios.post(`${API}/liberar/${turnoId}`);
  },
  delete(id) {
    return axios.delete(`${API}/${id}`);
  },
  update(id, turno) {
    return axios.put(`${API}/${id}`, turno);
  }
};
