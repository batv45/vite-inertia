<template>
    <div class="d-flex py-1 align-items-center">
        <Avatar inline class="me-2" :size="avatarSize" :src="user.profile_photo_url" :name="user.full_name"></Avatar>
        <div class="flex-fill lh-sm">
            <div class="font-weight-medium">{{user.full_name}}</div>
            <div class="text-muted">{{user.email}}</div>
        </div>
    </div>
</template>

<script setup lang="ts">
import Avatar from "@/views/components/avatar.vue";
defineProps({
    user: {
        type: Object,
        required: true
    },
    avatarSize: {
        type: Number
    }
})
</script>
