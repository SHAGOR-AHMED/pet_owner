export default {

    // Get table data
    getResults(page = 1) {
        this.dataLoading = true;
        return axios.get(this.currentUrl+'/index?page=', {
            params: {
                page:page,
                paginate: this.paginate,
                search: this.search,
                sort_direction: this.sort_direction,
                sort_field: this.sort_field,
                search_field: this.search_field,
                sort_direction_custom: this.sort_direction_custom,
                sort_field_custom: this.sort_field_custom
            }
        }).then(response => {
            //console.log(response.data.data);
            //console.log(response.data.from, response.data.to, response.data.current_page);
            this.allData = response.data;
            this.totalValue = response.data.total;
            this.dataShowFrom = response.data.from;
            this.dataShowTo = response.data.to;
            this.currentPageNumber  = response.data.current_page
            this.v_total = response.data.last_page;
            // Loading Animation
            this.dataLoading = false;

        });
    },

    // DataTable Shorting by field name
    change_sort(field) {
        this.$Progress.start();
        if (this.sort_field == field) {
            this.sort_direction = this.sort_direction == "asc" ? "desc" : "asc";
        } else {
            this.sort_field = field;
        }
        this.getResults();
        this.$Progress.finish();
    },

    // customValeSet
    customValeSet(fieldName, fieldVal) {
        if (fieldName == "paginate") {
          this.paginate = fieldVal;
        } else if (fieldName == "search") {
          this.search = fieldVal;
        } else {
          console.log("Child Component Filed Name Not Set");
        }
        // console.log(fieldName, fieldVal);
    }

    
}