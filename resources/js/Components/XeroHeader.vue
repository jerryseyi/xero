<script setup>

import {Link} from "@inertiajs/vue3";
</script>

<template>
    <header class="bg-blue-900 p-5 flex w-full justify-center align-center">
        <h3 class="text-white font-bold text-3xl"><Link :href="route('home')">Broadnet</Link></h3>
    </header>
</template>

<style scoped>

</style>
