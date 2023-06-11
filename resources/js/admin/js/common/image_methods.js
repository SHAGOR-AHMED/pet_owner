export default {

    // single image Upload
    loadImage: function (event) {

        let file = event;
        let reader = new FileReader();
        console.log('Image upload: ',file, file['size'] )
        if (file['size'] < this.imageMaxSize) {
            reader.onloadend = (file) => {
                console.log('RESULT', reader.result)
                this.form.image = reader.result;
            }
            reader.readAsDataURL(file);
        } else {
            alert('File size can not be bigger than 2 MB')
        }

    },

    // Selected Image Show
    showImageByName(currentFieldName) {

        if (this.form[currentFieldName]) {
            let photo = (this.form[currentFieldName].length > 100) ? this.form[currentFieldName] : this
                .imagePathSm + this.form[currentFieldName];
            return photo;
        }
        return "/all-assets/common/img/no-image.png";
    },


    // image Upload by name
    uploadImageByName: function (event, currentFieldName, acceptType = ['jpg', 'png', 'jpeg']) {
        let file = event;
        let fileExt = file['name'].split('.')[1];
        let matchFound = acceptType.includes(fileExt);
        let allErrors = {}
        let errorsMsgWithKey = {};
        let errMessage;

        if (!matchFound) {
            // join array with comma
            errMessage = 'Accept only ' + acceptType.join(", ") + '.';
            alert('File type not accepted')
        } else if (file['size'] > this.imageMaxSize) {
            // console.log('Image upload: ', file, file['size'])
            errMessage = 'File size can not be bigger than 2 MB';
            alert('File size can not be bigger than 2 MB')
        } else {
            errMessage = null
            let reader = new FileReader();
            reader.onloadend = (file) => {
                // console.log('RESULT', reader.result)
                this.form[currentFieldName] = reader.result;
            }
            reader.readAsDataURL(file);
        }
        errorsMsgWithKey[currentFieldName] = errMessage
        allErrors['errors'] = errorsMsgWithKey
        // Assign in form error section 
        Object.assign(this.form.errors, allErrors);
        //console.log(errorsMsgWithKey[currentFieldName], allErrors['errors'])
    },


    // document Upload by name
    uploadDocByNameWithAccept: function (event, currentFieldName, acceptType = ['jpg', 'png', 'jpeg']) {

        //console.log(event)
        let file = event;
        let fileExt = file['name'].split('.')[1];
        let matchFound = acceptType.includes(fileExt);
        let allErrors = {}
        let errorsMsgWithKey = {};
        let errMessage = "";
        if (!matchFound) {
            // join array with comma
            errMessage = 'Accept only ' + acceptType.join(", ") + '.';
            alert('File type not accepted')
        } else if (file['size'] > this.imageMaxSize) {
            errMessage = 'File size can not be bigger than 2 MB';
            alert('File size can not be bigger than 2 MB')
        } else {
            errMessage = null
            // Assign Fine into form field
            this.form[currentFieldName] = file;
        }
        errorsMsgWithKey[currentFieldName] = errMessage
        allErrors['errors'] = errorsMsgWithKey
        // Assign in form error section 
        Object.assign(this.form.errors, allErrors);
    },

    // Document By Name
    uploadDocumentByName: function (event, currentFieldName) {
        let file = event;
        //let reader = new FileReader();
        console.log('upload: ', currentFieldName, file, file['size'])
        if (file['size'] < this.fileMaxSize) {
            this.form[currentFieldName] = file;
        } else {
            alert('File size can not be bigger than 5 MB')
        }
    },

    // File Upload
    onFileChange(e) {
        let file = e.target.files[0];

        if (file['size'] < this.fileMaxSize) {
            this.form.document = file;
        } else {
            alert('File size can not be bigger than 5 MB')
        }
    },

    // Upload Image
    upload_image(e) {
        let file = e.target.files[0];
        let reader = new FileReader();
        if (file['size'] < this.imageMaxSize) {
            reader.onloadend = (file) => {
                //console.log('RESULT', reader.result)
                this.form.image = reader.result;
            }
            reader.readAsDataURL(file);
        } else {
            alert('File size can not be bigger than 2 MB')
        }
    },

    //For getting Instant Uploaded Photo
    get_image() {
        if (this.form.image) {
            let photo = (this.form.image.length > 100) ? this.form.image : this.imagePathSm + this.form.image;
            return photo;
        }
        return null;
    },

}
