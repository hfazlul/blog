
<template>
  <div class="row justify-content-around " style="margin-bottom:150px;">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-info">

                    <div class="card-header">
                            <div class="card-header">
                                <h3 class="card-title">Category Add</h3>
                                    <div class="card-tools">
                                        <button class="btn btn-success">
                                            <router-link to="/categoryList"  style="color:white; text-decoration:none;">
                                                    CategoryList
                                            </router-link>
                                            </button>

                                    </div>
                            </div>
                    </div>
              <!-- /.card-header -->

              <!-- form start -->

                        <form role="form" @submit.prevent="addCategory">
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
                                   <button type="submit" :disable="form.busy" class="btn btn-primary">Submit</button>
                                </div>
                        </form>
              </div>
          </div>
   </div>


</template>

<script>
    export default {
         name: "CategoryAdd",
         data: function (){
             return {
                 form: new Form({
                    name:'',
                    status: ''
                 })
                 
             }
             
         },
         methods: {
             addCategory: function () {
                 let test =this;
                 this.form.post('/addCategory')
                 .then(function (data) {
                    // Toast.fire({
                    // icon: 'success',
                    // title: 'Category add successfully'
                    // })
                    toastr.success('Category add successfully',{timeOut:5000});
                     test.form.name=null;
                     test.form.status=null;
                 })
                 
             }
         },
       
    }
</script>

<style scoped>

</style>
