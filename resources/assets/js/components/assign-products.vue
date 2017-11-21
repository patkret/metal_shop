<template>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="product_name">Znajdź produkty</label>
                <input @keyup="findProducts()" type="text" v-model="product_name" id="product_name"
                       name="product_name" class="form-control" placeholder="Szukaj produktów">

                <div class="row">
                    <input type="checkbox" id="if_available" v-model="available">
                    <label for="if_available">dostępne</label>


                    <input type="radio" id="assigned" name="rr" value="IN">
                    <label for="assigned">przypisane</label>

                    <input type="radio" id="assigned2" name="rr" value="OUT">
                    <label for="assigned2">niie przypisane</label>

                </div>

                <br>
                <ul class="list-group">
                    <li class="list-group-item" v-for="product in products"> {{product.name}}
                        <button type="button" class="pull-right" @click="addProduct(product, product.id)"
                                style="background: none; border: none;"><i class="fa fa-arrow-right"></i></button>
                    </li>
                </ul>

            </div>


            <!--CATEGORIES-->
            <div class="col-md-6">
                <label for="category_name">Znajdź kategorie</label>
                <input @keyup="findCategory()" type="text" v-model="category_name"
                       id="category_name"
                       name="product_name" class="form-control" placeholder="Szukaj kategorii">
                <input type="hidden" name="user_id">


                <ul class="list-group">
                    <li class="list-group-item" v-for="category in categories_list"> {{category.name}}
                        <input type="hidden" v-bind:name="'category_id[' + category.id + ']'" class="pull-right"
                               v-bind:value="category.id">
                        <button type="button"
                                @click=" chooseCategory(category, category.id); fetchProductsInCategory(category);"
                                style="background: none; border: none;"><i
                                @click="clearList(categories_list)" class="fa fa-plus-square-o" aria-hidden="true"></i>
                        </button>
                    </li>
                </ul>

                <div style="display: inline-block; margin: 10px;" v-for="category in selected_categories">
                    <button type="button" class="btn btn-primary" @click="removeCategory(category.id)">{{category.name}}<i
                            @click="clearList(categories_list)" class="fa fa-trash" style="margin: 5px"
                            aria-hidden="true"></i></button>
                </div>

                <br>
                <br>

                <div class="row" v-for="category in selected_categories" >
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">{{category.name}}- produkty</h3>

                            </div>
                             <!--/.box-header -->
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover">
                                    <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nazwa</th>
                                        <th>Usuń</th>
                                    </tr>
                                    <tr v-for="product in productsInCategory[category.id]">
                                        <td>

                                            <input v-bind:name="'products_ids[' + product.id + ']'" v-bind:value="product.id" type="hidden">{{product.id}}
                                        </td>
                                        <td>
                                            {{product.name}}
                                        </td>
                                        <td>
                                            <button type="button"  style="background: none; border: none;">
                                                <i class="fa fa-minus" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>

            </div>
        </div>
    </div>


</template>
<script>

    import axios from 'axios';

    export default {

        data() {
            return {
                products: [],
                productsInCategory: {},
                product_name: '',
                selectedProducts: [],
                categories_list: [],
                category_name: '',
                selected_category: '',
                selected_categories: [],
                assigned: false,
                available: true,


            }
        },
        methods: {
            //for Products
            findProducts() {
                if (this.product_name == '') {
                    this.products = [];
                }

                axios.post('/orders/find-products', {
                    product_name: this.product_name
                })
                    .then(result => {
                        this.products = result.data;
                        console.log(this.products);
                    })

            },

            addProduct(product, id) {
                this.selectedProducts = this.selectedProducts.filter(product => product.id !== id)

                let myProduct = {
                    name: '',
                    id: '',
                };
                myProduct.name = product.name;
                myProduct.id = product.id;

                this.selectedProducts.push(myProduct);

            },

            //for categories

            findCategory() {
                if (this.category_name == '') {
                    this.categories_list = [];
                }

                axios.post('products/find-category', {
                    category_name: this.category_name
                })
                    .then(result => {
                        this.categories_list = result.data;
                        console.log(this.categories_list);
                    })
            },

            chooseCategory(category) {

                let Category = {
                    name: '',
                    id: '',
                };
                Category.name = category.name;
                Category.id = category.id;
                this.selected_categories.push(Category);

            },

            fetchProductsInCategory(category) {

                axios.get('/products/by-category/' + category.id).then(response => {

                     this.productsInCategory[category.id] = response.data;
                    console.log(response.data);
                })
            },

            removeCategory(id){
                this.selected_categories = this.selected_categories.filter(category => category.id !== id)
            },

            clearList() {
                this.categories_list = [];
            },

            removeProductFromCategory(category){
                this.productsInCategory[category.id] = this.productsInCategory[category.id].filter(product => product.id !== productId);
            }

        },



    }
</script>