<script setup lang="ts">
import AuthLayout from "@/views/layouts/auth-layout.vue";
import {EyeIcon,EyeOffIcon} from "vue-tabler-icons"
import {ref} from "vue";
import {useForm} from "@inertiajs/inertia-vue3";
import FormInput from "@/views/components/form/input.vue";

const password_show = ref(false)
const form_login = useForm({
    email: null,
    password: null,
    remember: false
})

const login_submit = () => {
    form_login.post(route('login'), {
        onFinish: () => form_login.reset('password'),
    });
};
</script>

<template>
    <AuthLayout title="Oturum açın">
        <div class="card card-md">
            <div class="card-body">
                <h2 class="h2 text-center mb-4">Oturum Açınız</h2>
                <form @submit.prevent="login_submit" autocomplete="off" novalidate>
                    <div class="mb-3">
                        <FormInput
                            label="E-Posta"
                            type="email"
                            tabindex="1"
                            v-model="form_login.email"
                            :error="form_login.errors.email"
                            placeholder="your@email.com" />
                    </div>
                    <div class="mb-2">
                        <FormInput v-model="form_login.password"
                                   tabindex="2"
                                   :type="password_show?'text':'password'"
                                   :error="form_login.errors.password"
                                   placeholder="Şifreniz">
                            <template #input-right>
                                <a href="#" class="link-secondary pe-2" :title="password_show?'Şifreyi Gizle':'Şifreyi Göster'" data-bs-toggle="tooltip">
                                    <EyeIcon v-if="!password_show" @click.prevent="password_show = !password_show" size="20" class=""></EyeIcon>
                                    <EyeOffIcon v-else size="20" @click.prevent="password_show = !password_show" class=""></EyeOffIcon>
                                </a>
                            </template>
                            <template #label>
                                Şifre
                                <span class="form-label-description">
                                <Link :href="route('password.request')">Şifremi Unuttum</Link>
                              </span>
                            </template>
                        </FormInput>
                    </div>
                    <div class="mb-2 pt-2">
                        <label class="form-check">
                            <input type="checkbox"
                                   tabindex="3"
                                   v-model="form_login.remember"
                                   class="form-check-input"/>
                            <span class="form-check-label">Beni hatırla</span>
                        </label>
                    </div>
                    <div class="form-footer">
                        <button tabindex="4" type="submit" class="btn btn-primary w-100">Oturum Aç</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="text-center text-muted mt-3">
            Hesabınız yok mu? <Link :href="route('register')" tabindex="-1">Yeni hesap oluştur</Link>
        </div>
    </AuthLayout>
</template>
