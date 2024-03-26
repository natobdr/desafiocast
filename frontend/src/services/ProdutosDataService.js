import http from "../http-common";

class ProdutosDataService {
  getAll() {
    return http.get("/produtos");
  }

  get(id) {
    return http.get(`/produtos/${id}`);
  }

  create(data) {
    console.log(data);
    return http.post(`/produtos/${data.title}`, data);
  }

  update(id, data) {
    return http.put(`/produtos/${id}`, data.title);
  }

  delete(id) {
    return http.delete(`/produtos/${id}`);
  }

  deleteAll() {
    return http.delete(`/produtos`);
  }

  findByTitle(title) {
    return http.get(`/produtos?title=${title}`);
  }
}

export default new ProdutosDataService();
