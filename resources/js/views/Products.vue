<template>
    <div>
        <div class="intro-overlay">
            <div class="intro-message">Bem-vindo(a) a Gestão de Produtos LG👋</div>
        </div>

        <Header />
        <div class="product-wrapper">
            <div class="header-row">
                <div>
                    <button class="btn-add" @click="openCreateModal">
                        Cadastrar Produto
                    </button>
                </div>
            </div>
            <ProductForm :categories="categories" :form="form" :visible="showModal" @save="save" @close="closeModal" />
            <ProductTable :products="products" @edit="edit" @remove="remove" />
        </div>
    </div>
</template>

<script>
import api from '../services/api'
import ProductForm from '../components/ProductForm.vue'
import ProductTable from '../components/ProductTable.vue'
import Header from '../components/Header.vue'

const defaultForm = () => ({
    id: null,
    name: '',
    category_id: null,
    price: ''
})

export default {
    name: 'Products',
    components: { ProductForm, ProductTable, Header },
    data() {
        return {
            products: [],
            categories: [],
            form: defaultForm(),
            showModal: false
        }
    },
    methods: {
        fetchProducts() {
            api.get('/products').then(res => this.products = res.data.data)
        },
        fetchCategories() {
            api.get('/categories').then(res => this.categories = res.data.data ? res.data.data : res.data)
        },
        openCreateModal() {
            this.form = defaultForm()
            this.showModal = true
        },
        save(formData) {
            if (formData.id) {
                api.put(`/products/${formData.id}`, formData)
                    .then(() => {
                    this.$toast.success('Produto atualizado com sucesso!')
                    this.fetchProducts()
                    this.closeModal()
                    })
                    .catch(() => {
                    this.$toast.error('Erro ao atualizar produto.')
                    })
            } else {
                api.post('/products', formData)
                    .then(() => {
                    this.$toast.success('Produto cadastrado com sucesso!')
                    this.fetchProducts()
                    this.closeModal()
                    })
                    .catch(() => {
                    this.$toast.error('Erro ao cadastrar produto.')
                    })
            }
        },
        edit(prod) {
            this.form = {
                id: prod.id,
                name: prod.name,
                category_id: prod.category_id,
                price: prod.latest_price ? prod.latest_price.price : ''
            }
            this.showModal = true
        },
        remove(prod) {
            if (confirm('Confirma excluir?')) {
                api.delete(`/products/${prod.id}`)
                    .then(() => {
                        this.$toast.success('Produto excluído com sucesso!')
                        this.fetchProducts()
                    })
                    .catch(() => {
                        this.$toast.error('Erro ao excluir o produto.')
                    })
            }
        },
        closeModal() {
            this.showModal = false
            this.form = defaultForm()
        }
    },
    mounted() {
        this.fetchProducts()
        this.fetchCategories()
    }
}
</script>