@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<user-form
	    				inline-template
	    				action-form="{{ route('user.store') }}"
	    				redirect-uri="{{ route('user.index') }}"
                        :filter-grup-user='@json($grup_user)'>
		    			@include('manageuser::user.form')
		    		</user-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
