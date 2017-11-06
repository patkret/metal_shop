<template>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="product_name">Znajdź produkty</label>
                        <input @keyup="findProduct()" type="text" v-model="product_name" id="product_name"
                           name="product_name" class="form-control" placeholder="Szukaj produktów">


                    <ul class="list-group">
                        <li class="list-group-item" v-for="product in products"> {{product.name}}
                            <button @click="addProduct(product)" style="background: none; border: none;"><i
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
                                <th>Usuń</th>

                            </tr>
                            <tr v-for="product in selectedProducts">
                                <td>
                                    <input name="selectedProducts[]" v-bind:value="product.id" type="hidden">
                                    {{product.id}}
                                </td>
                                <td>
                                    <input name="selectedProducts[]" v-bind:value="product.name" type="hidden">
                                    {{product.name}}
                                </td>
                                <td>
                                    <input name="selectedProducts[]" v-bind:value="product.code" type="hidden">{{product.code}}
                                </td>
                                <td>
                                    <input name="productQuantity" type="number" v-model="productQuantity">{{product.quantity}}
                                </td>
                                <td>
                                    <button @click="removeProduct(product.id)" style="background: none; border: none;">
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
        data() {
            return {
                pickedProduct: '',
                product_name: '',
                products: [],
                productId: 0,
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

            addProduct(product) {
                this.pickedProduct = product.name;
                this.productId = product.id;
                this.selectedProducts.push(product);

            },

            removeProduct(id) {
                this.selectedProducts = this.selectedProducts.filter(product => product.id !== id);
            },


            clearList() {
                this.products = [];

            }

        }

    }
</script>