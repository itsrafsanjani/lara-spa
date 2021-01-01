<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Product Categories</h5>
                        <router-link :to="{ name: 'category-create'}" class="btn btn-primary">Create Categories</router-link>
                    </div>

                    <div class="card-body">
                        <table class="table text-center">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="category in categories" :key="category.id">
                                <td>{{ category.id }}</td>
                                <td>{{  category.name }}</td>
                                <td>{{  category.slug }}</td>
                                <td>
                                    <router-link :to="{ name: 'category-edit', params: { slug: category.slug} }" class="btn btn-primary btn-sm">Edit</router-link>
                                    <a @click.prevent="deleteCategories(category)" href="#" class="btn btn-danger btn-sm">Delete</a>
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
           categories: []
       }
   },
    methods: {
       loadCategories(){
           axios.get('/api/categories')
           .then(res => {
               this.categories = res.data.data
           })
           .catch(err => {
               console.log(err)
           })
       },
        deleteCategories(category){
           axios.delete(`/api/categories/${category.id}`)
            .then(({data}) => {
                this.$toast.open({
                    message: data,
                    type: 'success',
                    position: 'top-right'
                });

                let index = this.categories.indexOf(category)
                this.$delete(this.categories, index);
            })
        }
    },
    mounted(){
       this.loadCategories()
    }
}
</script>

<style scoped>

</style>
