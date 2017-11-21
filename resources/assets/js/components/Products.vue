<template>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="product_name">Znajdź produkty</label>
                        <input @keyup="findProduct()" type="text" v-model="product_name" id="product_name"
                           name="product_name" class="form-control" placeholder="Szukaj produktów">


                    <ul class="list-group">
                        <li class="list-group-item" v-for="product in products"> {{product.name}}
                            <button type="button" @click="addProduct(product,product.id)" style="background: none; border: none;" class="pull-right"><i
                                    @click="clearList(products)" class="fa fa-plus-square-o" aria-hidden="true"></i>
                            </button>
                        </li>
                    </ul>


            </div>
        </div>


        <div class="row" >
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Dodane produkty</h3>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody >
                            <tr>
                                <th>ID</th>
                                <th>Nazwa</th>
                                <th>Kod produktu</th>
                                <th>Ilość</th>
                                <th>Usuń produkt</th>

                            </tr>
                            <tr v-for="product in selectedProducts">
                                <td>
                                    <input v-bind:name="'items_ids[' + product.id + ']'" v-bind:value="product.item_id" type="hidden">
                                    <input name="product_ids[]" v-bind:value="product.id" type="hidden"> {{product.id}}
                                </td>
                                <td>
                                    <input name="name" v-bind:value="product.name" type="hidden">{{product.name}}
                                </td>
                                <td>
                                    <input name="code" v-bind:value="product.code" type="hidden">{{product.code}}
                                </td>
                                <td>
                                    <input type="number" v-bind:name="'product_quantity[' + product.id + ']'" v-model="product.quantity">
                                </td>
                                <td>
                                    <button type="button" @click="removeProduct(product.item_id, product.id)" style="background: none; border: none;">
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


    <!-- /.box-body -->
    <!--</div>-->
    <!--&lt;!&ndash; /.box &ndash;&gt;-->
    <!--</div>-->


</template>
<script>


    export default {
        props: ['saved_products'],
        data() {
            return {
                pickedProduct: '',
                product_name: '',
                productId:0,
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
                    code: '',
                    quantity: 1,
                    item_id: 0
                };
                myProduct.name = product.name;
                myProduct.id = product.id;
                myProduct.code = product.code;


                this.selectedProducts.push(myProduct);

            },

            removeProduct(itemId, productId) {
                this.selectedProducts = this.selectedProducts.filter(product => product.id !== productId);


                if(itemId > 0) {
                    axios.delete('/orders/delete-item/' + itemId).then(
                        result => {
                            console.log(result);
                        }
                    )
                }
            },

            clearList() {
                this.products = [];

            },


        },
        created: function() {
            if(this.saved_products) {
                this.selectedProducts = this.saved_products.map(product => product);
            }
        }

    }
</script>