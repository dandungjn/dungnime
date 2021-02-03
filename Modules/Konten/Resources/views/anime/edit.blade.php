@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<anime-form
	    				inline-template
	    				:filter-genre='@json($genre)'
                        action-form="{{ route('anime.update', [ $data->slug ]) }}"
	    				redirect-uri="{{ route('anime.index') }}"
	    				data-uri="{{ route('anime.data', [ $data->slug ]) }}">
		    			@include('konten::anime.form')
		    		</anime-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
