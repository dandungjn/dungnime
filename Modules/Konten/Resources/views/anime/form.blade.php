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
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>


        <validation-provider rules="required" name="Genre" v-slot="{ errors }">
            <v-combobox
                class="my-4"
                v-model="form_data.genre"
                :items="filterGenre"
                :search-input.sync="search_genre"
                label="Genre"
                name="genre"
                hint="* harus diisi"
                hide-selected
                multiple
                chips
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            >
                <template v-slot:no-data>
                    <v-list-item>
                        <v-list-item-content>
                            <v-list-item-title>
                                No results matching "<strong>@{{ search_genre }}</strong>". Press <kbd>enter</kbd> to create a new one
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </template>
            </v-combobox>
        </validation-provider>


        <validation-provider rules="required" name="Description" v-slot="{ errors }">
            <v-textarea
                class="my-4"
                rows="3"
                v-model="form_data.description"
                label="Description"
                name="description"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-textarea>
        </validation-provider>


        <validation-provider v-slot="{ errors }" name="Thumbnail" rules="image">
            <v-file-input
                accept="image/*"
                prepend-icon="mdi-camera"
                hint="Hanya menerima file gambar"
                :persistent-hint="true"
                clear-icon="mdi-eraser-variant"
                show-size
                chips
                label="Thumbnail"
                name="thumbnail"
            ></v-file-input>
            <v-row class="mb-3">
                <v-col
                    v-if="form_data.url_thumbnail"
                    cols="12"
                    md="3"
                >
                    <a :href="form_data.url_thumbnail" target="_blank">
                        <v-card
                            class="mx-auto"
                            min-height="150"
                            max-height="150"
                            max-width="250"
                            tile
                        >
                            <v-img
                                max-height="150"
                                max-width="250"
                                :src="form_data.url_thumbnail"
                            ></v-img>
                        </v-card>
                        
                    </a>
                </v-col>
            </v-row>
        </validation-provider>

         <validation-provider v-slot="{ errors }" name="Banner" rules="image">
            <v-file-input
                accept="image/*"
                prepend-icon="mdi-camera"
                hint="Hanya menerima file gambar"
                :persistent-hint="true"
                clear-icon="mdi-eraser-variant"
                show-size
                chips
                label="Banner"
                name="banner"
            ></v-file-input>
            <v-row class="mb-3">
                <v-col
                    v-if="form_data.url_banner"
                    cols="12"
                    md="3"
                >
                    <a :href="form_data.url_banner" target="_blank">
                        <v-card
                            class="mx-auto"
                            min-height="150"
                            max-height="150"
                            max-width="250"
                            tile
                        >
                            <v-img
                                max-height="150"
                                max-width="250"
                                :src="form_data.url_banner"
                            ></v-img>
                        </v-card>
                        
                    </a>
                </v-col>
            </v-row>
        </validation-provider>

         <validation-provider rules="required" name="Rating" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.rating"
                label="Rating"
                name="rating"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider rules="required" name="Status Anime" v-slot="{ errors }">
            <v-autocomplete
                class="my-4"
                v-model="form_data.status" 
                :items="['Complete','On Going']"
                label="Status Anime"
                name="status"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-autocomplete>
        </validation-provider>

        <validation-provider rules="required" name="Status Publish" v-slot="{ errors }">
            <v-autocomplete
                class="my-4"
                v-model="form_data.publish" 
                :items="['Publish','Unpublish']"
                label="Status Publish"
                name="publish"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-autocomplete>
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

    

    <v-dialog
        v-model="prompt_delete"
        persistent
        max-width="500px"
    >
        <v-card>
            <v-card-title>
                <span class="headline"></span>
            </v-card-title>
            <v-card-text>
                <v-row
                    align="center"
                    justify="center"
                >
                    <v-icon size="100" color="yellow darken-2">mdi-alert-rhombus</v-icon>
                    <p class="text-md-h6 text-xs-h6 black--text my-5">
                        {{__('Are you sure want to delete this data ?')}}
                    </p>
                </v-row>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn text :disabled="delete_loader" @click="prompt_delete = false">Cancel</v-btn>
                <v-btn
                    class="white--text"
                    elevation="5"
                    color="red"
                    :disabled="delete_loader"
                    :loading="delete_loader"
                    @click="deleteItem()"
                    >
                    <v-icon>mdi-trash-can-outline</v-icon>
                    <span class="hidden-xs-only ml-2">Delete</span>
                    <template v-slot:loader>
                        <span class="custom-loader">
                            <v-icon color="white">mdi-trash-can-outline</v-icon>
                        </span>
                    </template>
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>

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