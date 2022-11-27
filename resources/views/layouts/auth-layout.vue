<script setup>
import {Head, InertiaApp} from '@inertiajs/inertia-vue3'
import AppLogo from "@/views/components/app-logo.vue";
import FlashMessages from "@/views/components/flash-messages.vue";


defineProps({
    containerType:{
        type: String,
        default: () => 'xl'
    },
    title:String
})

</script>

<template>
    <Head v-if="title" :title="title">
        <title v-if="title">{{title}}</title>
        <slot name="head" />
    </Head>
    <flash-messages></flash-messages>
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <app-logo size="medium"/>
            </div>
            <slot/>
        </div>
    </div>
</template>
