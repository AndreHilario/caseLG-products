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
                    <td>R$ {{ p.latest_price ? p.latest_price.price : '' }}</td>
                    <td>
                        <button class="btn-icon btn-edit" title="Editar" @click="$emit('edit', p)">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 22 22" width="20"
                                height="20">
                                <path
                                    d="M16.2 2.94a2.284 2.284 0 013.22 3.24l-1.43 1.43-3.23-3.24 1.44-1.43zm-2.12 2.12l3.23 3.23-8.6 8.6-3.26.03.03-3.23 8.6-8.6z"
                                    fill="#a50034" />
                            </svg>
                        </button>
                        <button class="btn-icon btn-delete" title="Excluir" @click="$emit('remove', p)">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 22 22" width="20"
                                height="20">
                                <path
                                    d="M6.5 6.5v8.25M11 6.5v8.25M15.5 6.5v8.25M4.5 6.5h13m-10-3h7a1 1 0 011 1V6.5H6.5V4.5a1 1 0 011-1z"
                                    stroke="#a50034" stroke-width="1.4" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    name: 'ProductTable',
    props: {
        products: Array
    }
}
</script>