<template>
    <div>
        <div class="form-group">
            <label>Kategoria</label>
            <select @change="fetchChildren(1)" class="form-control" v-model="selectedCategory">
                <option value="">Wybierz kategorię</option>
                <option v-for="category in categories" :value="category.id">
                    {{category.name}}
                </option>
            </select>
        </div>

        <div v-for="childs in children" class="form-group">
            <label>Podkategoria {{childs.level+1}}</label>
            <select @click="fetchChildren(childs.level+1)" v-model="selectedChild['l_'+parseInt(childs.level+1)]" class="form-control">
                <option value="">Wybierz podkategorię</option>
                <option v-for="child in childs.data" :value="child.id">
                    {{child.name}}
                </option>
            </select>

        </div>


    </div>

</template>
<script>
    export default {
        data() {
            return {
                categories: [],
                selectedCategory: '',
                children: [],
                selectedChild: {}
            }
        },
//        computed: {
//            selected: function() {
//                return this.selectedChild.id;
//            }
//        },
        methods: {

            fetchCategories() {

                axios.get(`/categories/roots`).then(response => {
                    this.categories = response.data;
                });

            },

            fetchChildren(level) {

                let picked = this.selectedCategory;
                if(level > 1) {
                    picked = this.selectedChild['l_'+level];
                } else {
                    this.children = [];
                }

                this.$store.state.finalCategory = picked;

                axios.get(`/categories/${picked}/children`).then(response => {
                    const {data} = response;
                    if(data.length < 1) {
                        return;
                    }

                    const index = this.children.findIndex(item => item.level === level);

                    if(index < 0) {
                        this.children.push({
                            level,
                            data
                        });
                    } else {
                        this.children[index].data = data;
                    }
                })

            }

        },


        created: function () {

            this.fetchCategories();

        }


    }
</script>