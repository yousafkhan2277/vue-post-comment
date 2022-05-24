<template>
  <div>
          <FlashMessage></FlashMessage>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Manage tags</h1>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

         <router-link style="float: right" class="btn btn-success btn-sm mb-2" to="/admin/pages/tag/create">
          <i class="fas fa-plus"></i>
          </router-link>

            <table class="table table-bordered table-hover">
                <thead>
                    <th width="80px">Line#</th>
                    <th>Title</th>
                </thead>
                <tbody>
 
                <tr  v-for="(tag) in tags" :key="tag.id">
                    <td>{{tag.line}}</td>
                    <td>{{tag.name}}</td>
                </tr>
                </tbody>
   
            </table>
        </div>
    </div>
</div>


  </div>
</template>

<script>
export default {
    name: 'tags',
    data() {
    return {
      tags:[],
    };
  },
mounted(){
this.loadPosts();
},
  methods:{
  async loadPosts() {
    console.log("hbjbhbh")
    await axios.get("getTag/").then(res=>{
     res.data.forEach((key, index) => {
              key['line'] = index + 1;
            });
         this.tags=res.data;
     });
  },

  }
}

</script>