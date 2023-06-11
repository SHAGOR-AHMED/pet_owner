<template>
  <div>
      <v-app-bar app flat dense dark class="nav-color">
            <v-btn text link route small>
              <img src="/all-assets/common/img/PetACareCompany.png" alt="pet care" height="40px"/>
            </v-btn>
            <v-spacer></v-spacer>

          <v-btn text link route :to="{ name: 'Dashboard'}" small exact>
              Dashboard
          </v-btn>

          <v-btn text link route :to="{ name: 'FindPet'}" small >
              Find Pet
          </v-btn>

          <v-btn text link route :to="{ name: 'LostPet'}" small >
              Lost Pet
          </v-btn>

          <v-btn text link route :to="{ name: 'PetPassport'}" small >
              Pet Passport
          </v-btn>

          <v-btn text link route href="/do-logout" small>
              Logout
          </v-btn>
      </v-app-bar>
  </div>
</template>

<style scoped>
  .v-btn--active {
      color: #fff !important;
  }
  
  .theme--dark.v-btn {
	color: #000 !important;
}

  .nav-color {
      background: #fff !important;
  }

  a:hover {
      text-decoration: none;
  }

</style>
