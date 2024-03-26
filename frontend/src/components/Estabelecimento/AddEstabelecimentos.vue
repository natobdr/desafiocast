<template>
  <div class="submit-form">
    <div v-if="!submitted">
      <div class="form-group">
        <label for="nome">Nome Estabelecimento</label>
        <input
          type="text"
          class="form-control"
          id="nome"
          required
          v-model="estabelecimento.nome"
          name="nome"
        />
      </div>
      <div class="form-group">
        <label for="descricao">Descrição Estabelecimento</label>
        <input
          type="text"
          class="form-control"
          id="descricao"
          required
          v-model="estabelecimento.descricao"
          name="descricao"
        />
      </div>
      <div class="form-group">
        <label for="categoria">Categoria Estabelecimento</label>
        <select v-model="estabelecimento.categoria_id" class="form-control" id="categoria" required>
          <option value="">Selecione uma categoria</option>
          <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">{{ categoria.categoria_nome }}</option>
        </select>
      </div>
      <div class="form-group">
        <label for="cep">CEP</label>
        <input
          type="text"
          class="form-control"
          id="cep"
          required
          v-model="estabelecimento.cep"
          name="cep"
          @blur="buscarEndereco"
        />
      </div>
      <div class="form-group">
        <label for="logradouro">Logradouro</label>
        <input
          type="text"
          class="form-control"
          id="logradouro"
          required
          v-model="estabelecimento.logradouro"
          name="logradouro"
        />
      </div>
      <div class="form-group">
        <label for="bairro">Bairro</label>
        <input
          type="text"
          class="form-control"
          id="bairro"
          required
          v-model="estabelecimento.bairro"
          name="bairro"
        />
      </div>
      <div class="form-group">
        <label for="cidade">Cidade</label>
        <input
          type="text"
          class="form-control"
          id="cidade"
          required
          v-model="estabelecimento.cidade"
          name="cidade"
        />
      </div>
      <div class="form-group">
        <label for="estado">Estado</label>
        <input
          type="text"
          class="form-control"
          id="estado"
          required
          v-model="estabelecimento.estado"
          name="estado"
        />
      </div>
      <br/>
      <div>
        <button @click="saveEstabelecimento" class="btn btn-success">Submit</button>        
      </div>
    </div>

    <div v-else>
      <h4>Salvo com Sucesso!</h4>
      <button class="btn btn-success" @click="newEstabelecimento">Add</button>
    </div>
  </div>
</template>

<script>
import EstabelecimentosDataService from "../../services/EstabelecimentosDataService";

export default {
  name: "add-estabelecimento",
  data() {
    return {
      estabelecimento: {
        id: null,
        nome: "",
        descricao: "",
        categoria_id: null,
        cep: "",
        logradouro: "",
        bairro: "",
        cidade: "",
        estado: ""
      },
      categorias: [],
      submitted: false
    };
  },
  methods: {
    buscarEndereco() {
      if (this.estabelecimento.cep.length === 8) {
        fetch(`https://viacep.com.br/ws/${this.estabelecimento.cep}/json/`)
          .then(response => response.json())
          .then(data => {
            if (!data.erro) {
              this.estabelecimento.logradouro = data.logradouro;
              this.estabelecimento.bairro = data.bairro;
              this.estabelecimento.cidade = data.localidade;
              this.estabelecimento.estado = data.uf;
            } else {
              alert("CEP não encontrado");
            }
          })
          .catch(error => {
            console.error("Erro ao buscar o endereço:", error);
          });
      }
    },
    saveEstabelecimento() {
      var data = {
        nome: this.estabelecimento.nome,
        descricao: this.estabelecimento.descricao,
        categoria_id: this.estabelecimento.categoria_id,
        cep: this.estabelecimento.cep,
        logradouro: this.estabelecimento.logradouro,
        bairro: this.estabelecimento.bairro,
        cidade: this.estabelecimento.cidade,
        estado: this.estabelecimento.estado
      };

      EstabelecimentosDataService.create(data)
        .then(response => {
          this.estabelecimento.id = response.data.id;
          console.log(response.data);
          this.submitted = true;
        })
        .catch(e => {
          console.log(e);
        });
    },
    newEstabelecimento() {
      this.submitted = false;
      this.estabelecimento = {
        id: null,
        nome: "",
        descricao: "",
        categoria_id: null,
        cep: "",
        logradouro: "",
        bairro: "",
        cidade: "",
        estado: ""
      };
    },
    retrieveEstabelecimentos() {
      EstabelecimentosDataService.getCategoria()
      .then(response => {
          this.categorias = response.data.data;
          console.log(this.categorias);
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
.submit-form {
  max-width: 300px;
  margin: auto;
}
</style>