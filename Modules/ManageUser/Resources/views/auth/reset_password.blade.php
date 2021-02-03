@extends('core::layouts.auth')

@section('content')
    <img
        src="{{url('storage/app/public/img/logofkui.png')}}"
        alt="Logo FKUI"
    >
    <h2 class="font-weight-bold mt-4 blue-grey--text text--darken-2">Atur Ulang Password</h2>
    <reset-password-form
        inline-template
        token="{{ $token }}"
        action-form="{{ route('password.update') }}"
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

                <validation-provider rules="required|min:8" vid="password_confirmation" name="Password" v-slot="{ errors }">
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

                <validation-provider rules="required|confirmed:password_confirmation" name="Konfirmasi Password" v-slot="{ errors }">
                    <v-text-field
                        class="my-4"
                        v-model="form_data.password_confirmation"
                        name="password_confirmation"
                        :append-icon="show_password ? 'mdi-eye' : 'mdi-eye-off'"
                        :type="show_password ? 'text' : 'password'"
                        @click:append="show_password = !show_password"
                        label="Konfirmasi Password"
                        clearable
                        clear-icon="mdi-eraser-variant"
                        hint="* harus diisi"
                        :persistent-hint="true"
                        :error-messages="errors"
                        :disabled="field_state"
                    ></v-text-field>
                </validation-provider>

                <v-btn
                    class="mr-4"
                    light
                    color="info"
                    block
                    type="submit"
                    @click.prevent="submitForm"
                    :loading="field_state"
                    :disabled="field_state"
                >
                    Atur Ulang Password
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
    </reset-password-form>
@endsection
