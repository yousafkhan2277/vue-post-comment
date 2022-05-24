<template>
  <div>
      <FlashMessage></FlashMessage>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Crearte Tag</h1>
    

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <h4>New Tag</h4>
            </div>
            <div class="card-body">
              <form @submit="formSubmit" enctype="multipart/form-data">
                <div class="form-group">
                  <label class="label">Tag Title: </label>
                  <input
                    type="text"
                    v-model="title"
                    class="form-control"
                    required
                  />
                </div>
                <div class="form-group text-center">
                  <input type="submit" class="btn btn-success" />
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Vue from 'vue';


export default {
  name: "createTags",
   
  data() {
    return {
      title: "",
    };
  },

  methods: {



    async formSubmit(e) {
      e.preventDefault();
      const config = {
        headers: { "content-type": "multipart/form-data" },
      };
      let formData = new FormData();
      formData.append("name", this.title);  
     const response = await axios.post("/tag/store", formData, config);
     if(response.data){
       this.flashMessage.show({
          status: "success",
          title: "Success Message ",
          time: 3000,
          message: "New Tag Add  successfully",
        });
     }
    },
  },
};
</script>
