
<template>
  <div class="row justify-content-around " style="margin-bottom:150px;">
          <!-- left column -->
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-info">

                    <div class="card-header">
                            <div class="card-header">
                                <h3 class="card-title">Post Add</h3>
                                    <div class="card-tools">
                                        <button class="btn btn-success">
                                            <router-link to="/postList"  style="color:white; text-decoration:none;">
                                                    PostList
                                            </router-link>
                                            </button>

                                    </div>
                            </div>
                    </div>
              <!-- /.card-header -->

              <!-- form start -->

                        <form role="form" @submit.prevent="addPost" enctype="multipart/form-data">
                            <div class="card-body">
                                    <div class="form-group">
                                        <label for="category_id">Category Select</label>
                                        <select id="category_id" class="form-control" :class="{ 'is-invalid': form.errors.has('category_id') }"  v-model="form.category_id">
                                            <option value="" >Select any one</option>
                                            <option :value="cat.id" v-for="cat in categories">{{cat.name}}</option>
                                        </select>
                                        <has-error :form="form" field="category_id"></has-error>
                                    </div>
                                     <div class="form-group">
                                        <label >Post Title</label>
                                        <input type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('title') }" name="title" placeholder="Post title" v-model="form.title">
                                        <has-error :form="form" field="title"></has-error>
                                    </div>
                                     <div class="form-group">
                                        <label >Post Description</label>
                                        <textarea type="text" rows="5" class="form-control" :class="{ 'is-invalid': form.errors.has('description') }" name="description" placeholder="Post description" v-model="form.description"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label >Publication Status</label>
                                        <div class="form-group">
                                            <label><input type="radio" class="" name="status" value="1" v-model="form.status"/>Published</label>
                                            <label><input type="radio" class="" name="status" value="0" v-model="form.status"/>UnPublished</label>

                                        </div>
                                        <span :class="{ 'is-invalid': form.errors.has('status') }" ></span>
                                         <has-error :form="form" field="status"></has-error>
                                    </div>


                            </div>
                            <!-- /.card-body -->

                                <div class="card-footer">
                                   <button type="submit" :disable="form.busy" class="btn btn-primary">Submit</button>
                                </div>
                        </form>
              </div>
          </div>
   </div>


</template>

<script>
    export default {
         name: "PostAdd",
         data: function (){
             return {
                 form: new Form({
                    name:'',
                    status: '',
                    category_id: ''
                 })

             }

         },
          mounted() {
            this.$store.dispatch("getActiveCategories");
            },
             computed:{
                categories(){
                        return this.$store.getters.categories;
                    }
                },

         methods: {
             addPost: function () {
                 let test =this;
                 this.form.post('/addPost')
                 .then(function (data) {
                    // Toast.fire({
                    // icon: 'success',
                    // title: 'Category add successfully'
                    // })
                    toastr.success('Post add successfully',{timeOut:5000});
                     test.form.name=null;
                     test.form.status=null;
                 })

             }
         },

    }
</script>

<style scoped>

</style>
