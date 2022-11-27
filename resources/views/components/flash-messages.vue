<script setup lang="ts">
    import flasher from "@flasher/flasher";
    import {usePage } from "@inertiajs/inertia-vue3";
    import notyf from "@flasher/flasher-notyf"
    import {computed, onMounted, onUnmounted, ref, watch} from "vue";
    import {FlasherResponse} from "@flasher/flasher";
    import {Inertia} from "@inertiajs/inertia";

    const flash = computed(() => {
        return usePage().props.value.flash
    })

    watch(flash, (val) => {
        runFlash(val);
    })

    const runFlash = (message:any = null) => {
          const flash_messages = usePage().props.value.flash as FlasherResponse
        // @ts-ignore
        if( flash.value ) {
            // @ts-ignore
            flasher.render(message ?? flash_messages)
        }
    }

    onMounted(() => {
        runFlash();
        // removeStartEventListener = Inertia.on('finish',runFlash)

    })


</script>
<template></template>
