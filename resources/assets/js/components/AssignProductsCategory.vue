<template>
    <div v-if="finalCategory">
        <div class="row">
            <div class="col-md-5">
                <label>Wszystkie produkty</label>
                <input @keyup="findProducts()" v-model="productName" type="text" class="form-control" placeholder="Wpisz nazwę produktu aby szukać...">
                <ul class="list-group">
                    <li class="list-group-item" v-for="product in allProducts" >
                        {{product.name}}
                        <button type="button" @click="addProductToCategory(product)" style="background: none; border: none;" class="pull-right">
                            <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                        </button>
                    </li>
                </ul>
            </div>


                    <div class="col-md-6">
                        <label>Produkty w kategorii</label>
                        <div class="box">
                            <!--<div class="box-header">-->
                                <!--<h3 class="box-title">Dodane produkty</h3>-->


                            <!-- /.box-header -->
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover">
                                    <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nazwa</th>
                                        <th>Usuń</th>

                                    </tr>
                                    <tr v-for="product in  assignedProducts">
                                        <td>
                                            {{product.id}}
                                        </td>
                                        <td>
                                            {{product.name}}
                                        </td>
                                        <td>
                                            <button type="button" @click="removeProductFromCategory(product)" style="background: none; border: none;">
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
            <!--<div class="col-md-5">-->
                <!--<label>Produkty przypisane do zaznaczonej kategorii</label>-->
                <!--<ul>-->
                    <!--<li v-for="product in  assignedProducts">-->
                        <!--{{product.name}} <button @click="removeProductFromCategory(product)" type="button" class="btn btn-danger">Usun</button>-->
                    <!--</li>-->
                <!--</ul>-->
            <!--</div>-->
        </div>

</template>
<script>
    export default {
        data() {
            return {
                allProducts: [],
                assignedProducts: [],
                productName: ''
            }
        },
        methods: {
            findProducts() {
                if (this.productName == '') {
                    this.allProducts = [];
                }

                axios.post(`/productcategories/find-products`, {
                    product_name: this.productName
                })
                .then(result => {
                    this.allProducts = result.data;
                })

            },
            productsInCategory(category) {
                axios.get(`/products/by-category/${category}`).then(response => {
                    this.assignedProducts = response.data;
                })
            },
            addProductToCategory(product) {
                this.assignedProducts.push(product);

                this.allProducts = this.allProducts.filter(item => item.id !== product.id);

                console.log('id wybranej kategorii: ', this.$store.state.finalCategory);
                //tutaj trzeba puknąc do api z dodaniem produktu do kategorii

//                axios.post(`/products/assign`, {
//                    allProducts: this.productName
//                })
//                    .then(result => {
//                        this.allProducts = result.data;
//                })

            },
            removeProductFromCategory(product) {
                this.assignedProducts = this.assignedProducts.filter(item => item.id !== product.id);

                this.allProducts.push(product);

                console.log('id wybranej kategorii: ', this.$store.state.finalCategory);
                //tutaj puknac do api z odpieciem kategorii
            }
        },
        computed: {
            finalCategory: function() {
                return this.$store.state.finalCategory
            }
        },
        watch: {
            finalCategory: function() {
                this.productsInCategory(this.$store.state.finalCategory);
            }
        }

    }
</script>