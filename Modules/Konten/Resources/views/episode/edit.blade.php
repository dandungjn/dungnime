@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<episode-form
	    				inline-template
	    				action-form="{{ route('episode.update', [ $data->slug ]) }}"
	    				redirect-uri="{{ route('anime.episode.index', [$anime->slug]) }}"
	    				data-uri="{{ route('episode.data', [ $data->slug ]) }}">
		    			@include('konten::episode.form')
		    		</episode-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection