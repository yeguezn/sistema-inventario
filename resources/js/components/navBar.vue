<script setup>
import {Link} from "@inertiajs/vue3"
</script>


<template>
    <v-app-bar flat>
      <v-container class="mx-auto d-flex align-center justify-center">
        <v-avatar
          class="me-4 "
          color="grey-darken-1"
          size="32"
        ></v-avatar>
        <v-spacer></v-spacer>
        <v-btn>
            <Link href="/create-product" as="button">Crear producto</Link>
        </v-btn>

    </v-container>
    </v-app-bar>
</template>