@extends('core::layouts.master')
@push('table_slot')
<template v-slot:item.banner="{ item }">
    <div align="center">
        <v-img
            class="mt-2 mb-2"
            max-width="100"
            :src="item.banner"
        ></v-img>
    </div>
</template>
@endpush
@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<table-component inline-template
                        table-number
                        with-actions
                        uri="{{ route('episode.table', [$anime->slug]) }}"
                        :headers='@json($table_headers)'
                        no-data-text="{{__('Data Not Found')}}"
                        no-results-text="{{__('Data Not Found')}}"
                        search-text="{{__('Search')}}"
                        refresh-text="{{__('Refresh')}}"
                        items-per-page-all-text="{{__('All')}}"
                        items-per-page-text="{{__('Show')}}"
                        page-text-locale="{{__('en')}}"
                        add-new-uri="{{ route('anime.episode.create', [$anime->slug]) }}"
                        add-new-text="{{__('Add')}}"
                        add-new-color="light-blue lighten-2"
                        edit-uri="episode.edit"
                        edit-uri-parameter="slug"
                        edit-text="{{__('Edit')}}"
                        delete-uri="episode.destroy"
                        delete-uri-parameter="slug"
                        delete-text="{{__('Delete')}}"
                        delete-confirmation-text="{{__('Are you sure you want to delete this data ?')}}"
                        delete-cancel-text="{{__('Cancel')}}"
                       

    					>
    					
    					@include('core::components.table')
    				</table-component>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
