@extends('core::layouts.auth')

@section('content')
    <img
        src="{{url('storage/app/public/img/logofkui.png')}}"
        alt="Logo FKUI"
    >
    <h2 class="font-weight-bold mt-4 blue-grey--text text--darken-2">Atur Ulang Password</h2>
    <forgot-password-form
        inline-template
        action-form="{{ route('password.email') }}"
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

                <v-btn
                    class="mr-4 mb-4"
                    light
                    color="info"
                    block
                    type="submit"
                    @click.prevent="submitForm"
                    :loading="field_state"
                    :disabled="field_state"
                >
                    Kirim Link
                    <template v-slot:loader>
                        <span class="custom-loader">
                            <v-icon light>mdi-cached</v-icon>
                        </span>
                    </template>
                </v-btn>

                <div class="d-block align-center mb-sm-0 text-center">
                    <a href="{{ route('login') }}" class="link">Ingat Password?</a>
                </div>

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
    </forgot-password-form>
@endsection
