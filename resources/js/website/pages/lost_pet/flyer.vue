<template>
    <div>
      <v-card class="space px-2 mb-10">
        <v-card-text>
          <div class="converttoimagebtn d-flex justify-content-center">
            <input type="button" class="btn btn-success" value="Download" @click="downloadFlyer()"/>&nbsp;
            <a href="/do-logout" class="btn btn-danger text-white">
              Logout
            </a>&nbsp;
            <router-link :to="{ name: 'LostPet'}" class="btn btn-primary text-white">
              Back
            </router-link>
          </div>
          <div id="previewImg3"></div>
            <div id="lost_flyer" style="width:720px;height:784px;margin:auto;padding-top:10px; padding-left:10px; position:relative;display:block;">
              <div class="flyerdesigner">
                  <div class="flyerheader">
                      <h1 class="flyertitle">Missing Dog</h1>
                  </div>
                  <div class="flyerbody">
                      <div class="flyerpetphoto">
                          <img :src="imagePathSm + detailsData.image" alt="Missing Pet">
                      </div>
                      <div class="flyerpetdetails">
                          <h2 class="flyerpetname">{{ detailsData.name }}</h2>
                          <p><span class="flyerdtitle">Sex: </span> {{ (detailsData.gender == 1) ? 'Male' : 'Female' }}</p>
                          <p><span class="flyerdtitle">Color: </span> {{ detailsData.color }}</p>
                          <p><span class="flyerdtitle">Weight: </span> {{ detailsData.weight }} kg</p>
                          <p class="whereitslost"><span class="flyerdtitle">Lost Location: </span> {{ detailsData.lost_location }}</p>
                          <div class="findreward">
                            <h1 class="rewardamount">${{ detailsData.reward }}</h1>
                            <h2 class="rewardtitle">Reward</h2>
                        </div>
                      </div>
                  </div>
                  <div class="flyerfooter">
                      <h3 class="flyerfooternote">{{ detailsData.note }}</h3>
                      <h1 class="flyercontact">{{ detailsData.contact_info }}</h1>
                  </div>
                </div>
            </div>
           
        </v-card-text>
      </v-card>

    </div>
  </template>
  
  <script>
  import axios from "axios";
 
  export default {
      data() {
        return {
          //current url
          currentUrl: "/losting_pet",
          imagePathSm: "/images/backend/pet/small/",

          detailsData:{},
          
        };
      },
  
      methods: {
        getLostFlyer(){
            return axios.get(this.currentUrl + '/flyerById/' + this.$route.params.id).then(response =>{
                this.detailsData = response.data; 
            })
        },

        downloadFlyer(){
          html2canvas(document.getElementById("lost_flyer"),
            {
                allowTaint: true,
                useCORS: true
            }).then(function (canvas) {
                var anchorTag = document.createElement("a");
                document.body.appendChild(anchorTag);
                document.getElementById("previewImg3").appendChild(canvas);
                anchorTag.download = "lost_flyer.jpg";
                anchorTag.href = canvas.toDataURL();
                anchorTag.target = '_blank';
                anchorTag.click();
            });
        },

      },

      async mounted() {
        this.$Progress.start();
        await this.getLostFlyer();
        this.$Progress.finish();
      },
  
      created(){
  
      },
  
  };
  
  </script>

  <style scoped>

*{font-family: 'Poppins', sans-serif;}

    /*Lost Pet Flyer*/
    .flyerdesigner{width:100%; max-width:700px;padding-top:0;}
    .flyerheader{background:#eb2411;padding:10px 0; border-radius:5px;}
    .flyertitle{text-align:center;color:#fff;margin:0;text-transform:uppercase;font-size: 75px; font-weight: bold;}
    .flyerpetphoto{width:60%;float:left;}
    .flyerpetphoto img{width:100%;height:500px;object-fit:cover;border-radius:5px;box-shadow:0 0 10px #333;}
    .flyerpetdetails{width:40%; float:right;}

    .flyerbody{display:flex;padding: 20px 10px 10px;}
    .flyerpetdetails{padding-left:20px;}
    .flyerpetname{font-size:35px; text-transform:uppercase;color:#eb2411;margin:0;font-weight: bold; line-height: 53px;}
    .flyerpetdetails p{margin-bottom:0;font-weight:300;margin-top: 7px;font-size:22px; line-height: 33px;}
    p.whereitslost{height:148px;overflow:hidden;}
    .flyerdtitle{color:#eb2411;font-weight:600;}

    .findreward{background:#000;padding:20px 10px;border-radius: 5px;margin-top: 10px;}
    .rewardamount{text-align:center;color:#fff;font-size:69px;text-transform:uppercase;margin:0;line-height: 63px;font-weight: bold;}
    .rewardtitle{text-align:center;color:#fff;font-size:40px;text-transform:uppercase;margin-bottom:5px;margin-top:20px;line-height: 30px;font-weight: bold;}
    .flyerfooter{background:#9d0e00;padding:10px 0; border-radius:5px;margin:0;}
    .flyerfooternote{font-size:22px;font-weight:300;text-align:center;color:#fff;margin:0;}
    .flyercontact{font-size:92px;text-align:center;color:#fff;margin:0;line-height: 76px; font-weight: bold;}
    .downloadflyer{width:200px; margin-top:30px; margin-left:auto;margin-right:auto; margin-bottom:20px;text-align: center;}
    #previewImg3{display:none}

    /*Lost Pet Flyer*/
    .flyerpetfoundphoto{width:60%;float:left;}
    .flyerpetfoundphoto img{width:100%;height:330px;object-fit:cover;border-radius:5px;box-shadow:0 0 10px #333;}

</style>