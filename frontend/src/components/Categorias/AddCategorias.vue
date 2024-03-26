<template>
  <div class="submit-form">
    <div v-if="!submitted">
      <div class="form-group">
        <label for="title">Nome Categoria</label>
        <input
          type="text"
          class="form-control"
          id="title"
          required
          v-model="categoria.title"
          name="title"
        />
      </div>
      <br/>
      <div>
        <button @click="saveCategoria" class="btn btn-success">Submit</button>        
      </div>
    </div>

    <div v-else>
      <h4>Salvo com Sucesso!</h4>
      <button class="btn btn-success" @click="newCategoria">Add</button>
    </div>
  </div>
</template>

<script>
import CategoriasDataService from "../../services/CategoriasDataService";

export default {
  name: "add-categoria",
  data() {
    return {
      categoria: {
        id: null,
        categoria_nome: "",
      },
      submitted: false
    };
  },
  methods: {
    saveCategoria() {
      var data = {
        title: this.categoria.title,
      };

      CategoriasDataService.create(data)
        .then(response => {
          this.categoria.id = response.data.id;
          console.log(response.data);
          this.submitted = true;
        })
        .catch(e => {
          console.log(e);
        });
    },
    
    newCategoria() {
      this.submitted = false;
      this.categoria = {};
    }
  }
};
</script>

<style>
.submit-form {
  max-width: 300px;
  margin: auto;
}
</style>
