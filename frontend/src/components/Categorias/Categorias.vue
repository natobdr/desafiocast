<template>
  <div v-if="currentCategoria" class="edit-form">
    <h4>Pedidos</h4>
    <form>
      <div class="form-group">
        <label for="title">Categorias</label>
        <input type="text" class="form-control" id="title"
          v-model="currentCategoria"
        />
      </div>
    </form>

    <button class="badge badge-primary mr-2"
      v-if="currentCategoria"
      @click="updatePublished(false)"
    >
      UnPublish
    </button>
    <button v-else class="badge badge-primary mr-2"
      @click="updatePublished(true)"
    >
      Publish
    </button>

    <button class="badge badge-danger mr-2"
      @click="deleteCategoria"
    >
      Delete
    </button>

    <button type="submit" class="badge badge-success"
      @click="updateCategoria"
    >
      Update
    </button>
    <p>{{ message }}</p>
  </div>

  <div v-else>
    <br />
    <p>Selecione uma Categoria...</p>
  </div>
</template>

<script>
import CategoriasDataService from "../../services/CategoriasDataService";

export default {
  name: "categoria",
  data() {
    return {
      currentCategoria: null,
      message: ''
    };
  },
  methods: {
    getCategoria(id) {
      CategoriasDataService.get(id)
        .then(response => {
          this.currentCategoria = response.data;
          console.log(response.data);
        })
        .catch(e => {
          console.log(e);
        });
    },

    updatePublished(status) {
      var data = {
        id: this.currentCategoria.id,
        title: this.currentCategoria.title,
        description: this.currentCategoria.description,
        published: status
      };

      CategoriasDataService.update(this.currentCategoria.id, data)
        .then(response => {
          this.currentCategoria.published = status;
          console.log(response.data);
        })
        .catch(e => {
          console.log(e);
        });
    },

    updateCategoria() {
      CategoriasDataService.update(this.currentCategoria.id, this.currentCategoria)
        .then(response => {
          console.log(response.data);
          this.message = 'Categoria atualizada com sucesso!';
        })
        .catch(e => {
          console.log(e);
        });
    },

    deleteCategoria() {
      CategoriasDataService.delete(this.currentCategoria.id)
        .then(response => {
          console.log(response.data);
          this.$router.push({ name: "categorias" });
        })
        .catch(e => {
          console.log(e);
        });
    }
  },
  mounted() {
    this.message = '';
    this.getCategoria(this.$route.params.id);
  }
};
</script>

<style>
.edit-form {
  max-width: 300px;
  margin: auto;
}
</style>
