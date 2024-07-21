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
    <h1>Crear Producto</h1>
    {{ errors }}
    <form @submit.prevent="enviarFormulario">
        <div>
            <input type="text" placeholder="codigo" v-model="form.codigo">
        </div>

        <div>
            <input type="text" placeholder="nombre" v-model="form.nombre">
        </div>
        <div>
            <input type="file" @input="(e) => subirArchivo(e)">
        </div>
        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
            {{ form.progress.percentage }}%
        </progress>
        <div>
            <input type="text" placeholder="cantidad" v-model="form.cantidad">
        </div>
        <div>
            <input type="text" placeholder="precio" v-model="form.precio">
        </div>
        <div>
            <input type="submit">
        </div>
    </form>
</template>