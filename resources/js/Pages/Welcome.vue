<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import XeroHeader from "@/Components/XeroHeader.vue";

defineProps(['error', 'connected', 'organizationName', 'username']);

</script>

<template>
    <Head title="Welcome" />

    <xero-header></xero-header>

    <div v-if="error">
        <h1>Your connection to xero failed.</h1>
        <p class="text-xs text-red-600">{{ error }}</p>
        <a :href="route('xero.auth.authorize')" class="bg-amber-600 px-3 py-2 rounded-md text-white">Reconnect to xero.</a>
    </div>
    <div v-if="! connected" class="mt-5 px-3">You are presently not connected to xero api. <span>
        <a :href="route('xero.auth.authorize')" class="bg-amber-600 px-3 py-2 rounded-md text-white">Click to connect to xero.</a>
    </span></div>
    <div v-else class="mt-5 px-3">
        {{ organizationName }} via {{ username }}

        <div class="flex items-center mt-10 space-x-8">
            <span class="bg-blue-900 text-white px-3 py-2 rounded-lg"><Link :href="route('contact.create')">Create Contact</Link></span>
            <span class="bg-blue-900 text-white px-3 py-2 rounded-lg"><Link :href="route('contact.index')">List Contacts</Link></span>
        </div>

    </div>

</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
