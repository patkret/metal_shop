<template>

    <div class="form-group">
        <select class="form-control" @change="fetchChildren(selectedCategory)" id="categories" v-model="selectedCategory">

            <option value="">Wybierz kategorię</option>
            <option v-for="category in categories" v-bind:value="category.id">
                {{category.name}}
                <input type="hidden" v-model="selectedCategory" name="category_id">
            </option>

        </select>

        <div v-if="this.subcategories.length">

            <select class="form-control" @change="fetchSubcatChild(selectedSubcategory)" id="subcategories"
                    v-model="selectedSubcategory">
                <option value="">Wybierz podkategorię</option>
                <option v-for="subcategory in subcategories" v-bind:value="subcategory.id">
                    {{subcategory.name}}
                    <input type="hidden" v-model="selectedSubcategory" name="subcategory_id">
                </option>
            </select>

        </div>
        <div v-if="this.subcategories_lvl1.length">

            <select class="form-control" @change="fetchSubcatChild_lvl1(selectedSubcategory_lvl1)" id="subcategories_lvl1"
                    v-model="selectedSubcategory_lvl1">
                <option value="">Wybierz podkategorię</option>
                <option v-for="subcategory_lvl1 in subcategories_lvl1" v-bind:value="subcategory_lvl1.id">
                    {{subcategory_lvl1.name}}
                    <input type="hidden" v-model="selectedSubcategory_lvl1" name="subcategorylvl1_id">
                </option>
            </select>

        </div>

        <div v-if="this.subcategories_lvl2.length">

            <select class="form-control" @change="fetchChildren(selectedSubcategory_lvl2)" id="subcategories_lvl2"
                    v-model="selectedSubcategory_lvl2">
                <option value="">Wybierz podkategorię</option>
                <option v-for="subcategory_lvl2 in subcategories_lvl2" v-bind:value="subcategory_lvl2.id">
                    {{subcategory_lvl2.name}}
                </option>
            </select>

        </div>
    </div>

</template>
<script>
    import axios from 'axios';


    export default {
        props: ['category'],
        data() {
            return {
                categories: [],
                subcategories: [],
                subcategories_lvl1: [],
                subcategories_lvl2: [],
                subcategories_lvl3: [],
                children: [],
                selectedCategory: '',
                selectedSubcategory: '',
                selectedSubcategory_lvl1: '',
                selectedSubcategory_lvl2: '',


            }
        },
        methods: {

            fetchCategories() {

                axios.get(`/categories/roots`).then(response => {
                    this.categories = response.data

                })

            },


            fetchChildren(selectedCategory) {

                axios.get('/categories/' + selectedCategory + '/children').then(response => {
                        this.subcategories = response.data;

                    console.log(this.subcategories);
                })

            },

            fetchSubcatChild(selectedSubcategory){

                axios.get('/categories/'+selectedSubcategory+'/children').then(response => {
                    this.subcategories_lvl1 = response.data;
                })
            },
            fetchSubcatChild_lvl1(selectedSubcategory_lvl1){

                axios.get('/categories/'+selectedSubcategory_lvl1+'/children').then(response => {
                    this.subcategories_lvl2 = response.data;
                })
            },
            fetchSubcatChild_lvl2(selectedSubcategory_lvl2){

                axios.get('/categories/'+selectedSubcategory_lvl2+'/children').then(response => {
                    this.subcategories_lvl3 = response.data;
                })
            }

        },


        created: function () {

            this.fetchCategories();

        }


    }
</script>