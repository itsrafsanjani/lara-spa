<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Create Product</h5>
                        <router-link :to="{ name: 'product-list' }" class="btn btn-primary">Product List</router-link>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <form @submit.prevent="createProducts">
                                    <div class="form-group">
                                        <label for="productTitle">Product Title</label>
                                        <input type="text" v-model="productForm.title" class="form-control" :class="{ 'is-invalid': productForm.errors.has('title') }" id="productTitle" placeholder="Product Title">
                                        <has-error :form="productForm" field="title"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label for="productPrice">Product Price</label>
                                        <input type="text" v-model="productForm.price" class="form-control" :class="{ 'is-invalid': productForm.errors.has('price') }" id="productPrice" placeholder="Product Price">
                                        <has-error :form="productForm" field="price"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label for="productImage">Product Image</label>
                                        <input type="file" class="form-control-file" :class="{ 'is-invalid': productForm.errors.has('image') }" id="productImage" placeholder="Product Image">
                                        <has-error :form="productForm" field="image"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label for="productDescription">Product Description</label>
                                        <textarea type="text" v-model="productForm.description" class="form-control" :class="{ 'is-invalid': productForm.errors.has('description') }" id="productDescription" placeholder="Product Description" rows="3"></textarea>
                                        <has-error :form="productForm" field="description"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Create Product</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Form } from 'vform'

export default {
    data(){
        return {
            productForm: new Form({
                title: '',
                price: '',
                image: '',
                description: '',
            })
        }
    },
    methods: {
        createProducts(){
            this.productForm.post('/api/products')
            .then(({ data }) => {
                console.log(data)
                // this.productForm.name = '';
                //
                // this.$toast.open({
                //     message: data,
                //     type: 'success',
                //     position: 'top-right'
                // });
            })
            .catch(err => {
                this.$toast.open({
                    message: err,
                    type: 'error',
                    position: 'top-right'
                });
            })
        }
    }
}
</script>

<style scoped>

</style>
