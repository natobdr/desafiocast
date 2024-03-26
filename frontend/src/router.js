import Vue from "vue";
import Router from "vue-router";

Vue.use(Router);

export default new Router({
  mode: "history",
  routes: [
    {
      path: "/",
      alias: "/pedidos",
      name: "pedidos",
      component: () => import("./components/Pedidos/PedidosList")
    },
    {
      path: "/pedidos/:id",
      name: "pedidos-details",
      component: () => import("./components/Pedidos/Pedidos")
    },
    {
      path: "/addPedidos",
      name: "addPedidos",
      component: () => import("./components/Pedidos/AddPedidos")
    },
    {
      path: "/produtos",
      name: "produtos",
      component: () => import("./components/Produtos/ProdutosList")
    },
    {
      path: "/addProdutos",
      name: "addProdutos",
      component: () => import("./components/Produtos/AddProdutos")
    },
    {
      path: "/produtos/:id",
      name: "produtos-details",
      component: () => import("./components/Produtos/Produtos")
    },
    {
      path: "/estabelecimentos",
      name: "estabelecimentos",
      component: () => import("./components/Estabelecimento/EstabelecimentosList")
    },
    {
      path: "/addEstabelecimentos",
      name: "addEstabelecimentos",
      component: () => import("./components/Estabelecimento/AddEstabelecimentos")
    },
    {
      path: "/addCategorias",
      name: "addCategorias",
      component: () => import("./components/Categorias/AddCategorias")
    },
    {
      path: "/categorias",
      name: "categorias",
      component: () => import("./components/Categorias/CategoriasList")
    },
    {
      path: "/add",
      name: "add",
      component: () => import("./components/Pedidos/AddPedidos")
    }
  ]
});
