@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<member-form
	    				inline-template
	    				action-form="{{ route('member.store') }}"
	    				redirect-uri="{{ route('member.index') }}">
		    			@include('manageuser::member.form')
		    		</member-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
