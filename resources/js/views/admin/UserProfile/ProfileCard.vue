<template>
  <div class="card">
    <div class="card-header">
      <h3>Profile Detail</h3>
    </div>
    <div class="card-body">
      <form ref="profile_form">
        


 <div class="form-group">
    <label for="exampleInputEmail1">First Name</label>
     <h3>{{user.first_name}}</h3>
  </div>
   <div class="form-group">
    <label for="exampleInputEmail1">Last  Name</label>
     <h3>{{user.last_name}}</h3>
  </div>
 <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
     <h3>{{user.email}}</h3>
  </div>
      </form>
    </div>
  </div>
</template>
<script>


export default {
  name: "UserProfileCard",



  props: {
    user: Object,
  },

  methods: {
    
  },
};
</script>
