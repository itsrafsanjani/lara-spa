<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Product Products</h5>
                        <router-link :to="{ name: 'product-create'}" class="btn btn-primary">Create Products</router-link>
                    </div>

                    <div class="card-body">
                        <table class="table text-center">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="product in products" :key="product.id">
                                <td>{{ product.id }}</td>
                                <td>{{  product.title }}</td>
                                <td>{{  product.slug }}</td>
                                <td>{{  product.price }}</td>
                                <td>
                                    <img :src="product.image" :alt="product.title" :title="product.title" style="width: 100px">
                                </td>
                                <td>{{  product.description }}</td>
                                <td>
                                    <router-link :to="{ name: 'product-edit', params: { slug: product.slug} }" class="btn btn-primary btn-sm">Edit</router-link>
                                    <a @click.prevent="deleteProducts(product)" href="#" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
   data(){
       return {
           products: []
       }
   },
    methods: {
       loadProducts(){
           axios.get('/api/products')
           .then(res => {
               this.products = res.data.data
           })
           .catch(err => {
               console.log(err)
           })
       },
        deleteProducts(product){
           axios.delete(`/api/products/${product.id}`)
            .then(({data}) => {
                this.$toast.open({
                    message: data,
                    type: 'success',
                    position: 'top-right'
                });

                let index = this.products.indexOf(product)
                this.$delete(this.products, index);
            })
        }
    },
    mounted(){
       this.loadProducts()
    }
}
</script>

<style scoped>

</style>
