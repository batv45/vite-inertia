<script setup lang="ts">
import AppHeader from "@/views/components/layout/header.vue"
import AppFooter from "@/views/components/layout/footer.vue"
import { Head } from '@inertiajs/inertia-vue3'
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
    <div class="page">
        <AppHeader :containerType="containerType"/>
        <div class="page-wrapper">
            <!-- Page body -->
            <div class="page-body">
                <div :class="'container-'+containerType">
                    <slot/>
                </div>
            </div>
<!--            <AppFooter/>-->
        </div>
    </div>
</template>
