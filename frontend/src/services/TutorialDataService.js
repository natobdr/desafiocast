import http from "../http-common";

class TutorialDataService {
  getAll() {
    return http.get("/categorias");
  }

  get(id) {
    return http.get(`/categorias/${id}`);
  }

  create(data) {
    console.log(data);
    return http.post(`/categorias/${data.title}`, data);
  }

  update(id, data) {
    return http.put(`/categorias/${id}`, data.title);
  }

  delete(id) {
    return http.delete(`/categorias/${id}`);
  }

  deleteAll() {
    return http.delete(`/categorias`);
  }

  findByTitle(title) {
    return http.get(`/categorias?title=${title}`);
  }
}

export default new TutorialDataService();
