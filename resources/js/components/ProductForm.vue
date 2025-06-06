<template>
    <div v-if="visible" class="modal-overlay" @mousedown.self="close">
        <div class="modal-content" role="dialog" aria-modal="true" aria-labelledby="modal-title">
            <h2 id="modal-title">{{ internalForm.id ? "Editar Produto" : "Cadastrar Produto" }}</h2>
            <form class="product-form" @submit.prevent="submit">
                <input v-model="internalForm.name" placeholder="Nome" required />
                <select v-model="internalForm.category_id" required>
                    <option :value="null" disabled>Selecione a Categoria</option>
                    <option v-for="cat in categories" :key="cat.id" :value="cat.id">
                        {{ cat.name }}
                    </option>
                </select>
                <input v-model="internalForm.price" type="number" min="0" step="0.01" placeholder="Preço" required />
                <div class="modal-actions">
                    <button type="button" class="btn-cancel" @click="close" style="cursor: pointer;">Cancelar</button>
                    <button type="submit" style="cursor: pointer;">
                        {{ internalForm.id ? "Atualizar" : "Cadastrar" }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ProductForm',
    props: {
        categories: Array,
        form: Object,
        visible: Boolean
    },
    data() {
        return {
            internalForm: { ...this.form }
        };
    },
    watch: {
        form: {
            handler(val) {
                this.internalForm = { ...val };
            },
            deep: true
        },
        visible(val) {
            if (val) {
                this.internalForm = { ...this.form };
            }
        }
    },
    methods: {
        submit() {
            this.$emit('save', { ...this.internalForm });
        },
        close() {
            this.$emit('close');
        }
    }
};
</script>