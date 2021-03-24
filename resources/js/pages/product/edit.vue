<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Product</h5>
                        <router-link :to="{ name: 'product-list' }" class="btn btn-primary">Product List</router-link>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <form @submit.prevent="updateProduct">
                                    <div class="form-group">
                                        <label for="productTitle">Product Title</label>
                                        <input type="text" v-model="productForm.title" class="form-control"
                                               :class="{ 'is-invalid': productForm.errors.has('title') }"
                                               id="productTitle" placeholder="Product Title">
                                        <has-error :form="productForm" field="title"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label for="productCategory">Product Category</label>
                                        <select id="productCategory" v-model="productForm.category_id"
                                                class="form-control">
                                            <option disabled>Select Category</option>
                                            <option v-for='category in categories' :value='category.id' selected>
                                                {{ category.name }}
                                            </option>
                                        </select>
                                        <has-error :form="productForm" field="title"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label for="productPrice">Product Price</label>
                                        <input type="text" v-model="productForm.price" class="form-control"
                                               :class="{ 'is-invalid': productForm.errors.has('price') }"
                                               id="productPrice" placeholder="Product Price">
                                        <has-error :form="productForm" field="price"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label for="productImage">Product Image</label>
                                        <input type="file" class="form-control-file" @change="onImageChange"
                                               :class="{ 'is-invalid': productForm.errors.has('image') }"
                                               id="productImage" placeholder="Product Image">
                                        <has-error :form="productForm" field="image"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label for="productDescription">Product Description</label>
                                        <textarea type="text" v-model="productForm.description" class="form-control"
                                                  :class="{ 'is-invalid': productForm.errors.has('description') }"
                                                  id="productDescription" placeholder="Product Description"
                                                  rows="3"></textarea>
                                        <has-error :form="productForm" field="description"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Update Product</button>
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
import {Form} from 'vform'
import {objectToFormData} from "object-to-formdata";

export default {
    data() {
        return {
            categories: [],
            productForm: new Form({
                category_id: '',
                title: '',
                price: '',
                image: '',
                description: '',
            })
        }
    },
    methods: {
        loadCategories() {
            axios.get('/api/categories')
                .then(res => {
                    this.categories = res.data.data
                })
                .catch(err => {
                    console.log(err)
                })
        },
        updateProduct() {
            let slug = this.$route.params.slug;

            this.productForm.put(`/api/products/${slug}`, {
                    transformRequest: (data, headers) => {
                        return objectToFormData(data)
                    },
                    onUploadProgress: e => {
                        console.log(e)
                    }
                })
                .then(({data}) => {
                    this.productForm.category_id = '';
                    this.productForm.title = '';
                    this.productForm.price = '';
                    this.productForm.image = '';
                    this.productForm.description = '';

                    this.$toast.open({
                        message: data,
                        type: 'success',
                        position: 'top-right'
                    });
                })
                .catch(err => {
                    this.$toast.open({
                        message: err,
                        type: 'error',
                        position: 'top-right'
                    });
                })
        },
        loadProduct() {
            let slug = this.$route.params.slug;

            axios.get(`/api/products/${slug}`)
                .then(res => {
                    this.productForm.title = res.data.title
                    this.productForm.category_id = res.data.category_id;
                    this.productForm.title = res.data.title;
                    this.productForm.price = res.data.price;
                    this.productForm.image = res.data.image;
                    this.productForm.description = res.data.description;
                })
        },
        onImageChange(e) {
            const file = e.target.files[0]

            this.productForm.image = file
        }
    },
    mounted() {
        this.loadProduct()
        this.loadCategories()
    }
}
</script>

<style scoped>

</style>
