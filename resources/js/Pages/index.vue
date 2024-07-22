<script setup>
import ProductCard from '../components/ProductCard.vue'
import navBar from "../components/navBar.vue"
const props = defineProps({
    productos:Array
})

</script>

<template>
    <v-app>
        <navBar></navBar>
        <v-main class="bg-grey-lighten-3">
            <v-container>
                <v-row>
                    <v-col
                    v-for="producto in productos"
                    :key="producto.id"
                    cols="4"
                    >
                        <ProductCard :nombre="producto.nombre" :id="producto.id"
                        :precio="producto.precio" :cantidad="producto.cantidad"
                        :imagen="producto.imagen"/>

                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </v-app>
</template>