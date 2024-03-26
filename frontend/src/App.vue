<template>
  <div id="app">
    <nav class="navbar navbar-expand navbar-dark bg-dark">
      <router-link to="/" class="navbar-brand">bezKoder</router-link>
      <div class="navbar-nav mr-auto">
        <li class="nav-item">
          <router-link to="/pedidos" class="nav-link">Pedidos</router-link>
        </li>
        <li class="nav-item">
          <router-link to="/produtos" class="nav-link">Produtos</router-link>
        </li>
        <li class="nav-item">
          <router-link to="/estabelecimentos" class="nav-link">Estabelecimento</router-link>
        </li>
        <li class="nav-item">
          <router-link to="/categorias" class="nav-link">Categorias</router-link>
        </li>
        <!-- <li class="nav-item">
          <router-link to="/add" class="nav-link">Add</router-link>
        </li> -->
      </div>
    </nav>

    <div class="container mt-3">
      <router-view />
    </div>
  </div>
</template>

<script>
export default {
  name: "app"
};
</script>
