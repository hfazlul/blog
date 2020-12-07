
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
                                        <select id="category_id" name="category_id" class="form-control" :class="{ 'is-invalid': form.errors.has('category_id') }"  v-model="form.category_id">
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
                                        <ckeditor rows="5" name="content" :editor="editor" :class="{ 'is-invalid': form.errors.has('content') }" v-model="form.content" :config="editorConfig"></ckeditor>
                                        <has-error :form="form" field="content"></has-error>
                                    </div>
                                     <div class="form-group">
                                        <label >Select Image</label>
                                       <input type="file" name="thumbnail" id="thumbnail" @change="LoadThumbnail($event)">
                                       <br/>
                                       <img style="height:100px; width:100px; margin-left:87px; border:none;" :src="form.thumbnail" alt="">
                                        <has-error :form="form" field="thumbnail"></has-error>
                                    </div>

                                    <div class="form-group">
                                        <label >Publication Status</label>
                                        <div class="form-group">
                                            <label><input type="radio" class="" name="status" value="published" v-model="form.status"/>Published</label>
                                            <label><input type="radio" class="" name="status" value="draft" v-model="form.status"/>UnPublished</label>

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
   import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    export default {
         name: "PostAdd",
         data: function (){
             return {
                 form: new Form({
                    title:'',
                    status:'',
                    content: '',
                    thumbnail: null,
                    category_id: ''
                 }),
                 editor: ClassicEditor,
                 editorData: '<p>Content of the editor.</p>',
                 editorConfig: {

                    // The configuration of the editor.
                 }

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
                 this.form.post('/addPost')
                 .then((response)=> {
                    toastr.success('Post add successfully');
                     this.form.title=null;
                     this.form.status=null;
                     this.form.category_id='';
                     this.form.content=null;
                     this.form.thumbnail=null;
                 }).catch((error)=>{

                 })

             },
             LoadThumbnail: function(e){
                 let file = e.target.files[0];
                 let reader = new FileReader();
                 reader.onload = e => {
                     this.form.thumbnail =e.target.result;
                 }
                 reader.readAsDataURL(file);
             },
         },

    }
</script>

<style scoped>

</style>
