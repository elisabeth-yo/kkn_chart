<template>
    <div class="login-box">

        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1"><b>Admin</b>Login</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <div v-if="errorMessage" class="alert alert-danger" role="alert">
                    {{ errorMessage }}
                </div>

                <Form ref="form" @submit="handleSubmit" :validation-schema="loginDataSchema" v-slot="{ errors }" :initial-values="formValues">
                    <div class="input-group mb-3">
                        <Field name="email" type="email" class="form-control" :class="{ 'is-invalid': errors.email }" id="email" aria-describedby="header_sloganHelp" placeholder="Enter email" />                        
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <span class="invalid-feedback">{{ errors.email }}</span>
                    </div>
                    <div class="input-group mb-3">
                        <Field name="password" type="password" class="form-control" :class="{ 'is-invalid': errors.password }" id="password" aria-describedby="header_sloganHelp" placeholder="Enter password" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <span class="invalid-feedback">{{ errors.password }}</span>
                    </div>
                    <div class="row">
                        <div class="col-8">
                        </div>

                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block" :disabled="loading">
                                <div v-if="loading" class="spinner-border spinner-border-sm" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <span v-else>Sign In</span>
                            </button>
                        </div>

                    </div>
                </Form>
            </div>

        </div>
    </div>
</template>

<script setup>
    import { requestPost } from '../../api/api';
    import useAuthStore from '../../stores/auth';
    import { ref } from 'vue';
    import { useRouter } from "vue-router";

    import { Form, Field } from 'vee-validate';
    import * as yup from 'yup';

    const router     = useRouter();
    const authStore  = useAuthStore();
    const formValues = ref({
        email   : null,
        password: null
    });
    const loading      = ref(false);
    const errorMessage = ref(null);

    const loginDataSchema = yup.object({
        email   : yup.string().email().required(),
        password: yup.string().required(),
    });

    const handleSubmit = (values, { resetForm, setErrors }) => {
        errorMessage.value = null;
        loading.value = true;
        requestPost('admin/login', values, false).then(RESPONSE => {
            const token = RESPONSE.token;
            const user  = RESPONSE.user;
            authStore.storeLoggedInUser(token, user);
            router.push({ name: 'admin.dashboard' });
        }).catch(ERROR => {
            errorMessage.value = ERROR.response.data.errors.message[0]
        }).then(() => {
            loading.value = false;
        })
    }
</script>

<style>

</style>