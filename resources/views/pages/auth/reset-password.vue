<script setup>
import AuthLayout from "@/views/layouts/auth-layout.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import FormInput from "@/views/components/form/input.vue";
import {CheckIcon,EyeIcon,EyeOffIcon} from "vue-tabler-icons"
import Alert from "@/views/components/alert.vue";
import {computed, ref, watch} from "vue";
import Button from "@/views/components/form/button.vue";

const props = defineProps({
    page_password_rules: Object
})

const form_password = useForm({
    email: route().params.email,
    token: route().params.token,
    password: '',
    password_confirmation: ''
})

const submit_password = () => {
    form_password.post(route('password.update'), {
        onFinish: () => form_password.reset('password','password_confirmation'),
    });
}

watch(() => form_password.password, (value) => {
    if( value && value.length < props.page_password_rules.length ){
        form_password.setError('password','Şifre en az 6 karakter olmalı.')
    }else{
        form_password.clearErrors('password')
    }
})


const password_show = ref(false)
const password_confirmation_error = computed(() => {
    return form_password.password_confirmation && form_password.password_confirmation !== form_password.password ? 'Şifreniz eşleşmiyor' : undefined
})
</script>

<template>
    <AuthLayout title="Şifre Değiştir">
        <div class="card card-md">
            <div class="card-body">
                <h2 class="h2 text-center mb-3">Şifre Değiştir</h2>
                <Alert type="info">
                    <h4 class="alert-title">Hazır mısın?</h4>
                    <div class="text-muted">Yeni şifrenizi onaylayıp <strong>ışık</strong> hızında değiştirebilirsiniz.</div>
                </Alert>

                <Alert type="danger" icon v-if="form_password.errors.email">{{form_password.errors.email}}</Alert>

                <form @submit.prevent="submit_password" autocomplete="off" novalidate>
                    <div class="mb-2">
                        <FormInput label="Şifre" :type="password_show?'text':'password'"  :error="form_password.errors.password" placeholder="Şifreniz" v-model="form_password.password">
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
                                   :type="password_show?'text':'password'" placeholder="Tekrar Şifreniz" v-model="form_password.password_confirmation">
                            <template #input-right>
                                <a href="#" class="link-secondary pe-2" :title="password_show?'Şifreyi Gizle':'Şifreyi Göster'" data-bs-toggle="tooltip">
                                    <EyeIcon v-if="!password_show" @click.prevent="password_show = !password_show" size="20" class=""></EyeIcon>
                                    <EyeOffIcon v-else size="20" @click.prevent="password_show = !password_show" class=""></EyeOffIcon>
                                </a>
                            </template>
                        </FormInput>
                    </div>
                    <div class="form-footer">
                        <Button type="submit" class="w-100" :disabled="password_confirmation_error !== undefined
                        || !form_password.password_confirmation
                        || form_password.password.length < page_password_rules.length">
                            <CheckIcon class="me-2"/>
                            Gönder
                        </Button>
                    </div>
                </form>
            </div>
        </div>
    </AuthLayout>
</template>
