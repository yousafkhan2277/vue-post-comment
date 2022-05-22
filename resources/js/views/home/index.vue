<template>
  <div>
    <Nav />
    

<ListPost
:posts="PostsData"
:message="abc"
:userID="userId"
/>




    <!-- <div class="container">
      <div class="text-center py-5 min-vh-50">
        <button @click="check()">click</button>
        <router-link to="/admin" class="btn btn-primary">
          Go to dashboard  <i class="fas fa-chevron-right"></i
        ></router-link>
      </div>
    </div> -->

    <Footer />
  </div>
</template>

<script>
import Nav from "../../components/Nav";
import Footer from "../../components/Footer";
import ListPost from "../../components/Post/ListPost.vue";
import { mapGetters } from "vuex";

export default {
  name: "Home",
  components: {
    Nav,
    Footer,
    ListPost,
  },
  data() {
    return {
      PostsData:[],
      abc:'hggggplo',
      userId:'',
    };
  },
  computed: {
    ...mapGetters(["user"]),
  },

  async created() {
     const response = await axios.get("posts");
    console.log(response.data);
    this.PostsData = response.data;
    console.log("providersAction",this.PostsData);
    console.log(this.user)
    if(this.user){
      this.userId=this.user.id;
    }
  },
    methods: {
    async check() {
     let checkAuth =  localStorage.getItem("token");
     
     if(checkAuth==null){
   this.$router.push('/admin')
     }else{
       alert("ppp")
     }
    },
  },
};
</script>

<style>
.home-title {
  font-size: 4rem;
}
.masthead {
  background: linear-gradient(0deg, #4e73df 0%, #36b9cc 100%);
  padding-top: 5rem;
  padding-bottom: 5rem;
}
.min-vh-50 {
    min-height: 50vh !important;
}



@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap");body{background-color: #eee;font-family: "Poppins", sans-serif;font-weight: 300}.card{border:none}.ellipsis{color: #a09c9c}hr{color: #a09c9c;margin-top: 4px;margin-bottom: 8px}.muted-color{color: #a09c9c;font-size: 13px}.ellipsis i{margin-top: 3px;cursor: pointer}.icons i{font-size: 25px}.icons .fa-heart{color: red}.icons .fa-smile-o{color: yellow;font-size: 29px}.rounded-image{border-radius: 50%!important;display: flex;justify-content: center;align-items: center;height: 50px;width: 50px}.name{font-weight: 600}.comment-text{font-size: 12px}.status small{margin-right: 10px;color: blue}.form-control{border-radius: 26px}.comment-input{position: relative}.fonts{position: absolute;right: 13px;top:8px;color: #a09c9c}.form-control:focus{color: #495057;background-color: #fff;border-color: #8bbafe;outline: 0;box-shadow: none}



</style>
