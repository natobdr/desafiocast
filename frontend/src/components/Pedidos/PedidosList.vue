<template>
  <div class="list row">
    <div class="col-md-8">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search by title"
          v-model="title"/>
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="button"
            @click="searchTitle"
          >
            Search
          </button>
        </div>
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="button"            
          >   
          <router-link to="/addPedidos" class="nav-link">Novo Pedido</router-link>    
          </button>
        </div>        
      </div>
    </div>
    <div class="col-md-6">
      <h4>Lista de Pedidos</h4>
      <ul class="list-group">
        <li class="list-group-item"
          :class="{ active: index == currentIndex }"
          v-for="(pedido, index) in pedidos"
          :key="index"
          @click="setActivePedido(pedido, index)"
        >
        Pedido Nº: {{ pedido.id }}
        </li>
      </ul>

      <button class="m-3 btn btn-sm btn-danger" @click="removeAllPedidos">
        Remove All
      </button>
    </div>
    <div class="col-md-6">
      <div v-if="currentPedido">
        <h4>Pedido</h4>
        <div>
          <label><strong>Número Pedido:</strong></label> {{ currentPedido.id }}
        </div>
        <div :class="{ active: index === currentIndex }" v-for="(produto, index) in currentPedido.produtos" :key="index">
          <label><strong>Produto:</strong></label> {{ produto.produto_nome }}
        </div>
        <router-link :to="'/pedidos/' + currentPedido.id" class="badge badge-warning">Edit</router-link>
      </div>
      <div v-else>
        <br />
        <p>Selecione um Pedido...</p>
      </div>
    </div>
  </div>
</template>

<script>
import PedidosDataService from "../../services/PedidosDataService";

export default {
  name: "pedido-list",
  data() {
    return {
      pedidos: [],
      currentPedido: null,
      currentIndex: -1,
      title: ""
    };
  },
  methods: {
    retrievePedidos() {
      PedidosDataService.getAll()
        .then(response => {
          console.log(response.data.data);
          this.pedidos = response.data.data;
        })
        .catch(e => {
          console.log(e);
        });
    },

    refreshList() {
      this.retrievePedidos();
      this.currentPedido = null;
      this.currentIndex = -1;
    },

    setActivePedido(pedido, index) {
      this.currentPedido = pedido;
      this.currentIndex = index;
    },

    removeAllPedidos() {
      PedidosDataService.deleteAll()
        .then(response => {
          console.log(response.data);
          this.refreshList();
        })
        .catch(e => {
          console.log(e);
        });
    },
    
    searchTitle() {
      PedidosDataService.findByTitle(this.title)
        .then(response => {
          this.pedidos = response.data;
        })
        .catch(e => {
          console.log(e);
        });
    }
  },
  mounted() {
    this.retrievePedidos();
  }
};
</script>

<style>
.list {
  text-align: left;
  max-width: 750px;
  margin: auto;
}
</style>
