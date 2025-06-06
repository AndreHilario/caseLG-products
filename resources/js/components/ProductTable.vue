<template>
    <div class="table-responsive">
        <table class="product-table">
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
                    <td>{{ p.name }}</td>
                    <td>{{ p.category ? p.category.name : '' }}</td>
                    <td>
                        R$
                        {{ p.latest_price && p.latest_price.price !== undefined
                            ? parseFloat(p.latest_price.price).toLocaleString('pt-BR', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            })
                            : '' }}
                    </td>
                    <td>
                        <button class="btn-icon btn-edit" title="Editar" @click="$emit('edit', p)">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 22 22" width="20"
                                height="20">
                                <path
                                    d="M16.2 2.94a2.284 2.284 0 013.22 3.24l-1.43 1.43-3.23-3.24 1.44-1.43zm-2.12 2.12l3.23 3.23-8.6 8.6-3.26.03.03-3.23 8.6-8.6z"
                                    fill="#a50034" />
                            </svg>
                        </button>
                        <button class="btn-icon btn-delete" title="Excluir" @click="confirmRemove(p)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                viewBox="0 0 24 24">
                                <rect x="6" y="7.5" width="12" height="12" rx="2" stroke="#a50034" stroke-width="1.4" />
                                <path d="M10 11v4M14 11v4" stroke="#a50034" stroke-width="1.4" stroke-linecap="round" />
                                <path d="M4 7.5h16" stroke="#a50034" stroke-width="1.1" />
                                <rect x="9" y="4" width="6" height="2.5" rx="1.2" stroke="#a50034" stroke-width="1.2"
                                    fill="#fff" />
                            </svg>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

        <div v-if="modalRemove" class="modal-overlay" @mousedown.self="closeModal">
            <div class="modal-content product-form" role="dialog" aria-modal="true">
                <h2 id="modal-title" style="text-align:center; margin-bottom:18px;">Excluir Produto</h2>
                <p style="text-align:center; color:#555; margin-bottom:1.3em;">
                    Você tem certeza que deseja excluir <br>
                    <b>{{ selectedProduct?.name }}</b>?
                </p>
                <div class="modal-actions" style="display:flex;justify-content:center;gap:16px;">
                    <button type="button" class="btn-cancel" @click="closeModal">Cancelar</button>
                    <button class="btn-delete confirm" @click="removeConfirmed">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import api from '../services/api'
export default {
    name: 'ProductTable',
    props: {
        products: Array
    },
    data() {
        return {
            modalRemove: false,
            selectedProduct: null
        }
    },
    methods: {
        fetchProducts() {
            api.get('/products').then(res => this.products = res.data.data)
        },
        confirmRemove(product) {
            this.selectedProduct = product;
            this.modalRemove = true;
        },
        closeModal() {
            this.modalRemove = false;
            this.selectedProduct = null;
        },
        removeConfirmed() {
            api.delete(`/products/${this.selectedProduct.id}`).then(() => this.fetchProducts())
            this.closeModal();
        }
    }
}
</script>