<template>
  <div>
    <h2>Produtos</h2>
    <!-- Formulário -->
    <form @submit.prevent="save">
      <input v-model="form.name" placeholder="Nome" required>
      <select v-model="form.category_id" required>
        <option :value="null" disabled>Categoria</option>
        <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{cat.name}}</option>
      </select>
      <input v-model="form.price" type="number" min="0" step="0.01" placeholder="Preço" required>
      <button v-if="!form.id" type="submit">Cadastrar</button>
      <button v-else type="submit">Atualizar</button>
      <button v-if="form.id" @click.prevent="reset">Cancelar</button>
    </form>
    <hr>
    <!-- Lista -->
    <table>
      <thead>
        <tr>
          <th>Nome</th>
          <th>Categoria</th>
          <th>Preço</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="p in products" :key="p.id">
          <td>{{p.name}}</td>
          <td>{{p.category ? p.category.name : ''}}</td>
          <td>R$ {{p.latest_price ? p.latest_price.price : ''}}</td>
          <td>
            <button @click="edit(p)">Editar</button>
            <button @click="remove(p)">Excluir</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import api from '../services/api';

export default {
  data() {
    return {
      products: [],
      categories: [],
      form: { id: null, name: '', category_id: null, price: '' }
    }
  },
  methods: {
    fetchProducts() {
      api.get('/products').then(res => this.products = res.data.data);
    },
    fetchCategories() {
      api.get('/categories').then(res => this.categories = res.data.data ? res.data.data : res.data);
    },
    save() {
      if(this.form.id) {
        api.put(`/products/${this.form.id}`, this.form)
          .then(() => { this.fetchProducts(); this.reset(); });
      } else {
        api.post('/products', this.form)
          .then(() => { this.fetchProducts(); this.reset(); });
      }
    },
    edit(prod) {
      this.form = { 
        id: prod.id, 
        name: prod.name, 
        category_id: prod.category_id, 
        price: prod.latest_price ? prod.latest_price.price : '' 
      };
    },
    remove(prod) {
      if(confirm('Confirma excluir?'))
        api.delete(`/products/${prod.id}`).then(() => this.fetchProducts());
    },
    reset() {
      this.form = { id: null, name: '', category_id: null, price: '' };
    }
  },
  mounted() {
    this.fetchProducts();
    this.fetchCategories();
  }
}
</script>