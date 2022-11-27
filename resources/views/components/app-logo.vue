<script setup lang="ts">
import {ref} from "vue";

const props = defineProps({
    size: {
        type: String,
        default: ''
    }
})
</script>

<template>
    <a href="/test">
        <img v-if="size === 'small'" src="@/assets/logo-small.svg" width="110" height="32" alt="Tabler" class="navbar-brand-image">
        <img v-else src="@/assets/logo.svg" width="110" height="32" alt="Tabler" class="navbar-brand-image">
    </a>
</template>
