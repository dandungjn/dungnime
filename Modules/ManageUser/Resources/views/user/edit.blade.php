@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<user-form
	    				inline-template
	    				action-form="{{ route('user.update', [ $data->slug ]) }}"
	    				redirect-uri="{{ route('user.index') }}"
	    				data-uri="{{ route('user.data', [ $data->slug ]) }}"
                        :filter-grup-user='@json($grup_user)'>
		    			@include('manageuser::user.form')
		    		</user-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
