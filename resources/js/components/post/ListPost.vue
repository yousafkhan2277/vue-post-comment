<template>
  <div>
    <div class="container marginset" v-for="post in posts" :key="post.id">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between p-2 px-3">
                <div class="d-flex flex-row">
                  <div class="d-flex flex-column ml-2">
                    <span class="font-weight-bold">{{
                      post.user.first_name + post.user.last_name
                    }}</span>
                    <small class="text-primary">creator</small>
                  </div>
                </div>
                <div class="d-flex flex-row mt-1 ellipsis">
                  <small class="mr-2">{{ post.created_at }}</small>
                </div>
              </div>

              <hr />
              <br />
              <h3>{{ post.title }}</h3>
              <hr />
              <video
                style="width: -webkit-fill-available"
                height="240"
                controls
                :src="post.media[0].original_url"
              ></video>
              <hr />
              <p>
                {{ post.body }}
              </p>
              <hr />
              <h4 class="text-info">Display Comments</h4>

              <hr />

              <div
                class="parent-Comments"
                v-for="comment in post.comments"
                :key="comment.id"
              >
                <div class="d-flex flex-row mb-2">
                  <div class="d-flex flex-column ml-2">
                    <span class="name">{{
                      comment.user.first_name + comment.user.last_name
                    }}</span>
                    <small class="comment-text">{{ comment.body }}</small>
                    <div class="d-flex flex-row align-items-center status">
                      <small @click="replyForm = !replyForm">Reply</small>
                       <small>{{comment.created_at}}</small>
                    </div>
                  </div>
                </div>
                <form @submit="formSubmitParentComment">
                  <div class="form-group">
                    <input
                      type="text"
                      value=''
                      name="body"
                      class="form-control parentInput"
                    />
                  </div>
                  <input type="hidden" name="postParent" :value="post.id" />
                  <input type="hidden" name="commentID" :value="comment.id" />
                  <div class="form-group">
                    <input
                      type="submit"
                      class="btn btn-success"
                      value="Reply"
                    />
                  </div>
                  <hr />
                </form>

                <div
                  class="child-Comments"
                  
                  v-for="reply in comment.replies"
                  :key="reply.id"
                >
                  <div class="d-flex flex-row mb-2">
                    <div class="d-flex flex-column ml-2">
                      <span class="name">{{
                        reply.user.first_name + reply.user.last_name
                      }}</span>
                      <small class="comment-text">{{ reply.body }}</small>
                      <div class="d-flex flex-row align-items-center status">
                        <small @click="replyChildForm = !replyChildForm"
                          >Reply</small
                        >
                         <small>{{reply.created_at}}</small>
                      </div>
                    </div>
                  </div>
                  <form @submit="formSubmitChildComment">
                    <div class="form-group">
                      <input type="text"  value='' name="body" class="form-control childInput" />
                    </div>
                 <input type="hidden" name="postChild" :value="post.id" />
                  <input type="hidden" name="commentChildID" :value="reply.id" />
                    <div class="form-group">
                      <input
                        type="submit"
                        class="btn btn-success"
                        value="Reply"
                      />
                    </div>
                    <hr />
                  </form>
                </div>
              </div>

              <h4>Add comment</h4>
              <form @submit="formSubmitComment">
                <div class="form-group">
                  <textarea
                    class="form-control addInput"
                    name="body"
                    value=""
                  ></textarea>
                </div>
                <input type="hidden" name="post" :value="post.id" />
                <div class="form-group">
                  <input
                    type="submit"
                    class="btn btn-primary"
                    value="Add Comment"
                  />
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
export default {
  name: "ListPost",
  props: ["posts", "message", "userID"],
  data() {
    return {
      replyForm: false,
      replyChildForm: false,
      parentComment: "",
      addComment: "",
      childComment: "",
    };
  },

  methods: {
      
    async formSubmitComment(e) {
      e.preventDefault();

let checkAuth =  localStorage.getItem("token");
     
     if(checkAuth==null){
   this.$router.push('/admin')
     }else{




      let postId = e.target.elements.post.value;

      const config = {
        headers: { "content-type": "multipart/form-data" },
      };

      let formData = new FormData();
      formData.append("body", e.target.body.value);
      formData.append("user_id", this.userID);
      formData.append("post_id", postId);

      const response = await axios.post("/comments", formData, config);
      console.log(response.data);
      $(".addInput").val("");
      this.posts.forEach((element) => {
        if (element.id == postId) {
          element.comments.push(response.data);
        }
      });
      this.addComment = "";
           }
    },
    async formSubmitParentComment(e) {
        
      e.preventDefault();
      console.log(e.target.body.value);
let checkAuth =  localStorage.getItem("token");
     
     if(checkAuth==null){
   this.$router.push('/admin')
     }else{

      let postId = e.target.elements.postParent.value;
      let commentId = e.target.elements.commentID.value;
      console.log(commentId);

      const config = {
        headers: { "content-type": "multipart/form-data" },
      };

      let formData = new FormData();
      formData.append("body", e.target.body.value);
      formData.append("user_id", this.userID);
      formData.append("post_id", postId);
      formData.append("parent_id", commentId);


      const response = await axios.post("/comments", formData, config);
      console.log(response.data);
       $(".parentInput").val("");
      this.posts.forEach((element) => {
        if (element.id == postId) {
            
        element.comments.forEach((comment) => {
        if (comment.id == commentId) {
            
          comment.replies.unshift(response.data);
        }
      });

        }
      });
      this.parentComment = "";
     }
    },
        async formSubmitChildComment(e) {
        
      e.preventDefault();
      let checkAuth =  localStorage.getItem("token");
     
     if(checkAuth==null){
   this.$router.push('/admin')
     }else{
      let postId = e.target.elements.postChild.value;
      let commentId = e.target.elements.commentChildID.value;
      console.log(commentId);

      const config = {
        headers: { "content-type": "multipart/form-data" },
      };

      let formData = new FormData();
      formData.append("body", e.target.body.value);
      formData.append("user_id", this.userID);
      formData.append("post_id", postId);
      formData.append("parent_id", commentId);


      const response = await axios.post("/comments", formData, config);
      console.log(response.data);
$(".childInput").val("");
      this.posts.forEach((element) => {
        if (element.id == postId) {
            
        element.comments.forEach((comment) => {
        if (comment.id == commentId) {
            
          comment.replies.unshift(response.data);
        }
      });

        }
      });
      this.childComment = "";
     }
    },
  },
};
</script>
<style scoped>
.videoWidth {
  width: "-webkit-fill-available !important";
}
.marginset {
  margin-top: 90px;
  margin-bottom: 30px;
}
.child-Comments {
  margin-left: 40px;
}
</style>

