<template>
  <div>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Blank Page</h1>
    <h1>{{ post.title }} </h1>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Post Detail </h4>
                </div>
                <div class="card-body">
                        <div class="form-group">
                            <label class="label font-weight-bold">Post Title: </label>
                            <h3>{{post.title}}</h3>
                        </div>
                        <div class="form-group">
                            <label class="label font-weight-bold">Post Body: </label>
                            <h3>{{post.body}}</h3>
                        </div>
                        <div class="form-group">
                            <label>Video:</label>
                            <br/><br/>
                               <video
                                style="width: -webkit-fill-available"
                                height="240"
                                controls
                                :src="post.media[0].original_url"
                            ></video>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>


  </div>
</template>

<script>
export default {
    name: 'postShow',
       props:{
          post:{
            type: Object,
            required: true,
          }
        }
}
</script>