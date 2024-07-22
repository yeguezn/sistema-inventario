<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
    nombreProducto:String,
    productoId:Number,
    errors:Object
})

const form = useForm({
    imagen:null
})

function enviarFormulario() {
    form.post(`/update-productImage/${props.productoId}`)
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
                <h1 class="text-center mb-4 head-title">Cambiar imagen de Producto</h1>
                <v-form @submit.prevent="enviarFormulario"  class="d-flex justify-center flex-column">
                
                    <v-file-input @input="(e) => subirArchivo(e)" variant="outlined"
                    >
                    </v-file-input>
                    <div v-if="errors.imagen">{{ errors.imagen }}</div>
                    <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                        {{ form.progress.percentage }}%
                    </progress>

                    <v-btn color="primary" type="submit" class="mt-4">
                        guardar
                    </v-btn>
                </v-form>
                
            </v-sheet>
        </v-main>
    </v-app>
</template>