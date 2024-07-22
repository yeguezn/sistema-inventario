<script setup>
import { useForm } from "@inertiajs/vue3"

const props = defineProps({
    productoId:Number,
    nombreProducto:String
})

const form = useForm({
    nombre:null,
    cedula:null,
    banco:null,
    clave:null,
    cantidad:null,
    productoId:props.productoId
})

function enviarFormulario() {

    form.post(`/finish-sale/${props.productoId}`)
    
}

</script>

<template>
    <v-app>
        <v-main>
            <v-sheet class="mx-auto d-flex justify-center flex-column mt-15" 
            width="500" height="500">
                <h1 class="text-center mb-4 head-title">Vender Producto {{ props.nombreProducto }}</h1>
                <v-form @submit.prevent="enviarFormulario"  class="d-flex justify-center flex-column">
                    
                    <v-text-field label="Nombre" variant="outlined" 
                    type="text" v-model="form.nombre"/>
                    
                    <v-text-field label="Cedula" variant="outlined" 
                    type="text" v-model="form.cedula"/>
                    
                    <v-text-field label="Banco" variant="outlined" 
                    type="text" v-model="form.banco"/>

                    <v-text-field label="Cantidad" variant="outlined" 
                    type="text" v-model="form.cantidad"/>
                   
                    <v-text-field label="Clave" variant="outlined" 
                    type="password" v-model="form.clave"/>
        

                    <v-btn color="primary" type="submit" class="mt-4">
                        guardar
                    </v-btn>
                </v-form>
                
            </v-sheet>
        </v-main>
    </v-app>

</template>