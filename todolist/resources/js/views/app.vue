<template>
    <v-app>

        <v-container>
            <h1>Ma todo list</h1>
            <v-dialog
                v-model="dialog"
                width="500"
            >
                <template v-slot:activator="{ on, attrs }">
                    <v-btn
                        color="red lighten-2"
                        dark
                        v-bind="attrs"
                        v-on="on"
                    >
                        Ajouter
                    </v-btn>
                </template>

                <v-card>
                    <v-card-title class="headline grey lighten-2">
                        Nouvelle tâche
                    </v-card-title>

                    <v-card-text>
                        <v-text-field label="Nom de la tâche" v-model="title"></v-text-field>
                        <v-menu
                            ref="menu"
                            v-model="menu"
                            transition="scale-transition"
                            offset-y
                            min-width="auto"
                        >
                            <template v-slot:activator="{ on, attrs }">
                                <v-text-field
                                    v-model="date"
                                    label="Choisir une date d'execution"
                                    prepend-icon="mdi-calendar"
                                    readonly
                                    v-bind="attrs"
                                    v-on="on"
                                ></v-text-field>
                            </template>
                            <v-date-picker
                                v-model="date"
                                no-title
                                scrollable
                            >
                                <v-spacer></v-spacer>
                                <v-btn
                                    text
                                    color="primary"
                                    @click="menu = false"
                                >
                                    Cancel
                                </v-btn>
                                <v-btn
                                    text
                                    color="primary"
                                    @click="$refs.menu.save(date)"
                                >
                                    OK
                                </v-btn>
                            </v-date-picker>
                        </v-menu>
                        <v-textarea
                            name="input-7-1"
                            label="Description"
                            v-model="description"
                            value=""
                            hint="Hint text"
                        ></v-textarea>

                        <v-radio-group v-model="radioGroup">
                            <v-radio
                                v-for="n in priorities"
                                :key="n"
                                :label="`Priorité ${n}`"
                                :value="n"
                            ></v-radio>
                        </v-radio-group>
                    </v-card-text>

                    <v-divider></v-divider>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                            color="primary"
                            text
                            @click="createTodo"
                        >
                           Ajouter
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-card
                elevation="2"
                class="mt-7"
                v-for="todo in todos.todos" v-bind:key="todo.id"
            >
                <v-card-text>
                    {{ todo.title }} {{ todo.priority }}
                </v-card-text>
                <v-card-actions>

                </v-card-actions>
            </v-card>
        </v-container>

    </v-app>
</template>
<script>
import axios from 'axios';
import EditTodo from '../components/editTodo.vue';

export default {
    computed: {},
    data() {
        return {
            todos: [],
            priorities : ['Haute', 'Moyenne', 'Basse'],
            title:'',
            description:'',
            message:'Ma TODO list',
            radioGroup: 1,
            date: '',
            menu: false,
            dialog: false,
        }
    },
    components : { EditTodo },
    methods : {
        createTodo : function () {
            this.todos = []
            console.log(this.todos)
            axios({
                url: '/graphql',
                method: 'POST',
                data: {
                    query:
                        `mutation{
                        createTodo(title:"${ this.title }", date_execution:"2021-01-27", priority:"${ this.radioGroup }",
                                   description:"${ this.description }", is_executed:false)
                        {
                            id
                            title
                            date_execution
                            priority
                            description
                        }
                    }`
                }
            }).then((result) => {
                console.log(result.data)
                this.todos.push(result.data.data)
                this.dialog = false
                this.retrieveTodos()
            });
        },
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
                              date_execution
                              priority
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
