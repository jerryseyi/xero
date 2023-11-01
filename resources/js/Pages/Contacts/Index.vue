<script setup>
import XeroHeader from "@/Components/XeroHeader.vue";
import {Link, useForm} from "@inertiajs/vue3";

defineProps(['contacts'])

const form = useForm({
   contactID: null
});
const draft = (id) => {
  form.contactID = id;

  form.post(route('invoices.draft'), {

  })
}

const recurring = (id) => {
    form.contactID = id;

    form.post(route('recurring.draft'), {

    })
}
</script>

<template>
    <xero-header></xero-header>

    <div class="">
        <div class="flex items-center mt-10 space-x-8">
            <span class="bg-blue-900 text-white px-3 py-2 rounded-lg"><Link :href="route('contact.create')">Create Contact</Link></span>
            <span class="bg-blue-900 text-white px-3 py-2 rounded-lg"><Link>List Contacts</Link></span>
        </div>
    </div>

    <div class="mt-16"></div>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Address
                </th>
                <th scope="col" class="px-6 py-3">
                    Phone
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Actions
                </th>
            </tr>
            </thead>
            <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" v-for="contact in contacts" :key="contact.id">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ contact.Name }}
                </th>
                <td class="px-6 py-4">
                    {{ contact.Addresses[0].AddressLine1}}
                </td>
                <td class="px-6 py-4">
                    {{ contact.Phones[1].PhoneNumber}}
                </td>
                <td class="px-6 py-4">
                    {{ contact.EmailAddress }}
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center space-x-8">
                        <a class="bg-blue-900 text-white px-3 py-2 rounded-lg cursor-pointer" href="#" @click.prevent="draft(contact.ContactID)">Draft Invoice</a>
                        <a class="bg-blue-900 text-white px-3 py-2 rounded-lg cursor-pointer" href="#" @click.prevent="recurring(contact.ContactID)">Recurring Invoice</a>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

</template>

<style scoped>

</style>
