<script type="text/javascript">
	let call

	export default {
	    props: {
	        uri: {
	            type: String,
	            required: true
	        },
	        headers: {
	            type: Array,
	            required: true
	        },
	        noDataText: {
	            type: String,
	            default: "No data found."
	        },
	        noResultsText: {
	            type: String,
	            default: "No data found."
	        },
	        searchText: {
	            type: String,
	            default: "Search"
	        },
	        searchIcon: {
	            type: String,
	            default: "mdi-magnify"
	        },
	        refreshText: {
	            type: String,
	            default: "Reload"
	        },
	        refreshIcon: {
	            type: String,
	            default: "mdi-sync"
	        },
	        customButtonText: {
	            type: String,
	            default: "Custom Button"
	        },
	        customButtonIcon: {
	            type: String,
	            default: "mdi-cloud-upload"
	        },
	        customButtonUri: {
	            type: String,
	            default: ""
	        },
	        customButtonColor: {
	            type: String,
	            default: "warning"
	        },
	        addNewText: {
	            type: String,
	            default: "Add New"
	        },
	        addNewIcon: {
	            type: String,
	            default: "mdi-plus"
	        },
	        addNewUri: {
	            type: String,
	            default: ""
	        },
	        addNewColor: {
	            type: String,
	            default: "info"
	        },
	        itemsPerPageAllText: {
	            type: String,
	            default: "All"
	        },
	        itemsPerPageText: {
	            type: String,
	            default: "Rows per page:"
	        },
	        pageTextLocale: {
	            type: String,
	            default: "en"
	        },
	        detailUri: {
	            type: String,
	            default: ""
	        },
	        detailUriParameter: {
	            type: String,
	            default: ""
	        },
	        detailText: {
	            type: String,
	            default: "Detail"
	        },
	        detailIcon: {
	            type: String,
	            default: "mdi-eye"
	        },
	        detailColor: {
	            type: String,
	            default: "primary"
	        },
	        editUri: {
	            type: String,
	            default: ""
	        },
	        editUriParameter: {
	            type: String,
	            default: ""
	        },
	        editText: {
	            type: String,
	            default: "Edit"
	        },
	        editIcon: {
	            type: String,
	            default: "mdi-pencil"
	        },
	        editColor: {
	            type: String,
	            default: "primary"
	        },
	        deleteUri: {
	            type: String,
	            default: ""
	        },
	        deleteUriParameter: {
	            type: String,
	            default: ""
	        },
	        deleteText: {
	            type: String,
	            default: "Delete"
	        },
	        deleteIcon: {
	            type: String,
	            default: "mdi-trash-can-outline"
	        },
	        deleteColor: {
	            type: String,
	            default: "red lighten-1"
	        },
	        deleteConfirmationText: {
	            type: String,
	            default: "Are you sure want to delete this data ?"
	        },
	        deleteCancelText: {
	            type: String,
	            default: "Cancel"
	        },
	        tableNumber: {
	        	type: Boolean,
	        	default: function() {
	        		return false
	        	}
	        },
	        withActions: {
	        	type: Boolean,
	        	default: function() {
	        		return false
	        	}
	        }
	    },
	    data () {
	        return {
	            prompt_delete: false,
	            search: '',
	            total_data: 0,
	            from_data: 0,
	            to_data: 0,
	            table_headers: [],
	            table_items: [],
	            loading: true,
	            options: {},
	            selected: null,
	            delete_loader: false,
	            table_alert: false,
	            table_alert_text: '',
	            table_alert_state: 'info',
	        }
	    },
	    watch: {
	        options: {
	            handler () {
	                this.dataHandler()
	            },
	            deep: true,
	        },
	    },
	    mounted () {
	        this.dataHandler()
	    },
	    computed:{
	        query() {
	            return '?page=' + this.options.page + '&search=' + this.search + '&paginate=' + this.options.itemsPerPage
	        }
	    },
	    methods: {
	        dataHandler() {
	        	if (this.tableNumber) {
	        		let table_index = [{
	        		    		            "text": '#',
	        		    		            "align": 'center',
	        		    		            "sortable": false,
	        		    		            "value": 'table_index',
	        			        		}]
		        	this.table_headers = _.concat(table_index, this.headers)
	        	} else {
	        		this.table_headers = this.headers
	        	}
	        	if (this.withActions) {
	        		let table_actions = [{
	        		    		            "text": 'Aksi',
	        		    		            "align": 'center',
	        		    		            "sortable": false,
	        		    		            "value": 'actions',
	        			        		}]
		        	this.table_headers = _.concat(this.table_headers, table_actions)
	        	}
	            setTimeout(this.getData(), 2000);
	        },
	        getData() {
	            this.loading = true
	            if (call) {
	                call.cancel();
	            }
	            call = axios.CancelToken.source()
	            axios
	                .get(this.uri + this.query,  {
	                    cancelToken: call.token
	                })
	                .then(response => {
	                    this.setData(response.data.data.data)
	                    this.total_data = response.data.data.total
	                    this.from_data = response.data.data.from
	                    this.to_data = response.data.data.to
	                    this.loading = false;
	                })
	                .catch(error => {
	                    this.loading = false;
	                });
	        },
	        setData(data) {
	            var items = []
	            _.forEach(data, (value, key) => {
	                value.table_index = parseInt(key) + 1
	                items.push(value)
	            });
	            this.table_items = items
	        },
	        promptDeleteItem(item) {
	            this.prompt_delete = true
	            this.selected = item
	        },
	        deleteItem() {
	            this.delete_loader = true
	            axios.delete(this.ziggy(this.deleteUri, [this.selected[this.deleteUriParameter]]).url())
	                .then((response) => {
	                    if (response.data.success) {
	                        this.table_alert = true
	                        this.table_alert_state = 'success'
	                        this.table_alert_text = response.data.message

	                        this.dataHandler()
	                    } else {
	                        this.table_alert = true
	                        this.table_alert_state = 'error'
	                        this.table_alert_text = response.data.message
	                    }
	                    this.delete_loader = false
	                    this.prompt_delete = false
	                })
	                .catch((error) => {
	                    this.table_alert = true
	                    this.table_alert_state = 'error'
	                    this.table_alert_text = 'Oops, something went wrong. Please try again later.'

	                    this.delete_loader = false
	                    this.prompt_delete = false
	                });
	        },
	    },
	}
</script>