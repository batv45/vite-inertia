<script setup lang="ts">
    import flasher from "@flasher/flasher";
    import {usePage } from "@inertiajs/inertia-vue3";
    import notyf from "@flasher/flasher-notyf"
    import {onMounted} from "vue";
    import {FlasherResponse} from "@flasher/flasher";


    const runFlash = () => {
          const flash_messages = usePage().props.value.flash as FlasherResponse
        // @ts-ignore
        if( flash_messages ) {
            // @ts-ignore
            flasher.render(flash_messages)
        }
    }

    onMounted(() => {
        runFlash();
    })


</script>
<template></template>
