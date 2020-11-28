<template>


        <div class="">
          <div class="card">

                <div class="card-header">
                <h3 class="card-title">PostList</h3>
                    <div class="card-tools">
                        <button class="btn btn-info">
                            <router-link to="/postAdd"  style="color:white; text-decoration:none;">
                                    Add Post
                            </router-link>
                            </button>

                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                         <table id="example2" class="table table-bordered table-hover">
                        <thead >
                            <h6>Check All</h6>
                            <tr class="text-center">
                             <th>
                                 <input type="checkbox">
                             </th>
                            <th>List</th>
                            <th>User Name</th>
                            <th>Category Name</th>
                            <th>Title</th>
                            <th>Thumbnail</th>
                            <th>Status</th>
                            <th>Time</th>
                            <th style="height:50px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr v-for="(post,index) in posts" class="text-center">
                            <td>
                                <input type="checkbox" :value="post.id" v-model="selectIds" >
                            </td>
                            <td>{{++index}}</td>
                            <td>{{post.user.name | subString(10)}}</td>
                            <td>{{post.category.name | subString(10)}}....</td>
                            <td>{{post.title | subString(15)}}....</td>
                            <td><img width="60" :src="post.thumbnail" alt=""></td>
                            <td>{{statusName(post.status) | subString(5)}}....</td>
                            <td>{{post.created_at | time}}</td>
                            <td style="height:50px;">

                                <a class="btn btn-xs" :class="statusColor(post.status)" v-if="statusColor(post.status)" href="" @click.prevent="published(post.id)">
                                    <span class="" :class="statusArrow(post.status)" ></span>
                                </a>
                                <a class="btn btn-xs" :class="statusColor(post.status)" v-else="statusColor(post.status)" href="" @click.prevent="published(post.id)">
                                    <span class="" :class="statusArrow(post.status)" ></span>
                                </a>

                                <!-- <a class="btn btn-warning btn-xs" href="">
                                    <span class="fa fa-arrow-down "></span>
                                </a>
                                 -->
                                  <router-link :to = "`/edit-post/${post.slug}`" class="edit-btn btn btn-success btn-xs">
                                    <span class="fa fa-edit "></span>
                                </router-link>

                                <a href="" class="delete-btn btn btn-danger btn-xs" @click.prevent="remove(post.slug)">
                                    <span class="fa fa-trash "></span>

                                    <!-- <form id="deleteCategoryForm" action="" method="get">
                                        <input type="hidden" value="" name="id"/>
                                    </form> -->
                                </a>

                            </td>
                            </tr>
                            <tr v-if="emptyData()">
                                <td colspan="10">
                                    <h5 class="text-center text-danger">Data not found!</h5>
                                </td>
                            </tr>

                        </tbody>

                    </table>
                </div>
                <!-- /.card-body -->
                <br/>

                   <div class="dropdown margin-top:2">
                        <a class="btn btn-info dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown">
                           Select Checkbox
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#">Click Remove</a>
                        </div>

                    </div>

          </div>
        </div>
      </div>
</template>

<script>
export default {

    name: "PostList",
     data: function () {
        return{
            selectIds: []
        }
    },


    mounted() {
            this.$store.dispatch("getPosts");
    },

    computed:{
       posts(){
            return this.$store.getters.posts;
        }
    },
    methods:{
        statusName: function (status) {
            let data ={ draft: "Unpublished",published: "Published"}
            return data [status];
        },
        statusColor: function (status) {
            let data ={ draft: "btn-warning", published: "btn-success"}
            return data [status];
        },
        statusArrow: function (status) {
            let data ={ draft: "fa fa-arrow-down", published: "fa fa-arrow-up"}
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
                  axios.get("remove-post/"+slug).then((response)=>{
                  this.$store.dispatch("getPosts");
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
        published: function (id) {
                Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, published,unPublishe it!'
            }).then((result) => {
            if (result.isConfirmed) {
                  axios.get("published-category/"+id).then((response)=>{
                  this.$store.dispatch("getPosts");
              Swal.fire(
                'success'
                )

                }).catch((error)=>{

                })
              }
            })

        },

         emptyData(){
            return (this.posts.length <1);
        }


    }


}
</script>

<style scoped>

</style>
