@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<table-component inline-template
    					table-number
    					with-actions
    					uri="{{ route('grup-user.table') }}"
    					:headers='@json($table_headers)'
    					no-data-text="Tidak ada data ditemukan."
    					no-results-text="Tidak ada data ditemukan."
    					search-text="Pencarian"
    					refresh-text="Muat Ulang"
    					items-per-page-all-text="Semua"
    					items-per-page-text="Tampilkan"
    					page-text-locale="id"
    					add-new-uri="{{ route('grup-user.create') }}"
    					add-new-text="Tambah"
    					add-new-color="light-blue lighten-2"
    					edit-uri="grup-user.edit"
    					edit-uri-parameter="slug"
    					edit-text="Ubah"
    					delete-uri="grup-user.destroy"
    					delete-uri-parameter="slug"
    					delete-text="Hapus"
    					delete-confirmation-text="Apakah Anda yakin untuk menghapus data ini ?"
    					delete-cancel-text="Batal"
    					>
    					
    					@include('core::components.table')
    				</table-component>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
