<template>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="product_name">Znajdź produkty</label>
                <input @keyup="findProduct()" type="text" v-model="product_name" id="product_name"
                       name="product_name" class="form-control" placeholder="Szukaj produktów">

                <ul class="list-group">
                    <li class="list-group-item" v-for="product in products"> {{product.name}}
                        <button type="button" @click="addProduct(product,product.id)"
                                style="background: none; border: none;" class="pull-right"><i
                                @click="clearList(products)" class="fa fa-plus-square-o" aria-hidden="true"></i>
                        </button>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Dodane produkty</h3>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Nazwa</th>
                                <th>Opis krótki</th>
                                <th>Opis długi</th>
                                <th>Usuń produkt</th>

                            </tr>
                            <tr v-for="product in selectedProducts">
                                <td>
                                    <input v-bind:name="'items_ids[' + product.id + ']'" v-bind:value="product.item_id"
                                           type="hidden">
                                    <input name="product_ids[]" v-bind:value="product.id" type="hidden"> {{product.id}}
                                </td>
                                <td>
                                    <input name="name" v-bind:value="product.name" type="hidden">{{product.name}}
                                </td>
                                <td v-if="product.desc_short !== null">
                                   {{product.desc_short}}
                                </td>
                                <td v-else>
                                    <p>BRAK OPISU</p>
                                </td>
                                <td v-if="product.desc_long !== null">
                                    {{product.desc_long}}
                                </td>
                                <td v-else>
                                    <p>BRAK OPISU</p>
                                </td>
                                <td>
                                    <button type="button" @click="removeProduct(product.id)"
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
        props: [],
        data() {
            return {
                pickedProduct: '',
                product_name: '',
                productId: 0,
                products: [],
                selectedProducts: [],
            }
        },
        methods: {

            findProduct() {
                if (this.product_name == '') {
                    this.products = [];
                }

                axios.post(`/orders/find-products/`, {
                    product_name: this.product_name
                })
                    .then(result => {
                        this.products = result.data
                    })
            },

            addProduct(product, id) {
                this.selectedProducts = this.selectedProducts.filter(product => product.id !== id)
                let myProduct = {
                    name: '',
                    id: '',
                    item_id: 0,
                    desc_short: '',
                    desc_long: ''
                };
                myProduct.name = product.name;
                myProduct.id = product.id;

                if(product.desc_short !== null && product.desc_short.length > 200 ){
                myProduct.desc_short = product.desc_short.substring(0,200)+'...';
                } else{
                    myProduct.desc_short = product.desc_short;
                }
                if(product.desc_short !== null  && product.desc_long.length > 200 ) {
                    myProduct.desc_long = product.desc_long.substring(0, 200) + '...';
                } else{
                    myProduct.desc_long = product.desc_long;
                }
                this.selectedProducts.push(myProduct);
            },

            removeProduct(productId) {
                this.selectedProducts = this.selectedProducts.filter(product => product.id !== productId);

            },

            clearList() {
                this.products = [];
            },
        },

//        created: function () {
//            if (this.saved_products) {
//                this.selectedProducts = this.saved_products.map(product => product);
//            }
//        }
    }
</script>