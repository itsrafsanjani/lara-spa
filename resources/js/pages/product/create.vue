<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Create Category</h5>
                        <router-link :to="{ name: 'category-list' }" class="btn btn-primary">Category List</router-link>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <form @submit.prevent="createCategories">
                                    <div class="form-group">
                                        <label for="categoryName">Category Name</label>
                                        <input type="text" v-model="categoryForm.name" class="form-control" :class="{ 'is-invalid': categoryForm.errors.has('name') }" id="categoryName" placeholder="Category Name">
                                        <has-error :form="categoryForm" field="name"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Create Category</button>
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
            categoryForm: new Form({
                name: ''
            })
        }
    },
    methods: {
        createCategories(){
            this.categoryForm.post('/api/categories')
            .then(({ data }) => {
                this.categoryForm.name = '';

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
        }
    }
}
</script>

<style scoped>

</style>
