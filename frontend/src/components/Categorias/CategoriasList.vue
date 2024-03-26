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
          <router-link to="/addCategorias" class="nav-link">Nova Categoria</router-link>    
          </button>
        </div>        
      </div>
    </div>
    <div class="col-md-6">
      <h4>Lista de Categorias</h4>
      <ul class="list-group">
        <li class="list-group-item"
          :class="{ active: index == currentIndex }"
          v-for="(categoria, index) in categorias"
          :key="index"
          @click="setActiveCategoria(categoria, index)"
        >
          {{ categoria.categoria_nome }}
        </li>
      </ul>

      <button class="m-3 btn btn-sm btn-danger" @click="removeAllCategorias">
        Remove All
      </button>
    </div>
    <div class="col-md-6">
      <div v-if="currentCategoria">
        <h4>Categoria</h4>
        <div>
          <label><strong>Nome:</strong></label> {{ currentCategoria.categoria_nome }}
        </div>
        <router-link :to="'/categorias/' + currentCategoria.id" class="badge badge-warning">Edit</router-link>
      </div>
      <div v-else>
        <br />
        <p>Selecione uma Categoria...</p>
      </div>
    </div>
  </div>
</template>

<script>
import CategoriasDataService from "../../services/CategoriasDataService";

export default {
  name: "categoria-list",
  data() {
    return {
      categorias: [],
      currentCategoria: null,
      currentIndex: -1,
      title: ""
    };
  },
  methods: {
    retrieveCategorias() {
      CategoriasDataService.getAll()
        .then(response => {
          this.categorias = response.data.data;
        })
        .catch(e => {
          console.log(e);
        });
    },

    refreshList() {
      this.retrieveCategorias();
      this.currentCategoria = null;
      this.currentIndex = -1;
    },

    setActiveCategoria(categoria, index) {
      this.currentCategoria = categoria;
      this.currentIndex = index;
    },

    removeAllCategorias() {
      CategoriasDataService.deleteAll()
        .then(response => {
          console.log(response.data);
          this.refreshList();
        })
        .catch(e => {
          console.log(e);
        });
    },
    
    searchTitle() {
      CategoriasDataService.findByTitle(this.title)
        .then(response => {
          this.categorias = response.data;
        })
        .catch(e => {
          console.log(e);
        });
    }
  },
  mounted() {
    this.retrieveCategorias();
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
