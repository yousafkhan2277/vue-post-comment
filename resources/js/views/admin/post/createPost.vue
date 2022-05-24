<template>
  <div>
      <FlashMessage></FlashMessage>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Crearte Post</h1>
    

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <h4>New Post</h4>
            </div>
            <div class="card-body">
              <form @submit="formSubmit" enctype="multipart/form-data">
                <div class="form-group">
                  <label class="label">Post Title: </label>
                  <input
                    type="text"
                    v-model="title"
                    class="form-control"
                    required
                  />
                </div>
                <div class="form-group">
                  <label class="label">Post Body: </label>
                  <textarea
                    v-model="body"
                    rows="4"
                    cols="30"
                    class="form-control"
                    required
                  ></textarea>
                </div>
                  <div class="form-group">
                  <label class="label">Add Tag: </label>
<multiselect v-model="value" :options="options" :multiple="true"
 label="name"
    track-by="name"
></multiselect>
                </div>
                

                <div class="form-group">
                  <label>Video:</label>
                  <input
                    type="file"
                    v-on:change="onFileChange"
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
import { mapGetters } from "vuex";
import Vue from 'vue';
import Multiselect from 'vue-multiselect'


export default {
  name: "createPosts",
   components: { Multiselect },
  computed: {
    ...mapGetters(["user"]),
  },
  data() {
    return {
      title: "",
      body: "",
      file: "",
      value: null,
      options: []
    };
  },
  mounted(){
this.loadTags();
},
  methods: {

      async loadTags() {
    console.log("hbjbhbh")
    await axios.get("getTag/").then(res=>{

         console.log(res.data);
         this.options=res.data;
     });
  },
    onFileChange(e) {
      console.log(e.target.files[0]);
      this.file = e.target.files[0];
    },
    async formSubmit(e) {
      e.preventDefault();
console.log(this.value);

let tag=[];
     this.value.forEach((key) => {
             tag.push(key.id);
            });
            console.log(tag);

      const config = {
        headers: { "content-type": "multipart/form-data" },
      };
      let formData = new FormData();
      formData.append("file", this.file);
      formData.append("title", this.title);
      formData.append("body", this.body);
           this.value.forEach((key) => {
            formData.append("tag[]", key.id);
            });
            console.log(...formData);
      
      

     const response = await axios.post("/posts/store", formData, config);
     if(response.data){
       this.flashMessage.show({
          status: "success",
          title: "Success Message ",
          time: 3000,
          message: "New Post Add  successfully",
        });
     }
    },
  },
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>