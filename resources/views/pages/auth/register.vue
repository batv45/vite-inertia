<script setup lang="ts">
import AuthLayout from "@/views/layouts/auth-layout.vue";
import {EyeIcon,EyeOffIcon} from "vue-tabler-icons"
import {ref,computed} from "vue";
import {useForm} from "@inertiajs/inertia-vue3";
import FormInput from "@/views/components/form/input.vue";

const password_show = ref(false)
const form_register = useForm({
    first_name: 'baba',
    last_name: 'ok',
    email: 'asd@asd.com',
    password: '123123',
    password_confirmation: '123123',
})

const register_submit = () => {
    form_register.post(route('register'), {
        onFinish: () => form_register.reset('password', 'password_confirmation'),
    });
};
const password_confirmation_error = computed(() => {
    return form_register.password_confirmation && form_register.password_confirmation !== form_register.password ? 'Şifreniz eşleşmiyor' : undefined
})
</script>

<template>
    <AuthLayout title="Oturum açın">
        <div class="card card-md">
            <div class="card-body">
                <h2 class="h2 text-center mb-4">Yeni hesap oluştur</h2>
                <form @submit.prevent="register_submit" autocomplete="off" novalidate>
                    <div class="mb-3">
                        <FormInput label="Ad" placeholder="Adınız" :error="form_register.errors.first_name" v-model="form_register.first_name"></FormInput>
                    </div>
                    <div class="mb-3">
                        <FormInput label="Soy Ad" placeholder="Soyadınız" :error="form_register.errors.last_name" v-model="form_register.last_name"></FormInput>
                    </div>
                    <div class="mb-3">
                        <FormInput label="E-Posta Adresi" placeholder="adiniz@email.com" :error="form_register.errors.email" v-model="form_register.email"></FormInput>
                    </div>
                    <div class="mb-2">
                        <FormInput label="Şifre" :type="password_show?'text':'password'"  :error="form_register.errors.password" placeholder="Şifreniz" v-model="form_register.password">
                            <template #input-right>
                                <a href="#" class="link-secondary pe-2" :title="password_show?'Şifreyi Gizle':'Şifreyi Göster'" data-bs-toggle="tooltip">
                                    <EyeIcon v-if="!password_show" @click.prevent="password_show = !password_show" size="20" class=""></EyeIcon>
                                    <EyeOffIcon v-else size="20" @click.prevent="password_show = !password_show" class=""></EyeOffIcon>
                                </a>
                            </template>
                        </FormInput>
                    </div>
                    <div class="mb-2">
                        <FormInput label="Tekrar şifre"
                                   :error="password_confirmation_error"
                                   :type="password_show?'text':'password'" placeholder="Tekrar Şifreniz" v-model="form_register.password_confirmation">
                            <template #input-right>
                                <a href="#" class="link-secondary pe-2" :title="password_show?'Şifreyi Gizle':'Şifreyi Göster'" data-bs-toggle="tooltip">
                                    <EyeIcon v-if="!password_show" @click.prevent="password_show = !password_show" size="20" class=""></EyeIcon>
                                    <EyeOffIcon v-else size="20" @click.prevent="password_show = !password_show" class=""></EyeOffIcon>
                                </a>
                            </template>
                        </FormInput>
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">Kayıt Ol</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="text-center text-muted mt-3">
            Zaten bir hesabın var mı? <Link :href="route('login')" tabindex="-1">Oturum Aç</Link>
        </div>
    </AuthLayout>
</template>
