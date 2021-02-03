<validation-observer v-slot="{ validate, reset }" ref="observer">
    <form method="post" enctype="multipart/form-data" ref="post-form">
        <validation-provider rules="required" name="Nama Lengkap" v-slot="{ errors }">
            <v-text-field
            	class="my-4"
                v-model="form_data.nama"
                label="Nama Lengkap"
    			name="nama"
    			clearable
    			clear-icon="mdi-eraser-variant"
	    		hint="* harus diisi"
	    		:persistent-hint="true"
	    		:error-messages="errors"
	    		:disabled="field_state"
            ></v-text-field>
        </validation-provider>

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

        <validation-provider :rules="{ required: true, max: 15, regex: /^\+\d*$/ }" name="Nomor Handphone" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.telepon"
                label="Nomor Handphone"
                name="telepon"
                clearable
                clear-icon="mdi-eraser-variant"
                v-mask="'+##############'"
                placeholder="+62812411111111"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider v-if="!dataUri" rules="required|min:8" vid="password_confirmation" name="Password" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.password"
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

        <validation-provider v-if="!dataUri" rules="required|confirmed:password_confirmation" name="Konfirmasi Password" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.password_confirmation"
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
        	class="my-4 mr-4"
          	:loading="field_state"
          	:disabled="field_state"
            type="submit"
            color="primary"
            @click="submitForm"
        >
            simpan
            <template v-slot:loader>
                <span class="custom-loader">
                  	<v-icon light>mdi-cached</v-icon>
                </span>
            </template>
        </v-btn>
        <v-btn
            class="my-4"
	        type="button"
	        @click="clearForm"
	        :disabled="field_state"
	    >
            hapus
        </v-btn>
    </form>

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
</validation-observer>