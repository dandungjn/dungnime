<validation-observer v-slot="{ validate, reset }" ref="observer">
    <form method="post" enctype="multipart/form-data" ref="post-form">
        <validation-provider rules="required" name="Nama Grup User" v-slot="{ errors }">
            <v-text-field
            	class="my-4"
                v-model="form_data.nama"
                label="Nama Grup User"
    			name="nama"
    			clearable
    			clear-icon="mdi-eraser-variant"
	    		hint="* harus diisi"
	    		:persistent-hint="true"
	    		:error-messages="errors"
	    		:disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <v-textarea
            class="my-4"
            v-model="form_data.deskripsi"
            name="deskripsi"
            label="Deskripsi"
            auto-grow
            clearable
            rows="3"
            clear-icon="mdi-eraser-variant"
            :disabled="field_state">
        </v-textarea>

        <p>Hak Akses</p>
        <div
            v-for="(element, index) in accessUri"
            :key="index"
            class="pl-3 mt-6"
        >
            <p class="mb-0"><strong>@{{ index }}</strong></p>
            
            <v-checkbox
                v-for="akses in element"
                v-model="form_data.hak_akses"
                name="hak_akses[]"
                :label="akses.deskripsi"
                :value="akses.name"
                hide-details
                class="mt-2"
                :disabled="field_state"
            ></v-checkbox>
        </div>

        <v-btn
        	class="my-6 mr-4"
          	:loading="field_state"
          	:disabled="field_state"
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
            class="my-6"
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