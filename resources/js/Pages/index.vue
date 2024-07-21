<script setup>
import { Link } from "@inertiajs/vue3"

const props = defineProps({
    productos:Array
})

</script>

<template>
    <ul>
        <li>
            <Link href="/">Inicio</Link>
        </li>
        <li>
            <Link href="/create-product">Crear Producto</Link>
        </li>

        <ul>
            <li v-for="producto in props.productos">
                <Link :href="`/edit-productImage/${producto.nombre}/${producto.id}`">
                    <img :src="`uploads/${producto.imagen}`" alt="">
                </Link>
                <p>{{producto.nombre}}</p>
                <p>{{producto.precio}}</p>
                <p>
                    <Link :href="`/delete-product/${producto.id}`"
                    method="delete" as="button">
                        Eliminar
                    </Link>
                </p>

            </li>
        </ul>
    </ul>
</template>