<template>
  <div v-if="currentPedido" class="edit-form">
    <h4>Pedidos</h4>
    <form>
      <div class="form-group">
        <label for="title">Pedidos</label>
        <input type="text" class="form-control" id="title"
          v-model="currentPedido"
        />
      </div>
    </form>

    <button class="badge badge-primary mr-2"
      v-if="currentPedido"
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
      @click="deletePedido"
    >
      Delete
    </button>

    <button type="submit" class="badge badge-success"
      @click="updatePedido"
    >
      Update
    </button>
    <p>{{ message }}</p>
  </div>

  <div v-else>
    <br />
    <p>Selecione uma Pedido...</p>
  </div>
</template>

<script>
import PedidosDataService from "../../services/PedidosDataService";

export default {
  name: "pedido",
  data() {
    return {
      currentPedido: null,
      message: ''
    };
  },
  methods: {
    getPedido(id) {
      PedidosDataService.get(id)
        .then(response => {
          this.currentPedido = response.data;
          console.log(response.data);
        })
        .catch(e => {
          console.log(e);
        });
    },

    updatePublished(status) {
      var data = {
        id: this.currentPedido.id,
        title: this.currentPedido.title,
        description: this.currentPedido.description,
        published: status
      };

      PedidosDataService.update(this.currentPedido.id, data)
        .then(response => {
          this.currentPedido.published = status;
          console.log(response.data);
        })
        .catch(e => {
          console.log(e);
        });
    },

    updatePedido() {
      PedidosDataService.update(this.currentPedido.id, this.currentPedido)
        .then(response => {
          console.log(response.data);
          this.message = 'Pedido atualizada com sucesso!';
        })
        .catch(e => {
          console.log(e);
        });
    },

    deletePedido() {
      PedidosDataService.delete(this.currentPedido.id)
        .then(response => {
          console.log(response.data);
          this.$router.push({ name: "pedidos" });
        })
        .catch(e => {
          console.log(e);
        });
    }
  },
  mounted() {
    this.message = '';
    this.getPedido(this.$route.params.id);
  }
};
</script>

<style>
.edit-form {
  max-width: 300px;
  margin: auto;
}
</style>
