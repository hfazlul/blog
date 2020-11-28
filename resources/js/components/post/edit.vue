
<template>
  <div class="row justify-content-around " style="margin-bottom:150px;">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-info">

                    <div class="card-header">
                            <div class="card-header">
                                <h3 class="card-title">Category Edit</h3>
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

                        <form role="form" @submit.prevent="updateCategory">
                            <div class="card-body">
                                    <div class="form-group">
                                        <label >Category Name</label>
                                        <input type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" name="name" placeholder="add Category" v-model="form.name">
                                        <has-error :form="form" field="name"></has-error>
                                    </div>

                                    <div class="form-group">
                                        <label >Publication Status</label>
                                        <div class="form-group">
                                            <label><input type="radio" class=""   name="status" value="1" v-model="form.status"/>Published</label>
                                            <label><input type="radio" class=""  name="status" value="0" v-model="form.status"/>UnPublished</label>

                                        </div>
                                        <span :class="{ 'is-invalid': form.errors.has('status') }" ></span>
                                         <has-error :form="form" field="status"></has-error>
                                    </div>


                            </div>
                            <!-- /.card-body -->

                                <div class="card-footer">
                                   <button type="submit" :disable="form.busy" class="btn btn-primary">Update Catergory</button>
                                </div>
                        </form>
              </div>
          </div>
   </div>


</template>

<script>
    export default {
         name: "CategoryEdit",
         data: function (){
             return {
                 form: new Form({
                    id:'',
                    name:'',
                    status: ''
                 })

             }

         },
         mounted()
         {
            this.getCategory();
         },
         methods: {

                updateCategory: function () {
                    let this_ =this;
                    this_.form.post('/updateCategory')
                    .then( (response) => {
                        toastr.success('Category update successfully');
                        this_.$router.push("/categoryList");
                    })

                },
                getCategory: function () {
                const this_=this;
                axios.get("/show-category/"+this.$route.params.slug).then((response)=>{
                    this_.form.fill(response.data.category);
                }).catch((error)=>{

                })
             }

         },

    }
</script>

<style scoped>

</style>
