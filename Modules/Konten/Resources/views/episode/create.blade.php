@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<episode-form
	    				inline-template
	    				action-form="{{ route('anime.episode.store', [$anime->slug]) }}"
	    				redirect-uri="{{ route('anime.episode.index', [$anime->slug]) }}">
		    			@include('konten::episode.form')
		    		</episode-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
