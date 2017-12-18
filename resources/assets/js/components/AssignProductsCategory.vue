<template>
    <div v-if="finalCategory">
        <div class="row">
            <div class="col-md-5">
                <label>Wszystkie produkty</label>
                <input @keyup="findProducts()" v-model="productName" type="text" class="form-control"
                       placeholder="Wpisz kod produktu aby szukać...">
                <div class="col">
                    <label for="IN"><input type="radio" id="IN" value="IN" v-model="assigned">Przypisane</label>

                    <label for="NOTIN"><input type="radio" id="NOTIN" value="NOT IN"
                                              v-model="assigned">Nieprzypisane</label>
                </div>
                <ul class="list-group">
                    <li class="list-group-item" v-for="product in allProducts">
                        {{product.name}} || KOD: {{product.code}}
                        <button type="button" @click="addProductToCategory(product)"
                                style="background: none; border: none;" class="pull-right">
                            <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                        </button>
                    </li>
                </ul>
            </div>


            <div class="col-md-6">
                <label>Produkty w kategorii</label>
                <div class="box">
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
                                    <button type="button" @click="removeProductFromCategory(product)"
                                            style="background: none; border: none;">
                                        <i class="fa fa-minus" aria-hidden="true"></i></button>
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
        data() {
            return {
                allProducts: [],
                assignedProducts: [],
                productName: '',
                assigned: '',
            }
        },
        methods: {
            findProducts() {
                if (this.productName == '') {
                    this.allProducts = [];
                }

                axios.post(`/productcategories/find-products/`, {
//                axios.post(`/random`, {
                    assigned: this.assigned,
                    product_name: this.productName
                })
                    .then(result => {
                        this.allProducts = result.data;
                        console.log(result)
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

                axios.post(`/productcategories/assign/${product.id}/${this.$store.state.finalCategory}`).then(
                    result => {
                        console.log(result);
                    }
                )


            },
            removeProductFromCategory(product) {
                this.assignedProducts = this.assignedProducts.filter(item => item.id !== product.id);

                this.allProducts.push(product);

                console.log('id wybranej kategorii: ', this.$store.state.finalCategory);

                if (product.id > 0) {
                    axios.delete(`/productcategories/delete-product/${product.id}/${this.$store.state.finalCategory}`).then(
                        result => {
                            console.log(result);
                        }
                    )
                }

            }
        },
        computed: {
            finalCategory: function () {
                return this.$store.state.finalCategory
            }
        },
        watch: {
            finalCategory: function () {
                this.productsInCategory(this.$store.state.finalCategory);
            }
        }

    }
</script>