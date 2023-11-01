<script setup>
import {useForm} from "@inertiajs/vue3";
import XeroHeader from "@/Components/XeroHeader.vue";

const form = useForm({
    firstName: null,
    lastName: null,
    name: null,
    addresses: null,
    emailAddresses: null,
    dob: null,
    phones: null
});


const submit = () => {
    form.post(route('contact.store'), {

    });
}
</script>

<template>

    <xero-header></xero-header>

    <div class="flex flex-col items-center justify-center w-full mt-8">

        <div class="max-w-2xl font-thin text-gray-900 text-xs">
            <p class="mb-3">
                This form is for staff members only and is intended for the purpose of setting a new connection for a customer.
            </p>
            <p>
                Completing this form will initiate the order with the customer's LFC, generate a preliminary invoice in xero, and dispatch a
                welcome email to the customer through Gorgias. After the services are successfully connected, the preliminary invoice will need to be manually sent.
            </p>
        </div>

        <form class="mt-10" @submit.prevent="submit">
            <div class="flex items-center">
                <div class="w-1/3">
                    <label for="" class="mr-3 text-gray-600 opacity-50">Customers Name</label>
                </div>
                <div class="flex w-2/3">
                    <input type="text" class="w-1/2 border-2 border-gray-300 px-3 py-2 mr-2 rounded-md outline-0" v-model="form.firstName" placeholder="First">
                    <input type="text" class="w-1/2 border-2 border-gray-300 px-3 py-2 rounded-md outline-0" v-model="form.lastName" placeholder="Last">
                </div>
            </div>
            <div class="flex items-center mt-3">
                <div class="w-1/3">
                    <label for="" class="mr-3 text-gray-600 opacity-50">Name</label>
                </div>
                <div class="flex w-2/3">
                    <input type="text" class="w-full border-2 border-gray-300 px-3 py-2 mr-3 rounded-md outline-0" v-model="form.name" placeholder="John Doe">
                </div>
            </div>
            <div class="flex items-center mt-3">
                <div class="w-1/3">
                    <label for="" class="mr-3 text-gray-600 opacity-50">Address</label>
                </div>
                <div class="flex w-2/3">
                    <input type="text" class="w-full border-2 border-gray-300 px-3 py-2 mr-3 rounded-md outline-0" v-model="form.addresses" placeholder="Search For Address">
                </div>
            </div>
            <div class="flex items-center mt-3">
                <div class="w-1/3">
                    <label for="" class="mr-3 text-gray-600 opacity-50">Email Address</label>
                </div>
                <div class="flex w-2/3">
                    <input type="email" class="w-full border-2 border-gray-300 px-3 py-2 mr-3 rounded-md outline-0" v-model="form.emailAddresses" placeholder="j.smith@extra.co.nz">
                </div>
            </div>
            <div class="flex items-center mt-3">
                <div class="w-1/3">
                    <label for="" class="mr-3 text-gray-600 opacity-50">Date of Birth</label>
                </div>
                <div class="flex w-2/3">
                    <input type="text" class="w-1/2 border-2 border-gray-300 px-3 py-2 mr-3 rounded-md outline-0" v-model="form.dob" placeholder="">
                </div>
            </div>
            <div class="flex items-center mt-3">
                <div class="w-1/3">
                    <label for="" class="mr-3 text-gray-600 opacity-50">Phone Number</label>
                </div>
                <div class="flex w-2/3">
                    <input type="text" class="w-1/2 border-2 border-gray-300 px-3 py-2 mr-3 rounded-md outline-0" v-model="form.phones" placeholder="027 070 7000">
                </div>
            </div>
            <!--      <div class="flex items-center mt-3">-->
            <!--        <div class="w-1/3">-->
            <!--          <label for="" class="mr-3 text-gray-600 opacity-50">CONNECTION DATE</label>-->
            <!--        </div>-->

            <!--        <div class="flex flex-col w-2/3">-->
            <!--          <input type="date" class="w-1/2 border-2 border-gray-300 px-3 py-2 mr-3 rounded-md outline-0" v-model="form.connection_date" placeholder="DD/MM/YYYY">-->
            <!--          <span class="text-xs"><i></i>Date must be today or in the future</span>-->
            <!--        </div>-->
            <!--      </div>-->
            <!--      <div class="flex items-center mt-3">-->
            <!--        <div class="w-1/3">-->
            <!--          <label for="" class="mr-3 text-gray-600 opacity-50">CIRCUIT ID</label>-->
            <!--        </div>-->

            <!--        <div class="flex flex-col w-2/3">-->
            <!--          <input type="text" class="w-1/2 border-2 border-gray-300 px-3 py-2 mr-3 rounded-md outline-0" v-model="form.circuit_id" placeholder="ENVIBB02173243">-->
            <!--        </div>-->
            <!--      </div>-->
            <div class="flex items-center mt-8">
                <div class="w-1/3">
                    <button type="submit" class="w-1/2 bg-blue-900 text-white px-3 py-2 mr-3 rounded-md outline-0" >Create</button>
                </div>

            </div>
        </form>
    </div>
</template>

<style scoped>

</style>
