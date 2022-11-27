<script setup>
    import AppLayout from "@/views/layouts/app-layout.vue";
    import PageHeader from "@/views/components/layout/page-header.vue";
    import {CheckIcon,CircleCheckIcon, AlertTriangleIcon, MailIcon} from "vue-tabler-icons";
    import Button from "@/views/components/form/button.vue";
    import FormInput from "@/views/components/form/input.vue";
    import {useForm} from "@inertiajs/inertia-vue3";
    import {Inertia} from "@inertiajs/inertia";
    import notyf from "@flasher/flasher-notyf";

    const props = defineProps({
        user: Object
    })

    const form_profile = useForm({
        first_name: props.user.first_name,
        last_name: props.user.last_name,
        email: props.user.email,
        profile_photo:props.user.profile_photo_url
    })

    const form_email = useForm({
        email: props.user.email
    })
    const form_password = useForm({
        current_password: '',
        password: '',
        password_confirmation: ''
    })

    const submit_profile = () => {
        form_profile.put(route('user-profile-information.update'),{
            errorBag:'updateProfileInformation',
            onSuccess: (page) => {
                form_profile.first_name = page.props.user.first_name
                form_profile.last_name = page.props.user.last_name
                form_profile.email = page.props.user.email
            }
        })
    }
    const submit_password = () => {
        form_password.put(route('user-password.update'),{
            preserveScroll: true,
            errorBag:'updatePassword',
            onSuccess: () => {
                form_password.reset()
            }
        })
    }
    const send_email = () => {
        form_email.post(route('verification.send'),{
            onSuccess: () => {
                notyf.success(`${form_email.email} adresine doğrulamak için bir E-Posta gönderildi.` )
            }
        })
    }
</script>

<template>
    <AppLayout title="Hesabım">
        <PageHeader title="Hesabım">
        </PageHeader>
        <div class="row justify-content-center">
            <div class="col-md-8">
<!--                Profile -->
                <form @submit.prevent="submit_profile" class="card">
                    <div class="card-header">
                        <h3 class="card-title">Hesap Bilgileriniz</h3>
                    </div>
                    <div class="card-body">
                        {{user.profile_photo_url}}
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <FormInput label="Ad" v-model="form_profile.first_name" :error="form_profile.errors.first_name" placeholder="Adınız"></FormInput>
                            </div>
                            <div class="col-md-6">
                                <FormInput label="Soyad" v-model="form_profile.last_name" :error="form_profile.errors.last_name" placeholder="Soyadınız"></FormInput>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <FormInput label="E-Posta" v-model="form_profile.email" :error="form_profile.errors.email" placeholder="E-Posta adresiniz (Doğrulama için gerekli)">
                                    <template v-if="!form_profile.errors.email" #input-right>
                                        <circle-check-icon class="text-success me-1" v-if="user.email_verified_at" />
                                        <alert-triangle-icon class="text-warning pe-1" v-else />
                                    </template>
                                </FormInput>
                                <small class="text-warning" v-if="!form_profile.errors.email && !user.email_verified_at">E-Postanızı onaylayınız.</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <Button @click.prevent="send_email" variant="link"
                                :loading="form_email.processing"
                                v-if="!form_profile.errors.email && !user.email_verified_at"
                                class=" me-2"><MailIcon/> Onay E-Postası gönder</Button>
                        <Button type="submit" :loading="form_profile.processing"><CheckIcon/> Kaydet</Button>
                    </div>
                </form>

<!--                Password -->
                <form @submit.prevent="submit_password" class="card mt-3">
                    <div class="card-header">
                        <h3 class="card-title">Şifre Değiştir</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <FormInput type="password" label="Mevcut Şifreniz" v-model="form_password.current_password" :error="form_password.errors.current_password" placeholder="Şuanki hesap şifreniz"></FormInput>
                        </div>
                        <div class="mb-3">
                            <FormInput type="password" label="Yeni Şifreniz" v-model="form_password.password" :error="form_password.errors.password" placeholder="Yeni hesap şifreniz"></FormInput>
                        </div>
                        <div class="mb-3">
                            <FormInput type="password" label="Tekrar Yeni Şifreniz" v-model="form_password.password_confirmation" :error="form_password.errors.password_confirmation" placeholder="Yeni hesap şifrenizi doğrulayınız"></FormInput>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <Button type="submit" :loading="form_password.processing"><CheckIcon/> Kaydet</Button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
