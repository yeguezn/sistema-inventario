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
    <h1>Actualizar Imagen del {{ props.nombreProducto }}</h1>
    {{ props.errors }}
    <form @submit.prevent="enviarFormulario">
        <div>
            <input type="file" @input="(e) => subirArchivo(e)">
        </div>
        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
            {{ form.progress.percentage }}%
        </progress>
        <div>
            <input type="submit">
        </div>
    </form>
</template>