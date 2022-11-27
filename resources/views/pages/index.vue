<script setup>
    import AppLayout from "@/views/layouts/app-layout.vue"
    import PageHeader from "@/views/components/layout/page-header.vue";
    import notyf from "@flasher/flasher-notyf";

    if( route().params.verified ){
        notyf.success('Hesabınız doğrulandı.')
    }
    const props = defineProps({
        user:{
            type:Object,
        }
    })


</script>

<template>
    <AppLayout title="Ana Sayfa">
        <PageHeader title="Ana Sayfanız"></PageHeader>
        <div class="row">
            <div class="col">
                <pre>{{$page.props.flash}}</pre>
            </div>
        </div>
    </AppLayout>
</template>
