<template>
  <div>
    <FlashMessage></FlashMessage>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Post</h1>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Post</h4>
                </div>
                <div class="card-body">
                    <form @submit="formSubmit" enctype="multipart/form-data">
                        <div class="form-group">
                            
                            <label class="label">Post Title: </label>
                            <input type="text" v-model="title" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label class="label">Post Body: </label>
                            <textarea v-model="body" rows="4" cols="30" class="form-control" required></textarea>
                        </div>


                        <div class="form-group">
                            <label>Video:</label>
                            <input type="file" v-on:change="onFileChange" class="form-control" >
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
export default {
    name: 'editPost',
           props:{
          post:{
            type: Object,
            required: true,
          }
        },
computed: {
    ...mapGetters(["user"]),
  },
    data() {
    return {
              title: this.post.title,
              body: this.post.body,
              file: ''
    };
  },
    methods:{
onFileChange(e){
                console.log(e.target.files[0]);
                this.file = e.target.files[0];
            },
          async  formSubmit(e) {
                e.preventDefault();
                console.log("this.file",this.file);
                console.log(this.$route.params.id)
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
                let formData = new FormData();
                if(this.file){
                formData.append('file', this.file);
                console.log("yes")
                }else{
                    console.log("no")
                }
                formData.append('title', this.title);
                formData.append('body', this.body);
            
             const response =  await axios.post('/posts/update/'+this.$route.params.id, formData, config);

     
     if(response.data){
       this.flashMessage.show({
          status: "success",
          title: "Success Message ",
          time: 3000,
          message: "Post Edit  successfully",
        });
     }



            }
    },
}
</script>