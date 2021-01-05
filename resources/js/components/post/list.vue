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
                     <h6>Check All</h6>
                    <div class="table-responsive">
                         <table id="example2" class="table table-bordered table-hover">
                        <thead >
                            <tr class="text-center">
                             <th>
                                 <input type="checkbox" :disabled="emptyData()" @click="selectAll" v-model="selectIds">
                             </th>
                            <th>List</th>
                            <th>User Name</th>
                            <th>Category Name</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Thumbnail</th>
                            <th>Status</th>
                            <th>Time</th>
                            <th style="height:50px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr v-for="(post,index) in posts" class="text-center">
                            <td>
                                <input type="checkbox" :value="post.id" v-model="selectId">
                            </td>
                            <td>{{++index}}</td>
                            <td>{{post.user.name|subString(7)}}</td>
                            <td>{{post.category.name|subString(7)}}....</td>
                            <td>{{post.title|subString(10)}}....</td>
                            <td>{{post.content|subString(10)}}....</td>
                            <td>
                                <!-- <input type="hidden" value="{{post.thumbnail}}"/> -->
                                <img width="60" style=" border:2px solid green; border-radius: 5px 5px 5px 5px;" :src="fileLink(post.thumbnail)" alt=""></td>
                            <td>{{statusName(post.status)}}</td>
                            <td>{{post.created_at|time}}</td>
                            <td style="height:50px;">

                                    <a href="" :class="statusColor(post.status)" class="btn btn-xs" @click.prevent="status(post.id)">
                                    <span :class="statusArrow(post.status)"></span>
                                    </a>
                                  <router-link :to = "`/postEdit/${post.slug}`" class="edit-btn btn btn-success btn-xs">
                                    <span class="fa fa-edit "></span>
                                  </router-link>

                                <a href="" class="btn btn btn-danger btn-xs" @click.prevent="remove(post.slug)">
                                    <span class="fa fa-trash "></span>
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
                        <button class="btn btn-info dropdown-toggle" :disabled="!isSelected" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown">
                           Select Checkbox
                        </button>

                          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <button  class="dropdown-item" @click="removeItems(selectId)">Remove</button>
                            <button  class="dropdown-item" @click="changeStatus(selectId,'published')">Published</button>
                            <button  class="dropdown-item" @click="changeStatus(selectId,'draft')">Unpublished</button>
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
            selectId: [],
            selectIds: false,
            isSelected:false,
        }
    },


    mounted() {
            this.$store.dispatch("getPosts");
            this.$store.dispatch("getActiveCategories");
    },

     watch:{
        selectId: function(selectId){
            this.isSelected=(selectId.length > 0);
            this.selectIds= (selectId.length === this.posts.length);
        }
    },

    computed:{
       posts(){
            return this.$store.getters.posts;
        }
    },
     methods:{
        statusName: function (status) {
            let data ={ draft: "Unpublished ",published: "Published"}
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
            this.confirm( ()=>{
                   axios.get("remove-post/"+slug).then((response)=>{
                        this.$store.dispatch("getPosts");
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        )

                        }).catch((error)=>{

                        })
            });

        },
        status: function (id) {
                   axios.get("status-post/"+id).then((response)=>{
                        this.$store.dispatch("getPosts");
                        toastr.success('Post change status success');
                        }).catch((error)=>{

                        })
        },

        emptyData(){
            return (this.posts.length <1);
        },
        selectAll: function(event){
            if(event.target.checked == false){
                this.selectId=[];

            }else{
                this.posts.forEach((post)=>{
                    if(this.selectId.indexOf(post.id)== -1){
                        this.selectId.push(post.id);
                    }
                });
            }
        },
        removeItems: function(selectId){
            this.confirm( ()=>{
           axios.post("/posts/remove-items",{ids:selectId}).then((response)=>{
                this.selectId= [];
                this.selectIds= false;
                this.isSelected=false;
                toastr.success(response.data.total +'Post Delete success');
                this.$store.dispatch("getPosts");
           }).catch((error)=>{

           })
            });
        },
        changeStatus: function(selectId, status){
           axios.post("/posts/change-status",{ids:selectId, status:status}).then((response)=>{
                this.selectId= [];
                this.selectIds= false;
                this.isSelected=false;
                toastr.success(response.data.total +'Post'+' '+status+' '+ 'success');
                this.$store.dispatch("getPosts");
           }).catch((error)=>{

           })
        },

    }


}
</script>

<style scoped>

</style>
