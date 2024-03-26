<template>
  <div v-if="currentProduto" class="edit-form">
    <h4>Pedidos</h4>
    <form>
      <div class="form-group">
        <label for="title">Produtos</label>
        <input type="text" class="form-control" id="title"
          v-model="currentProduto"
        />
      </div>
    </form>

    <button class="badge badge-primary mr-2"
      v-if="currentProduto"
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
      @click="deleteProduto"
    >
      Delete
    </button>

    <button type="submit" class="badge badge-success"
      @click="updateProduto"
    >
      Update
    </button>
    <p>{{ message }}</p>
  </div>

  <div v-else>
    <br />
    <p>Selecione um Produto...</p>
  </div>
</template>

<script>
import ProdutosDataService from "../../services/ProdutosDataService";

export default {
  name: "produto",
  data() {
    return {
      currentProduto: null,
      message: ''
    };
  },
  methods: {
    getProduto(id) {
      ProdutosDataService.get(id)
        .then(response => {
          this.currentProduto = response.data;
          console.log(response.data);
        })
        .catch(e => {
          console.log(e);
        });
    },

    updatePublished(status) {
      var data = {
        id: this.currentProduto.id,
        title: this.currentProduto.title,
        description: this.currentProduto.description,
        published: status
      };

      ProdutosDataService.update(this.currentProduto.id, data)
        .then(response => {
          this.currentProduto.published = status;
          console.log(response.data);
        })
        .catch(e => {
          console.log(e);
        });
    },

    updateProduto() {
      ProdutosDataService.update(this.currentProduto.id, this.currentProduto)
        .then(response => {
          console.log(response.data);
          this.message = 'Produto atualizada com sucesso!';
        })
        .catch(e => {
          console.log(e);
        });
    },

    deleteProduto() {
      ProdutosDataService.delete(this.currentProduto.id)
        .then(response => {
          console.log(response.data);
          this.$router.push({ name: "produtos" });
        })
        .catch(e => {
          console.log(e);
        });
    }
  },
  mounted() {
    this.message = '';
    this.getProduto(this.$route.params.id);
  }
};
</script>

<style>
.edit-form {
  max-width: 300px;
  margin: auto;
}
</style>
