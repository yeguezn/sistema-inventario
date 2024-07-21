<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
    producto:Object,
    errors:Object
})

const form = useForm({
    codigo : props.producto.codigo,
    nombre : props.producto.nombre,
    cantidad : props.producto.cantidad,
    precio : props.producto.precio
})

function enviarFormulario() {
    form.put(`/update-product/${props.producto.id}`)
}

</script>

<template>
    <h1>Editar Producto</h1>
    {{ props.errors }}
    <form @submit.prevent="enviarFormulario">
        <div>
            <input type="text" placeholder="codigo" v-model="form.codigo">
        </div>

        <div>
            <input type="text" placeholder="nombre" v-model="form.nombre">
        </div>
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