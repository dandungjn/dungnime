@extends('core::layouts.auth')

@section('content')
    <div align="center">
    <img
        src="{{url('storage/app/public/img/logoproex.png')}}"
        alt="Logo FKUI"
    >
    <h2 class="font-weight-bold mt-4 blue-grey--text text--darken-2">Masuk Dengan Akun Anda</h2>
    </div>
    <login-form
        inline-template
        action-form="{{ route('post-login') }}"
    >
        <validation-observer v-slot="{ validate, reset }" ref="observer">
            <form method="post" enctype="multipart/form-data" ref="post-form">
                <validation-provider rules="required|email" name="Alamat Email" v-slot="{ errors }">
                    <v-text-field
                        class="my-4"
                        v-model="form_data.email"
                        label="Alamat Email"
                        name="email"
                        clearable
                        clear-icon="mdi-eraser-variant"
                        hint="* harus diisi"
                        :persistent-hint="true"
                        :error-messages="errors"
                        :disabled="field_state"
                    ></v-text-field>
                </validation-provider>

                <validation-provider rules="required" name="Password" v-slot="{ errors }">
                    <v-text-field
                        class="my-4"
                        v-model="form_data.password"
                        name="password"
                        :append-icon="show_password ? 'mdi-eye' : 'mdi-eye-off'"
                        :type="show_password ? 'text' : 'password'"
                        @click:append="show_password = !show_password"
                        label="Password"
                        clearable
                        clear-icon="mdi-eraser-variant"
                        hint="* harus diisi"
                        :persistent-hint="true"
                        :error-messages="errors"
                        :disabled="field_state"
                    ></v-text-field>
                </validation-provider>

                <div class="d-block d-sm-flex align-center mb-4 mb-sm-0">
                    <v-checkbox
                        v-model="form_data.selected"
                        label="Ingat Saya?"
                        name="remember"
                        :disabled="field_state"
                    ></v-checkbox>
                    <div class="ml-auto">
                        <a href="{{ route('password.request') }}" class="link">Lupa Password?</a>
                    </div>
                </div>

                <v-btn
                    class="mr-4- white--text"
                    light
                    color="#a31c15"
                    block
                    type="submit"
                    @click.prevent="submitForm"
                    :loading="field_state"
                    :disabled="field_state"
                >
                    Masuk
                    <template v-slot:loader>
                        <span class="custom-loader">
                            <v-icon light>mdi-cached</v-icon>
                        </span>
                    </template>
                </v-btn>

                <v-snackbar
                    v-model="form_alert_state"
                    top
                    multi-line
                    :color="form_alert_color"
                    elevation="5"
                    timeout="6000"
                >
                    @{{ form_alert_text }}
                </v-snackbar>
            </form>
        </validation-observer>
    </login-form>
@endsection
