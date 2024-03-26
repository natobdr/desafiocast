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
      path: "/produtos",
      name: "produtos",
      component: () => import("./components/ProdutosList")
    },
    {
      path: "/estabelecimentos",
      name: "estabelecimentos",
      component: () => import("./components/Estabelecimento/EstabelecimentosList")
    },
    {
      path: "/categorias",
      name: "categorias",
      component: () => import("./components/Categorias/CategoriasList")
    },
    {
      path: "/pedidos/:id",
      name: "pedidos-details",
      component: () => import("./components/Pedidos/Pedidos")
    },
    {
      path: "/produtos/:id",
      name: "produtos-details",
      component: () => import("./components/Produtos")
    },
    {
      path: "/addPedidos",
      name: "addPedidos",
      component: () => import("./components/Pedidos/AddPedidos")
    },
    {
      path: "/addCategorias",
      name: "addCategorias",
      component: () => import("./components/Categorias/AddCategorias")
    },
    {
      path: "/add",
      name: "add",
      component: () => import("./components/Pedidos/AddPedidos")
    }
  ]
});
