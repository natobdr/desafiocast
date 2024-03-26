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
          <router-link to="/addEstabelecimentos" class="nav-link">Novo Estabelecimento</router-link>    
          </button>
        </div>        
      </div>
    </div>
    <div class="col-md-6">
      <h4>Lista de Estabelecimentos</h4>
      <ul class="list-group">
        <li class="list-group-item"
          :class="{ active: index == currentIndex }"
          v-for="(estabelecimento, index) in estabelecimentos"
          :key="index"
          @click="setActiveEstabelecimento(estabelecimento, index)"
        >
          {{ estabelecimento.estabelecimento_nome }}
        </li>
      </ul>

      <button class="m-3 btn btn-sm btn-danger" @click="removeAllEstabelecimentos">
        Remove All
      </button>
    </div>
    <div class="col-md-6">
      <div v-if="currentEstabelecimento">
        <h4>Estabelecimento</h4>
        <div>
          <label><strong>Nome:</strong></label> {{ currentEstabelecimento.estabelecimento_nome }}
        </div>
        <div>
          <label><strong>Descrição:</strong></label> {{ currentEstabelecimento.estabelecimento_descricao }}
        </div>
        <div>
          <label><strong>Categoria:</strong></label> {{ currentEstabelecimento.categorias[0].categoria_nome}}
        </div>
        <router-link :to="'/estabelecimentos/' + currentEstabelecimento.id" class="badge badge-warning">Edit</router-link>
      </div>
      <div v-else>
        <br />
        <p>Selecione um Estabelecimento...</p>
      </div>
    </div>
  </div>
</template>

<script>
import EstabelecimentosDataService from "../../services/EstabelecimentosDataService";

export default {
  name: "estabelecimento-list",
  data() {
    return {
      estabelecimentos: [],
      currentEstabelecimento: null,
      currentIndex: -1,
      title: ""
    };
  },
  methods: {
    retrieveEstabelecimentos() {
      EstabelecimentosDataService.getAll()
        .then(response => {
          this.estabelecimentos = response.data.data;
        })
        .catch(e => {
          console.log(e);
        });
    },

    refreshList() {
      this.retrieveEstabelecimentos();
      this.currentEstabelecimento = null;
      this.currentIndex = -1;
    },

    setActiveEstabelecimento(estabelecimento, index) {
      this.currentEstabelecimento = estabelecimento;
      this.currentIndex = index;
    },

    removeAllEstabelecimentos() {
      EstabelecimentosDataService.deleteAll()
        .then(response => {
          console.log(response.data);
          this.refreshList();
        })
        .catch(e => {
          console.log(e);
        });
    },
    
    searchTitle() {
      EstabelecimentosDataService.findByTitle(this.title)
        .then(response => {
          this.estabelecimentos = response.data;
        })
        .catch(e => {
          console.log(e);
        });
    }
  },
  mounted() {
    this.retrieveEstabelecimentos();
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
