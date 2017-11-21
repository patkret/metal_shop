<template>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
        <!--<button v-if="pickedUser" class="btn btn-success" @click="removeUser()">{{pickedUser}}</button>-->
                <label for="user_name">Znajdź klienta</label>
                        <input @keyup="findUser()" type="text" v-model="user_name" id="user_name" name="user_name" class="form-control" placeholder="Szukaj klienta">
                        <input type="hidden" v-model="userId" name="user_id">

                <ul class="list-group">
                    <li class="list-group-item" v-for="user in users"> {{user.first_name}} {{user.last_name}}
                        <button type="button" @click="pickUser(user)" style="background: none; border: none;">
                            <i @click="clearList(users)" class="fa fa-plus-square-o" aria-hidden="true"></i>
                        </button>
                    </li>
                </ul>
            </div>
        </div>

        <div v-for="client in clients">
             <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <address>
                        <strong>{{client.last_name}} {{client.first_name}}</strong><br>
                        {{client.street}}<br>
                        {{client.city}}<br>
                        {{client.zip_code}}<br>
                        Nr. tel: {{client.phone_no}}<br>
                        Email: {{client.email}}
                    </address>
                </div>
                <input name="clients[]" v-bind:value="client.id" type="hidden"><button type="button" @click="deleteClient(client.id)" style="background: none; border: none;"><i class="fa fa-minus" aria-hidden="true"></i></button>
            </div>
         </div>
    </div>
</template>
<script>


    export default {
        props: ['user_client'],
        data() {
            return {
                pickedUser: '',
                user_name: '',
                users: [],
                userId:'',
                clients: []
            }
        },
        methods: {
            deleteClient(id) {
                this.clients = this.clients.filter(client => client.id !== id)
            },
            findUser() {
                if(this.user_name == '') {
                    this.users = [];
                }

                axios.post(`/orders/find-users/`, {
                    user_name: this.user_name
                })
                    .then(result => {
                        this.users = result.data
                    })
            },
            pickUser(user) {
                this.pickedUser = user.first_name + ' ' + user.last_name;
                this.userId = user.id;
                this.clients = [];
                this.clients.push(user);

            },
            clearList(){
                this.users = [];
            }

        },
        created: function() {
            if(this.user_client) {
                this.pickUser(this.user_client);
            }
        }
    }
</script>