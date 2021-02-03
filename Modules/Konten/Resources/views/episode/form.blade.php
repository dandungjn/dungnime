<validation-observer v-slot="{ validate, reset }" ref="observer">
    <form method="post" enctype="multipart/form-data" ref="post-form">
        <validation-provider rules="required" name="Title" v-slot="{ errors }">
            <v-text-field
            	class="my-4"
                v-model="form_data.title"
                label="Title"
    			name="title"
    			clearable
    			clear-icon="mdi-eraser-variant"
	    		hint="* {{__('required')}}"
	    		:persistent-hint="true"
	    		:error-messages="errors"
	    		:disabled="field_state"
            ></v-text-field>
        </validation-provider>

         <validation-provider rules="required" name="Link Video" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.link_video"
                label="Link Video"
                name="link_video"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* {{__('required')}}"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>
       
      
        <v-btn
        	class="mr-4"
          	:loading="field_state"
          	:disabled="field_state"
            color="primary"
            @click="submitForm"
        >
            {{__('save')}}
            <template v-slot:loader>
                <span class="custom-loader">
                  	<v-icon light>mdi-cached</v-icon>
                </span>
            </template>
        </v-btn>
        <v-btn
	        type="button"
	        @click="clearForm"
	        :disabled="field_state"
	    >
            {{__('clear')}}
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