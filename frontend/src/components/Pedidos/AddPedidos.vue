<template>
  <div class="submit-form">
    <div v-if="!submitted">
      <div class="form-group">
        <label for="estabelecimento">Estabelecimento</label>
        <select v-model="pedido.estabelecimento_id" class="form-control" id="estabelecimento" required>
          <option value="">Selecione um estabelecimento</option>
          <option v-for="estabelecimento in estabelecimentos" :key="estabelecimento.id" :value="estabelecimento.id">{{ estabelecimento.estabelecimento_nome }}</option>
        </select>
      </div>
      <div v-if="pedido.estabelecimento_id">
        <div class="form-group">
          <label for="produto">Produto</label>
          <select v-model="produtoSelecionado" class="form-control" id="produto" required>
            <option value="">Selecione um Produto</option>
            <option v-for="produto in produtos" :key="produto.id" :value="produto.id">{{ produto.produto_nome +' - R$ ' + produto.produto_valor}}</option>
          </select>
        </div>
        <div class="form-group">
          <label for="quantidade">Quantidade</label>
          <input type="number" class="form-control" id="quantidade" v-model="quantidadeSelecionada" required>
        </div>
        <button @click="adicionarProduto" class="btn btn-primary">Adicionar</button>
      </div>
      <div>
        <h4>Produtos Selecionados:</h4>
        <ul>
          <li v-for="(produto, index) in produtosSelecionados" :key="index">
            {{ produto.produto_nome }} - Quantidade: {{ produto.quantidade }} - Valor Unitário: R$ {{ produto.produto_valor }} - Subtotal: R$ {{ produto.subtotal.toFixed(2) }}
          </li>
        </ul>
        <p>Total: R$ {{ calcularTotal().toFixed(2) }}</p>
        <p v-if="bonus <= 0">Saldo Devedor: R$ {{ (calcularTotal() - bonus).toFixed(2) }}</p>
        <p>Bônus Restante: R$ {{ bonus.toFixed(2) }}</p>
      </div>
      <br/>
      <div>
        <button @click="savePedido" class="btn btn-success">Submit</button>        
      </div>
    </div>

    <div v-else>
      <h4>Salvo com Sucesso!</h4>
      <button class="btn btn-success" @click="newPedido">Add</button>
    </div>
  </div>
</template>

<script>
import PedidosDataService from "../../services/PedidosDataService";
import EstabelecimentosDataService from "../../services/EstabelecimentosDataService";

export default {
  name: "add-pedido",
  data() {
    return {
      pedido: {
        id: null,
        estabelecimento_id: null,
        produtos: []
      },
      submitted: false,
      estabelecimentos: [], // Array para armazenar os estabelecimentos disponíveis
      produtos: [], // Array para armazenar os produtos disponíveis
      produtoSelecionado: null,
      quantidadeSelecionada: 1,
      bonus: 1000 // Bônus inicial de R$ 1000,00
    };
  },
  computed: {
  produtosSelecionados() {
    return this.pedido.produtos;
  },
  totalSemDesconto() {
    return this.calcularTotal();
  },
  totalComDesconto() {
    return Math.max(this.totalSemDesconto - this.bonus, 0);
  },
  saldoDevedor() {
  const total = this.calcularTotal();
  const saldo = Math.max(total - this.bonus); // Deduz o bônus apenas se ele for menor ou igual ao total
  return saldo.toFixed(2);
}
},
  methods: {
    savePedido() {
      var data = {
        estabelecimento_id: this.pedido.estabelecimento_id,
        produtos: this.pedido.produtos
      };

      PedidosDataService.create(data)
        .then(response => {
          this.pedido.id = response.data.id;
          console.log(response.data);
          this.submitted = true;
        })
        .catch(e => {
          console.log(e);
        });
    },
    
    newPedido() {
      this.submitted = false;
      this.pedido = {
        id: null,
        estabelecimento_id: null,
        produtos: []
      };
      this.bonus = 1000; // Reinicia o bônus para R$ 1000,00
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
    
    retrieveProdutos(estabelecimentoId) {
      EstabelecimentosDataService.getProdutos(estabelecimentoId)
      .then(response => {
        this.produtos = response.data.data;
        console.log(this.produtos);
      })
      .catch(e => {
        console.log(e);
      });
   },

   adicionarProduto() {
    if (this.produtoSelecionado && this.quantidadeSelecionada > 0) {
      const produto = this.produtos.find(p => p.id === this.produtoSelecionado);
      if (produto) {
        const subtotal = this.quantidadeSelecionada * produto.produto_valor;
        if (this.bonus >= subtotal) {
          this.pedido.produtos.push({
            id: produto.id,
            produto_nome: produto.produto_nome,
            produto_valor: produto.produto_valor,
            quantidade: this.quantidadeSelecionada,
            subtotal: subtotal
          });
          this.produtoSelecionado = null;
          this.quantidadeSelecionada = 1;
          this.bonus -= subtotal;
        } else {
          this.pedido.produtos.push({
            id: produto.id,
            produto_nome: produto.produto_nome,
            produto_valor: produto.produto_valor,
            quantidade: this.quantidadeSelecionada,
            subtotal: subtotal
          });
          this.produtoSelecionado = null;
          this.quantidadeSelecionada = 1;
          this.bonus = 0;
        }
      }
    }
  },
    
  calcularTotal() {
    return this.pedido.produtos.reduce((total, produto) => total + produto.subtotal, 0);
  }
  },
  watch: {
    'pedido.estabelecimento_id': function(newEstabelecimentoId) {
      this.retrieveProdutos(newEstabelecimentoId);
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
