<script setup>
import AuthLayout from "@/views/layouts/auth-layout.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import FormInput from "@/views/components/form/input.vue";
import {MailIcon} from "vue-tabler-icons"

const form_email = useForm({
    email: null
})

const submit_email = () => {
    form_email.post(route('password.email'), {
        onFinish: () => form_email.reset('email'),
    });
}
</script>

<template>
    <AuthLayout title="Şifre Hatırlat">
        <div class="card card-md">
            <div class="card-body">
                <h2 class="h2 text-center mb-4">Şifre hatırlat</h2>
                <form @submit.prevent="submit_email" autocomplete="off" novalidate>
                    <p class="text-muted mb-4">E-Posta adresinizi giriniz, şifrenizi sıfırlamanız için size E-Posta gönderilecek.</p>
                    <div class="mb-3">
                        <FormInput label="E-Posta adresiniz" v-model="form_email.email" :error="form_email.errors.email" placeholder="adiniz@mail.com" />
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">
                            <MailIcon size="20" class="me-2"/>
                            Gönder
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="text-center text-muted mt-3">
            Oturum açma ekranına dönmek için <Link :href="route('login')">tıklayın.</Link>
        </div>
    </AuthLayout>
</template>
