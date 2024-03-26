<template>
  <div class="submit-form">
    <div v-if="!submitted">
      <div class="form-group">
        <label for="nome_produto">Nome Produto</label>
        <input
          type="text"
          class="form-control"
          id="nome_produto"
          required
          v-model="produto.produto_nome"
          name="nome_produto"
        />
      </div>
      <div class="form-group">
        <label for="valor_produto">Valor Produto</label>
        <input
          type="text"
          class="form-control"
          id="valor_produto"
          required
          v-model="produto.valor"
          name="valor_produto"
        />
      </div>
      <div class="form-group">
        <label for="estabelecimento">Estabelecimento</label>
        <select v-model="produto.estabelecimento_id" class="form-control" id="estabelecimento" required>
          <option value="">Selecione um estabelecimento</option>
          <option v-for="estabelecimento in estabelecimentos" :key="estabelecimento.id" :value="estabelecimento.id">{{ estabelecimento.estabelecimento_nome }}</option>
        </select>
      </div>
      <div>
        <button @click="saveProduto" class="btn btn-success">Submit</button>        
      </div>
    </div>

    <div v-else>
      <h4>Salvo com Sucesso!</h4>
      <button class="btn btn-success" @click="newProduto">Add</button>
    </div>
  </div>
</template>

<script>
import ProdutosDataService from "../../services/ProdutosDataService";
import EstabelecimentosDataService from "../../services/EstabelecimentosDataService";

export default {
  name: "add-produto",
  data() {
    return {
      produto: {
        id: null,
        produto_nome: "",
        valor: "",
        estabelecimento_id: "", // Corrigido para estabelecimento_id
      },
      estabelecimentos: [],
      submitted: false
    };
  },
  methods: {
    saveProduto() {
      var data = {
        produto_nome: this.produto.produto_nome,
        produto_valor: parseFloat(this.produto.valor),
        estabelecimento_id: this.produto.estabelecimento_id // Corrigido para produto.estabelecimento_id
      };

      ProdutosDataService.create(data)
        .then(response => {
          this.produto.id = response.data.id;
          console.log(response.data);
          this.submitted = true;
        })
        .catch(e => {
          console.log(e);
        });
    },
    
    newProduto() {
      this.submitted = false;
      this.produto = {
        id: null,
        produto_nome: "",
        valor: "",
        estabelecimento_id: "", // Corrigido para estabelecimento_id
      };
    },

    retrieveEstabelecimentos() {
      EstabelecimentosDataService.getAll()
        .then(response => {
          this.estabelecimentos = response.data.data;
          console.log(this.estabelecimentos);
        })
        .catch(e => {
          console.log(e);
        });
    },
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