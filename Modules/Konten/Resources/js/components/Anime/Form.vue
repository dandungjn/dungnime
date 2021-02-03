<script type="text/javascript">
	import { ValidationObserver, ValidationProvider, extend, localize } from 'vee-validate';
	import { required, min, max, image } from 'vee-validate/dist/rules'
	import id from 'vee-validate/dist/locale/id.json'

	extend('required', required)
	extend('min', min)
	extend('max', max)
	extend('image', image)
    localize('id', id);

	export default {
		components: {
		    ValidationObserver,
		    ValidationProvider
		},
		props: {
			actionForm: {
				type: String,
				required: true
			},
			redirectUri: {
				type: String,
				required: true
			},
			dataUri: {
				type: String,
				default: ''
			},
			deleteUri: {
	            type: String,
	            default: "berita-detail.destroy"
	        },
	        deleteUriParameter: {
	            type: String,
	            default: "slug"
	        },
			filterGenre: {
			    type: Array,
			    default: function () {
			        return []
			    }
			}
		},
		data: () => ({
			search_genre: null,
			menu1: false,
			form_data: {
				title: '',
				genre: '',
				description: '',
				thumbnail: '',
				rating: '',
				publish: '',
				banner: '',
				status: '',
			},
			field_state: false,
			form_alert_state: false,
			form_alert_color: '',
			form_alert_text: '',
			prompt_delete: false,
            delete_loader: false,
		}),
		mounted() {
            this.getFormData();
        },
		methods: {
    		getFormData() {
    			if (this.dataUri) {
    				this.field_state = true

    		        axios
    		            .get(this.dataUri)
    		            .then(response => {
    		            	if (response.data.success) {
    		            		let data = response.data.data
    		            		this.form_data = {
    		            			title: data.title,
    		            			genre: data.genre,
    		            			description: data.description,
    		            			thumbnail: data.thumbnail,
    		            			banner: data.banner,
    		            			publish: data.publish,
    		            			status: data.status,
    		            			rating: data.rating,
    		            			url_thumbnail: data.url_thumbnail,
    		            			url_banner: data.url_banner,

    		            		},

    			                this.field_state = false
    		            	} else {
    		            		this.form_alert_state = true
		    		            this.form_alert_color = 'error'
		    		            this.form_alert_text = response.data.message
			    		        this.field_state = false
    		            	}
    		            })
    		            .catch(error => {
		            		this.form_alert_state = true
	    		            this.form_alert_color = 'error'
	    		            this.form_alert_text = response.data.message
		    		        this.field_state = false
    		            });
    			}
    		},
			clearForm() {
				this.form_data = {
					title: '',
					genre: '',
					description: '',
					thumbnail: '',
					banner: '',
					rating: '',
					publish: '',
					status: '',
				}
				this.$refs.observer.reset()
			},
	    	submitForm() {
				this.$refs.observer.validate().then((success) => {
					if (!success) {
			          	return;
			        }

			        this.field_state = true

			        this.postFormData()
				});
	    	},
		    postFormData() {
	    		const form_data = new FormData(this.$refs['post-form']);
	    		
	    		if (this.dataUri) {
	    		    form_data.append("_method", "put");
	    		}
	    		

	    		axios.post(this.actionForm, form_data)
	    		    .then((response) => {
	    		        if (response.data.success) {
	    		            this.form_alert_state = true
	    		            this.form_alert_color = 'success'
	    		            this.form_alert_text = response.data.message

	    		            setTimeout(() => {
			                    this.goto(this.redirectUri);
			                }, 6000);
	    		        } else {
		    		        this.field_state = false

	    		            this.form_alert_state = true
	    		            this.form_alert_color = 'error'
	    		            this.form_alert_text = response.data.message
	    		        }
	    		    })
	    		    .catch((error) => {
	    		        this.field_state = false
	    		        this.form_alert_state = true
	    		        this.form_alert_color = 'error'
	                    this.form_alert_text = 'Oops, something went wrong. Please try again later.'
	    		    });
		    },
		}
	}
</script>