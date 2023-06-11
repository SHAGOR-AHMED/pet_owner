export default{

    checkedAll(){
        if(this.selectedAll == false){
          this.selected = [];
        }else{
          this.allData.data.forEach(user =>{
            this.selected.push(user.id);
          });
        }
    },
  
    // Bulk Delete
    deleteAll(selected){
        Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              showCancelButton: true,
              confirmButtonColor: '#d33',
              cancelButtonColor: '#3085d6',
              confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
  
              // Send request to the server
              if (result.value) {
                  this.$Progress.start();
                  axios.post(this.currentUrl + '/delete-all', { data:selected }).then(response =>{
                    this.selected = [];
                    this.selectedAll = false;
                    Swal.fire(
                          'Deleted!',
                          response.data.total + ' ' + 'files has been deleted.',
                          'success'
                    );
                      // Refresh Tbl Data with current page
                      this.getResults(this.currentPageNumber);
                      this.$Progress.finish();
  
                  }).catch((data) => {
                      Swal.fire("Failed!", data.message, "warning");
                  });
              }
  
          })
        
    },
  
    // Bulk Status Active
    statusActiveAll(selected) {
  
          Swal.fire({
              title: 'Are you sure?',
              text: 'Are you want to Active all?',
              showCancelButton: true,
              confirmButtonColor: '#d33',
              cancelButtonColor: '#3085d6',
              confirmButtonText: 'Active',
          }).then((result) => {
  
              // Send request to the server
              if (result.value) {
                  this.$Progress.start();
                  axios.post(this.currentUrl + '/bulk-status-active', { data:selected }).then((response) => {
                      this.selected = [];
                      this.selectedAll = false;
                      Swal.fire(
                          'Changed!',
                          response.data.total + ' ' + 'Status has been Changed.',
                          'success'
                      );
                      // Refresh Tbl Data with current page
                      this.getResults(this.currentPageNumber);
                      this.$Progress.finish();
  
                  }).catch((data) => {
                      Swal.fire("Failed!", data.message, "warning");
                  });
              }
          })
    },
  
    // Bulk Status Deactive
    statusDeactiveAll(selected) {
  
        Swal.fire({
              title: 'Are you sure?',
              text: 'Are you want to Deactive all?',
              showCancelButton: true,
              confirmButtonColor: '#d33',
              cancelButtonColor: '#3085d6',
              confirmButtonText: 'Active',
        }).then((result) => {
  
            // Send request to the server
            if (result.value) {
                  this.$Progress.start();
                  axios.post(this.currentUrl + '/bulk-status-deactive', { data:selected }).then((response) => {
                      this.selected = [];
                      this.selectedAll = false;
                      Swal.fire(
                          'Changed!',
                          response.data.total + ' ' + 'Status has been Changed.',
                          'success'
                      );
                      // Refresh Tbl Data with current page
                      this.getResults(this.currentPageNumber);
                      this.$Progress.finish();
  
                  }).catch((data) => {
                      Swal.fire("Failed!", data.message, "warning");
                  });
            }
        })
    },

}