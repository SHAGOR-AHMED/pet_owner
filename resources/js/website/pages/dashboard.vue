<template>
    <div>
        <div class="converttoimagebtn d-flex justify-content-center mt-2">
            <input class="btn btn-success" type="button" value="Download Certificate" @click="downloadCertificate()"/>&nbsp;
            <a href="/do-logout" class="btn btn-danger text-white">
              Logout
            </a>
        </div>
        <div id="previewImg"></div>
        <div id="html-content-holder" style="width:800px;height:597px;margin:auto;padding:0;">
            <div class="dnacertificate">
                <div class="dcb1">
                    <div class="dcb2">
                        <div class="dcb3">
                            <h1 class="certificatetitle">DNA IDENTIFICATION CERTIFICATE</h1>
                            <p class="text-center">
                                <img src="/all-assets/common/img/biotech.jpg" alt="biotech" style="max-width: 200px;">
                            </p>
                            <div class="profile-col-left">
                                <div class="petpicture">
                                    <img :src="'/images/backend/certificate/small/' + certification.image" alt="Pet">
                                </div>
                                <div class="qr">
                                    <img src="/all-assets/common/img/qr.jpg" alt="QR Tag">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="profile-col-right">
                                <!--<h2 class="animalidno">BICF2G630102146</h2>-->
                                <h3 class="petacareidno">BIOTECH PET QR TAG#: <strong>{{ certification.code }}</strong></h3>
                                <table class="animalprofiledetails">
                                <tr>
                                    <td class="tablefieldtitle">Name:</td>
                                    <td class="tablefieldvalue">{{ certification.name }}</td>
                                </tr>
                                <tr>
                                    <td class="tablefieldtitle">Breed:</td>
                                    <td class="tablefieldvalue">{{ certification.breed }}</td>
                                </tr>
                                <tr>
                                    <td class="tablefieldtitle">Gender:</td>
                                    <td class="tablefieldvalue">{{ (certification.gender == 1) ? 'Male' : 'Female' }}</td>
                                </tr>
                                <tr>
                                    <td class="tablefieldtitle">Color</td>
                                    <td class="tablefieldvalue">{{ certification.color }}</td>
                                </tr>
                                <tr>
                                    <td class="tablefieldtitle">Birth Date:</td>
                                    <td class="tablefieldvalue">{{ certification.dob }}</td>
                                </tr>
                                <tr>
                                    <td class="tablefieldtitle">Owner:</td>
                                    <td class="tablefieldvalue">{{ certification.users.name }}</td>
                                </tr>
                                </table>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                            
                            <table class="colorbararea">
                                <tr>
                                    <td>
                                        <img :src="'/images/backend/certificate/' + certification.image2" alt="ColorBar">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="certificatedisclaimer text-center">Disclaimer: Your pet's complete 200+ DNA genetic marker information can be found in your pet's <a class="link" href="#" @click="viewMarker(certification.owner_id)">profile</a></p>
                                    </td>
                                </tr>
                            </table>
                            <table class="footerareatable">
                                <tr>
                                    <td class="petacarelogoinfooter"><img src="/all-assets/common/img/PetACareCompany.png" alt="PETACARE Logo"></td>
                                    <td class="footerorderdata">
                                        <p><strong>Sample ID:</strong> {{ certification.sample_id }}</p>
                                        <p><strong>Order #:</strong> {{ certification.order_id }}</p>
                                        <p><strong>Report Date:</strong> {{ certification.report_date }}</p>
                                    </td>
                                    <td class="neogenlogoinfooter"><img src="/all-assets/common/img/neogen.jpg" alt="NEOGEN Logo"></td>
                                </tr>
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- view data modal start -->
        <v-dialog v-model="viewDataModal">
            <v-card>
                <v-card-title class="justify-center">
                    <v-row>
                        <v-col cols="10">Marker</v-col>
                        <v-col cols="2">
                            <v-btn
                                @click="viewDataModal = false"
                                color="btn_close lighten-1 white--text"
                                small
                                class="float-right"
                            >
                            <v-icon dark>{{ customIcon.close }}</v-icon>
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-card-title>
                <v-card-text>
                    <div class="marker">
                        <iframe :src="marker.text + '&amp;single=true&amp;widget=true&amp;headers=false'"></iframe>
                    </div>
                </v-card-text>
            </v-card>
        </v-dialog>

    </div>
