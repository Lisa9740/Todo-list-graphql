<template>
    <div>
        <v-container>
            <h1>Ma todo list</h1>
            <v-card  elevation="2"
                     v-for="todo in todos.todos" v-bind:key="todo.id"
            >
                <v-card-text>
                    {{ todo.title }}
                </v-card-text>

            </v-card>
        </v-container>

    </div>
</template>
<script>
import axios from 'axios';



export default {
    computed: {},
    data() {
        return {
            todos: [],
            message:'Ma TODO list'
        }
    },
    methods : {
        retrieveTodos : function () {
            this.todos = []
            console.log(this.todos)
            axios({
                url: '/graphql',
                method: 'POST',
                data: {
                    query: `{
                            todos{
                              title
                              }}`
                }
            }).then((result) => {
                console.log(result.data)
                this.todos = result.data.data
            });
        }
    },
    created() {
        this.retrieveTodos();
    },

};
</script>
