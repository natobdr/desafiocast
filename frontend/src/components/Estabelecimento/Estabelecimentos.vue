<template>
  <div v-if="currentEstabelecimento" class="edit-form">
    <h4>Estabelecimento</h4>
    <form>
      <div class="form-group">
        <label for="title">Estabelecimentos</label>
        <input type="text" class="form-control" id="title"
          v-model="currentEstabelecimento"
        />
      </div>
    </form>

    <button class="badge badge-primary mr-2"
      v-if="currentEstabelecimento"
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
      @click="deleteEstabelecimento"
    >
      Delete
    </button>

    <button type="submit" class="badge badge-success"
      @click="updateEstabelecimento"
    >
      Update
    </button>
    <p>{{ message }}</p>
  </div>

  <div v-else>
    <br />
    <p>Selecione um Estabelecimento...</p>
  </div>
</template>

<script>
import EstabelecimentosDataService from "../../services/EstabelecimentosDataService";

export default {
  name: "categoria",
  data() {
    return {
      currentEstabelecimento: null,
      message: ''
    };
  },
  methods: {
    getEstabelecimento(id) {
      EstabelecimentosDataService.get(id)
        .then(response => {
          this.currentEstabelecimento = response.data;
          console.log(response.data);
        })
        .catch(e => {
          console.log(e);
        });
    },

    updatePublished(status) {
      var data = {
        id: this.currentEstabelecimento.id,
        title: this.currentEstabelecimento.title,
        description: this.currentEstabelecimento.description,
        published: status
      };

      EstabelecimentosDataService.update(this.currentEstabelecimento.id, data)
        .then(response => {
          this.currentEstabelecimento.published = status;
          console.log(response.data);
        })
        .catch(e => {
          console.log(e);
        });
    },

    updateEstabelecimento() {
      EstabelecimentosDataService.update(this.currentEstabelecimento.id, this.currentEstabelecimento)
        .then(response => {
          console.log(response.data);
          this.message = 'Estabelecimento atualizada com sucesso!';
        })
        .catch(e => {
          console.log(e);
        });
    },

    deleteEstabelecimento() {
      EstabelecimentosDataService.delete(this.currentEstabelecimento.id)
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
    this.getEstabelecimento(this.$route.params.id);
  }
};
</script>

<style>
.edit-form {
  max-width: 300px;
  margin: auto;
}
</style>../../../services/EstabelecimentosDataService
