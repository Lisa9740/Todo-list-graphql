
<template>
    <v-dialog
        v-model="dialog"
        width="500"
    >
        <template>
            <v-btn
                color="red lighten-2"
                dark
            >
                Editer
            </v-btn>
        </template>

        <v-card>
            <v-card-title class="headline grey lighten-2">
                Nouvelle tâche
            </v-card-title>

            <v-card-text>
                <v-text-field label="Nom de la tâche" v-model="title" :value="this.props.todos"></v-text-field>
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
                    :value=todo.description
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
                    @click=""
                >
                    Ajouter
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import axios from 'axios';


export default {
    computed: {},

};
</script>
