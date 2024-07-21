<script setup>
const props = defineProps({
    productoId:Number,
    nombreProducto:String
})

</script>

<template>
    <h1>Realizar Venta de {{ props.nombreProducto }}</h1>
    <form @submit.prevent="">
        <div>
            <input type="text" placeholder="">
        </div>
        <div>
            <input type="text" placeholder="">
        </div>
        <div>
            <input type="text" placeholder="">
        </div>
        <div>
            <input type="text" placeholder="">
        </div>
        <div>
            <input type="text" placeholder="">
        </div>
        <div>
            <input type="submit">
        </div>
    </form>

</template>