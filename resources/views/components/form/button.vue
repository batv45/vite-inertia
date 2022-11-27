<template>
    <button type="button"
            class="btn"
            :class="['btn-'+variant,{'btn-loading disabled': loading}]"><slot/></button>
</template>

<script setup>
defineProps({
    variant:{
        type: String,
        default: 'primary'
    },
    loading: {
        type: Boolean,
        default: false
    }
})
</script>
