<template>
    <div v-if="finalCategory">
        <div class="row">
            <div class="col-md-5">
                <label>Wszystkie produkty</label>
                <input @keyup="findProducts()" v-model="productName" type="text" class="form-control" placeholder="wpisz nazwe produktua by szukać...">
                <ul>
                    <li v-for="product in allProducts">
                        {{product.name}} <button @click="addProductToCategory(product)" class="btn btn-success">Dodaj</button>
                    </li>
                </ul>

            </div>
            <div class="col-md-5">
                <label>Produkty przypisane do zaznaczonej kategorii</label>
                <ul>
                    <li v-for="product in  assignedProducts">
                        {{product.name}} <button @click="removeProductFromCategory(product)" type="button" class="btn btn-danger">Usun</button>
                    </li>
                </ul>
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