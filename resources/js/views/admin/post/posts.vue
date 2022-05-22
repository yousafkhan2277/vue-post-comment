<template>
  <div>
          <FlashMessage></FlashMessage>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Manage Posts</h1>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

         <router-link style="float: right" class="btn btn-success btn-sm mb-2" to="/admin/pages/posts/create">
          <i class="fas fa-plus"></i>
          </router-link>

            <table class="table table-bordered table-hover">
                <thead>
                    <th width="80px">Line#</th>
                    <th>Title</th>
                    <th width="150px">Action</th>
                    
                </thead>
                <tbody>
 
                <tr  v-for="(post,index) in Posts" :key="post.id">
                    <td>{{post.line}}</td>
                    <td>{{post.title}}</td>
                    <td>

                    <router-link  class="btn btn-primary btn-sm" 
                    :to="{ name: 'postShow', params: {post: post} }">
                      <i class="fas fa-eye"></i>
                      </router-link>
                    <router-link  class="btn btn-primary btn-sm" 
                    :to="{ name: 'editPost', params: {id: post.id,post: post} }">
                      <i class="fas fa-edit"></i>
                      </router-link>
                        <a href="#" @click="deletePost(post.id,index)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                </tbody>
   
            </table>
        </div>
    </div>
</div>


  </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
    name: 'posts',
       computed: {
    ...mapGetters(["user"]),
  },
    data() {
    return {
      Posts:[],
    };
  },
mounted(){
this.loadPosts();
},
  methods:{
  async loadPosts() {
    await axios.get("getAuthpost/"+this.user.id).then(res=>{
     res.data.forEach((key, index) => {
              key['line'] = index + 1;
            });
         this.Posts=res.data;
     });
  },
  async deletePost(id,index){
    console.log(id);
      const response = await axios.post("posts/delete/"+id)
      if(response.data.success){
       this.Posts.splice(index, 1);
       this.Posts.forEach((key, index) => {
          key.line = index + 1;
        });

          this.flashMessage.show({
          status: "success",
          title: "Success Message ",
          time: 3000,
          message: "Post Delete successfully",
        });
       }
  }

  }
}

</script>