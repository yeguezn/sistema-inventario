<script setup>
import { Link } from "@inertiajs/vue3"

const props = defineProps({
    message:String
})

</script>

<template>
    <h1>{{props.message}}</h1>
    <Link href="/">Volver al inicio</Link>
</template>