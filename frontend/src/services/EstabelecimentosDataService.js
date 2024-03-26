import http from "../http-common";

class EstabelecimentosDataService {
  getAll() {
    return http.get("/estabelecimentos");
  }

  getCategoria() {
    return http.get("/categorias");
  }

  getProdutos(id) {
    return http.get(`/estabelecimentos/${id}`);
  }

  get(id) {
    return http.get(`/estabelecimentos/${id}`);
  }

  create(data) { 
    console.log(data);
    return http.post(`/estabelecimentos`, data);
 }

  update(id, data) {
    return http.put(`/estabelecimentos/${id}`, data.title);
  }

  delete(id) {
    return http.delete(`/estabelecimentos/${id}`);
  }

  deleteAll() {
    return http.delete(`/estabelecimentos`);
  }

  findByTitle(title) {
    return http.get(`/estabelecimentos?title=${title}`);
  }
}

export default new EstabelecimentosDataService();
