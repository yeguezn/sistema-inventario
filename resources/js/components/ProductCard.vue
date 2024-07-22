<script setup>
import { Link } from "@inertiajs/vue3"

const props = defineProps({
    nombre:String,
    id:Number,
    precio:Number,
    cantidad:Number,
    imagen:String
})

</script>

<template>
    <v-card>
        <Link :href="`/edit-productImage/${props.nombre}/${props.id}`">
            <v-img
            :src="`uploads/${props.imagen}`"
            height="180px" cover>
            </v-img>
        </Link>
        <v-card-title>
            {{props.nombre}}
        </v-card-title>

        <v-card-text>
            <p class="mb-2">
                <v-chip>${{ props.precio }}</v-chip>
            </p>
            <v-chip>Cantidad: {{ props.cantidad }}</v-chip>
        </v-card-text>

        <v-card-actions>
            <v-btn>
                <Link :href="`/delete-product/${props.id}`"
                method="delete" as="button">
                    Eliminar
                </Link>
            </v-btn>

            <v-btn>
                <Link :href="`/edit-product/${props.id}`"
                as="button">
                    Editar
                </Link>
            </v-btn>

            <v-btn>
                <Link :href="`/sale-product/${props.nombre}/${props.id}`"
                as="button">
                    Vender
                </Link>
            </v-btn>
        </v-card-actions>

    </v-card>
</template>