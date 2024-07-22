<script setup>
import { useForm } from '@inertiajs/vue3'

defineProps({
    errors:Object
})

const form = useForm({
    codigo:null,
    nombre:null,
    imagen:null,
    cantidad:null,
    precio:null
})

function enviarFormulario() {
    form.post("/store-product")
}

function subirArchivo(event) {
    form.imagen = event.target.files[0]
}

</script>

<template>
    <v-app>
        <v-main>
            <v-sheet class="mx-auto d-flex justify-center flex-column mt-15" 
            width="500" height="500">
                <h1 class="text-center mb-4 head-title">Crear Producto</h1>
                <v-form @submit.prevent="enviarFormulario"  class="d-flex justify-center flex-column">
                    
                    <v-text-field label="Código" variant="outlined" 
                    type="text" v-model="form.codigo"/>
                    <div v-if="errors.codigo">
                        {{ errors.codigo }}
                    </div>
                    
                    <v-text-field label="Nombre" variant="outlined" 
                    type="text" v-model="form.nombre"/>
                    <div v-if="errors.nombre">{{ errors.nombre }}</div>
                    
                    <v-file-input @input="(e) => subirArchivo(e)" variant="outlined"
                    >
                    </v-file-input>
                    <div v-if="errors.imagen">{{ errors.imagen }}</div>
                    <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                        {{ form.progress.percentage }}%
                    </progress>
                    
                    <v-text-field label="Cantidad" variant="outlined" 
                    type="text" v-model="form.cantidad"/>
                    <div v-if="errors.cantidad">{{ errors.cantidad }}</div>

                    <v-text-field label="Precio" variant="outlined" 
                    type="text" v-model="form.precio"/>
                    <div v-if="errors.precio">{{ errors.precio }}</div>

                    <v-btn color="primary" type="submit" class="mt-4">
                        guardar
                    </v-btn>
                </v-form>
                
            </v-sheet>
        </v-main>
    </v-app>
</template>

<style scoped>
</style>