</template>

<script>
    export default {
        data () {
            return {
                certificate:{},
                ownerID:"",

                viewDataModal:false,
                marker:{},
            }
        },

        methods: {
            getCertificate(id){
                axios.get('/admin/certificate/get_certificate_by_id/' + id).then(response =>{
                    this.certificate = response.data; 
                })
            },

            viewMarker(owner_id){
                axios.get('/admin/marker/get_marker_by_id/' + owner_id).then(response =>{
                    this.marker = response.data; 
                })
                this.viewDataModal = true;
            },

            downloadCertificate(){
                html2canvas(document.getElementById("html-content-holder"),
                    {
                        allowTaint: true,
                        useCORS: true
                    }).then(function (canvas) {
                        var anchorTag = document.createElement("a");
                        document.body.appendChild(anchorTag);
                        document.getElementById("previewImg").appendChild(canvas);
                        anchorTag.download = "certificate.jpg";
                        anchorTag.href = canvas.toDataURL();
                        anchorTag.target = '_blank';
                        anchorTag.click();
                    });
            },
        },

        created(){
            this.$Progress.start();
            this.$Progress.finish();
        }
    }
</script>

<style scoped>
*{font-family: 'Poppins', sans-serif;}

.dnacertificate{width:100%; max-width:800px; padding:30px;}
.dcb1{border:3px solid #3f3f3f; padding:4px;}
.dcb2{border:8px solid #040404; padding:5px;}
.dcb3{border:4px solid #4a4a4a; padding:20px 20px 5px;}
.certificatetitle{text-align:center;font-size:38px; margin-top:0;margin-bottom: 15px;font-weight:700;}
.profile-col-left{width:40%; float:left;}
.profile-col-right{width:60%; float:right;}
.clearfix{clear:both;}
.petpicture{width:205px; height:205px; border:6px solid #1a8907;border-radius:50%;overflow: hidden;}
.petpicture img{width:100%; height:100%;object-fit:cover;}
.qr{width:78px;height:78px;border:4px solid #010300;margin-left: 165px;margin-top: -72px; position:relative;}
.qr img{width:100%;}
.animalidno{margin:0;font-size: 30px;font-weight: 700;}
.petacareidno{font-weight:500;margin: 4px 0 10px;font-size: 21px;}

table{
  border-collapse: collapse;
  width: 100%;
}

.animalprofiledetails tr:nth-child(even) {
  background-color: #ddd;
}
.tablefieldtitle{/*width:120px;*/font-weight:500;}
.dnatestedornot{font-weight:500;}
.dnatestedvalue{padding-left:3px;}
.tablefieldvalue{font-weight:300;}
.animalprofiledetails td{padding: 3px 5px;}

.colorbararea{margin-top:30px; }
.certificatedisclaimer{font-size: 10px;}
.certificatedisclaimer .link{text-decoration: none;color:#ea123b;}
.colorbararea img{width:100%;}
.colorbararea td,
.colorbararea th{border:0;border-spacing:0;}
.colorbararea th{font-size:10px; font-weight:400;text-align:center;}

.colorvaluea{width:100%; height:10px;background:#ffff00;display: block;border-bottom:1px solid #fff;}
.colorvaluec{width:100%; height:10px;background:#7030a0;display: block;border-bottom:1px solid #fff;}
.colorvaluet{width:100%; height:10px;background:#ed7d35;display: block;border-bottom:1px solid #fff;}
.colorvalueg{width:100%; height:10px;background:#00b04d;display: block;border-bottom:1px solid #fff;}


.petacarelogoinfooter img{width:200px;}
.footerorderdata p{margin:0;font-size: 11px;font-weight:300;line-height: 15px;}
.footerorderdata p strong{font-weight:500;}
.neogenlogoinfooter{text-align:right;}
.neogenlogoinfooter img{width:130px;}

#previewImg{display:none}

*{font-family: 'Poppins', sans-serif;}
.marker{width:100%; min-width:600px; padding:30px; border: 1px solid #e2e2e2;}
.marker iframe{width: 100%; height: 500px;}

</style>