<template>

      <div class="">
        <div class="">
          <div class="card">

                <div class="card-header">
                <h3 class="card-title">CategoryList</h3>
                    <div class="card-tools">
                        <button class="btn btn-info">
                            <router-link to="/addCategory"  style="color:white; text-decoration:none;">
                                    Add Category
                            </router-link>
                            </button>

                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                             <th>
                                 <input type="checkbox">
                             </th>
                            <th>List</th>
                            <th>Category Name</th>
                            <th>Category Description</th>
                            <th>Publication Status</th>
                            <th>Time</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr v-for="(category,index) in categories">
                            <td>
                                <input type="checkbox" :value="category.id" v-model="categoryIds">
                            </td>
                            <td>{{++index}}</td>
                            <td>{{category.name}}</td>
                            <td>{{category.slug}}</td>
                            <td>{{statusName(category.status)}}</td>
                            <td>{{category.created_at | time}}</td>
                            <td>

                                <a class="btn btn-xs" :class="statusColor(category.status)" href="">
                                    <span class="" :class="statusArrow(category.status)" ></span>
                                </a>

                                <!-- <a class="btn btn-warning btn-xs" href="">
                                    <span class="fa fa-arrow-down "></span>
                                </a>
                                 -->
                                <router-link :to = "`/edit-category/${category.slug}`" class="edit-btn btn btn-success btn-xs">
                                    <span class="fa fa-edit "></span>
                                </router-link>

                                <a href="" class="delete-btn btn btn-danger btn-xs" @click.prevent="remove(category.slug)">
                                    <span class="fa fa-trash "></span>

                                    <!-- <form id="deleteCategoryForm" action="" method="get">
                                        <input type="hidden" value="" name="id"/>
                                    </form> -->
                                </a>

                            </td>
                            </tr>
                            <tr v-if="emptyData()">
                                <td colspan="6">
                                    <h5 class="text-center text-danger">Data not found!</h5>
                                </td>
                            </tr>

                        </tbody>

                    </table>
                </div>
                <!-- /.card-body -->
          </div>
        </div>
      </div>
</template>

<script>
export default {

    name: "CategoryList",

    data: function () {
        return{
            categoryIds: []
        }
    },

    mounted() {
            this.$store.dispatch("getCategories");
    },

    computed:{
       categories(){
            return this.$store.getters.categories;
        }
    },
    methods:{
        statusName: function (status) {
            let data ={ 0: "Unpublished",1: "Published"}
            return data [status];
        },
        statusColor: function (status) {
            let data ={ 0: "btn-warning ",1: "btn-info"}
            return data [status];
        },
        statusArrow: function (status) {
            let data ={ 0: " fa fa-arrow-down",1: " fa fa-arrow-up"}
            return data [status];
        },
        remove: function (slug) {
         Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                  axios.get("remove-category/"+slug).then((response)=>{
               this.$store.dispatch("getCategories");
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )

                }).catch((error)=>{

                })
              }
            })
        },

        emptyData(){
            return (this.categories.length <1);
        }



    }


}
</script>

<style scoped>

</style>
