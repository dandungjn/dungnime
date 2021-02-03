<v-card
	flat>
	<v-row>
		<v-col
	    	:cols="$vuetify.breakpoint.mobile ? '6' : '4'"
	    	>
	    	<v-text-field
		    	v-model="search"
	            :label="searchText"
	            :prepend-inner-icon="searchIcon"
	            @keyup="dataHandler()"
	        ></v-text-field>
		</v-col>
		<v-col
	    	:cols="$vuetify.breakpoint.mobile ? '6' : '8'"
	    	align="right">
			<v-btn
				class="ma-2"
			    elevation="5"
			    color="primary"
			    :loading="loading"
			    @click="dataHandler()"
			    >
			    <v-icon>@{{ refreshIcon }}</v-icon>
			    <span class="hidden-xs-only ml-2">@{{ refreshText }}</span>
			    <template v-slot:loader>
		            <span class="custom-loader">
		              	<v-icon color="white">@{{ refreshIcon }}</v-icon>
		            </span>
		        </template>
		    </v-btn>
		    @if (\Auth::user()->is_admin || in_array(str_replace('index', 'create', Route::currentRouteName()), \Auth::user()->grup_user ? \Auth::user()->grup_user->hak_akses : []))
		    	<v-btn
					v-if="addNewUri"
					:href="addNewUri"
					class="ma-2 white--text"
				    elevation="5"
				    :color="addNewColor"
				    >
				    <v-icon>@{{ addNewIcon }}</v-icon>
				    <span class="hidden-xs-only ml-2">@{{ addNewText }}</span>
			    </v-btn>
			@endif
			@if (\Auth::user()->is_admin || in_array(str_replace('index', 'create', Route::currentRouteName()), \Auth::user()->grup_user ? \Auth::user()->grup_user->hak_akses : []))
			    <v-btn
					v-if="customButtonUri"
					:href="customButtonUri"
					class="ma-2 white--text"
				    elevation="5"
				    :color="customButtonColor"
				    >
				    <v-icon>@{{ customButtonIcon }}</v-icon>
				    <span class="hidden-xs-only ml-2">@{{ customButtonText }}</span>
			    </v-btn>
		    @endif
		</v-col>
	</v-row>

	<v-data-table
		:headers="table_headers"
		:items="table_items"
		:options.sync="options"
		:server-items-length="total_data"
		:loading="loading"
	    :footer-props="{
			showFirstLastPage: true,
			firstIcon: 'mdi-chevron-double-left',
			lastIcon: 'mdi-chevron-double-right',
			prevIcon: 'mdi-chevron-left',
			nextIcon: 'mdi-chevron-right',
			itemsPerPageAllText: itemsPerPageAllText,
			itemsPerPageText: itemsPerPageText,
			pageText: pageTextLocale == 'en' ? 'Showing ' + from_data + ' - ' + to_data + ' from ' + total_data + ' data' : 'Menampilkan ' + from_data + ' - ' + to_data + ' dari total ' + total_data + ' data'
	    }"
    >
		@foreach ($table_headers as $element)
			<template v-slot:header.{{$element['value']}}="{ header }">
			    <strong>@{{ header.text.toUpperCase() }}</strong>
			</template>
		@endforeach
		<template v-slot:header.table_index="{ header }">
		    <strong>@{{ header.text.toUpperCase() }}</strong>
		</template>
		<template v-slot:header.actions="{ header }">
		    <strong>@{{ header.text.toUpperCase() }}</strong>
		</template>
		<template v-slot:no-data>
		    @{{ noDataText }}
		</template>
		<template v-slot:no-results>
		    @{{ noResultsText }}
		</template>
		<template v-slot:item.actions="{ item }">
			@if (\Auth::user()->is_admin || in_array(str_replace('index', 'show', Route::currentRouteName()), \Auth::user()->grup_user ? \Auth::user()->grup_user->hak_akses : []))
				<v-tooltip top :color="detailColor">
				    <template v-slot:activator="{ on, attrs }">
			    		<v-btn 
				    		v-if="detailUri" 
				    		icon 
				    		:color="detailColor" 
				    		v-bind="attrs" 
				    		v-on="on" 
				    		:href="ziggy(detailUri, [item[detailUriParameter]]).url()"
			    		>
							<v-icon small>@{{ detailIcon }}</v-icon>
			            </v-btn>
				    </template>
				    <span>@{{ detailText }}</span>
				</v-tooltip>
			@endif

			@if (\Auth::user()->is_admin || in_array(str_replace('index', 'edit', Route::currentRouteName()), \Auth::user()->grup_user ? \Auth::user()->grup_user->hak_akses : []))
				<v-tooltip top :color="editColor">
				    <template v-slot:activator="{ on, attrs }">
			    		<v-btn 
				    		v-if="editUri" 
				    		icon 
				    		:color="editColor" 
				    		v-bind="attrs" 
				    		v-on="on" 
				    		:href="ziggy(editUri, [item[editUriParameter]]).url()"
			    		>
							<v-icon small>@{{ editIcon }}</v-icon>
			            </v-btn>
				    </template>
				    <span>@{{ editText }}</span>
				</v-tooltip>
			@endif

			@if (\Auth::user()->is_admin || in_array(str_replace('index', 'destroy', Route::currentRouteName()), \Auth::user()->grup_user ? \Auth::user()->grup_user->hak_akses : []))
				<v-tooltip top :color="deleteColor">
				    <template v-slot:activator="{ on, attrs }">
			    		<v-btn v-if="deleteUri" icon :color="deleteColor" v-bind="attrs" v-on="on" @click.stop="promptDeleteItem(item)">
							<v-icon small>@{{ deleteIcon }}</v-icon>
			            </v-btn>
				    </template>
				    <span>@{{ deleteText }}</span>
				</v-tooltip>
			@endif
		</template>
		<template v-slot:item.table_index="{ item }">
			<strong>@{{ item.table_index }}</strong>
		</template>
		@stack('table_slot')
	</v-data-table>

	<v-dialog
		v-model="prompt_delete"
		persistent
		max-width="550px"
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
					<v-icon size="120" color="yellow darken-2">mdi-alert-rhombus</v-icon>
					<p class="text-md-h6 text-xs-h6 black--text">
						@{{ deleteConfirmationText }}
					</p>
			    </v-row>

			</v-card-text>
			<v-card-actions>
				<v-spacer></v-spacer>
				<v-btn text :disabled="delete_loader" @click="prompt_delete = false">@{{ deleteCancelText }}</v-btn>
	    		<v-btn
	    			class="white--text"
	    		    elevation="5"
	    		    color="red"
	    		    :disabled="delete_loader"
	    		    :loading="delete_loader"
	    		    @click="deleteItem()"
	    		    >
	    		    <v-icon>@{{ deleteIcon }}</v-icon>
	    		    <span class="hidden-xs-only ml-2">@{{ deleteText }}</span>
	    		    <template v-slot:loader>
			            <span class="custom-loader">
			              	<v-icon color="white">@{{ deleteIcon }}</v-icon>
			            </span>
			        </template>
			    </v-btn>
	        </v-card-actions>
		</v-card>
	</v-dialog>

	<v-snackbar
	    v-model="table_alert"
	    top
	    multi-line
	    :color="table_alert_state"
	    elevation="5"
	    timeout="6000"
	>
		@{{ table_alert_text }}

	    <template v-slot:action="{ attrs }">
	        <v-btn
	          	icon
	          	v-bind="attrs"
	          	@click="table_alert = false"
	        >
	          	<v-icon>mdi-close</v-icon>
	        </v-btn>
	    </template>
	</v-snackbar>
</v-card>