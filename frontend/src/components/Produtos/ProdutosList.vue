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
          <router-link to="/addProdutos" class="nav-link">Novo Produto</router-link>    
          </button>
        </div>        
      </div>
    </div>
    <div class="col-md-6">
      <h4>Lista de Produtos</h4>
      <ul class="list-group">
        <li class="list-group-item"
          :class="{ active: index == currentIndex }"
          v-for="(produto, index) in produtos"
          :key="index"
          @click="setActiveProduto(produto, index)"
        >
          {{ produto.produto_nome }}
        </li>
      </ul>

      <button class="m-3 btn btn-sm btn-danger" @click="removeAllProdutos">
        Remove All
      </button>
    </div>
    <div class="col-md-6">
      <div v-if="currentProduto">
        <h4>Produto</h4>
        <div>
          <label><strong>Nome:</strong></label> {{ currentProduto.produto_nome }}
        </div>
        <div>
          <label><strong>Valor:</strong></label> {{ currentProduto.produto_valor }}
        </div>
        <div>
          <label><strong>Categoria:</strong></label> {{ currentProduto.categorias[0].categoria_nome}}
        </div>
        <router-link :to="'/produtos/' + currentProduto.id" class="badge badge-warning">Edit</router-link>
      </div>
      <div v-else>
        <br />
        <p>Selecione uma Produto...</p>
      </div>
    </div>
  </div>
</template>

<script>
import ProdutosDataService from "../../services/ProdutosDataService";

export default {
  name: "produto-list",
  data() {
    return {
      produtos: [],
      currentProduto: null,
      currentIndex: -1,
      title: ""
    };
  },
  methods: {
    retrieveProdutos() {
      ProdutosDataService.getAll()
        .then(response => {
          this.produtos = response.data.data;
        })
        .catch(e => {
          console.log(e);
        });
    },

    refreshList() {
      this.retrieveProdutos();
      this.currentProduto = null;
      this.currentIndex = -1;
    },

    setActiveProduto(produto, index) {
      this.currentProduto = produto;
      this.currentIndex = index;
    },

    removeAllProdutos() {
      ProdutosDataService.deleteAll()
        .then(response => {
          console.log(response.data);
          this.refreshList();
        })
        .catch(e => {
          console.log(e);
        });
    },
    
    searchTitle() {
      ProdutosDataService.findByTitle(this.title)
        .then(response => {
          this.produtos = response.data;
        })
        .catch(e => {
          console.log(e);
        });
    }
  },
  mounted() {
    this.retrieveProdutos();
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
