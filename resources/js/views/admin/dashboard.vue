<template>
  <div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Profile</h1>
    </div>


    <!-- Content Row -->

    <div class="row">
      <!-- Area Chart -->
      <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
        
        </div>
      </div>
    </div>
    <!-- row content -->

       <div class="row">
    <div class="col-lg-12">
        <user-profile-card :user="user" />
    </div>
  </div>
  </div>
</template>

<script>
import UserProfileCard from"./UserProfile/ProfileCard.vue";
import { mapGetters } from "vuex";


export default {
  name: "Dashboard",
    components: {
    "user-profile-card": UserProfileCard,
  },
   computed: {
    ...mapGetters(["user"]),
  },
};
</script>
