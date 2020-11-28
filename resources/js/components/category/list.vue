<template>


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
                <div class="card-body ">
                    <div class="table-responsive">
                        <table id="example2" class="table table-bordered table-hover">
                        <thead class="text-center">
                             <h6>Check All</h6>
                            <tr>
                             <th>
                                 <input type="checkbox"  :disabled="emptyData()" @click="selectAll" v-model="selectIds">
                             </th>
                            <th>List</th>
                            <th>Category Name</th>
                            <th>Category Description</th>
                            <th>Publication Status</th>
                            <th>Time</th>
                            <th style="height:50px;">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">

                            <tr v-for="(category,index) in categories">
                            <td>
                                <input type="checkbox" :value="category.id" v-model="selectId">
                            </td>
                            <td>{{++index}}</td>
                            <td>{{category.name|subString(3)}}</td>
                            <td>{{category.slug |subString(10)}}...</td>
                            <td>
                                <button :class="statusColor(category.status)" class="btn btn-xs">
                                    {{statusName(category.status)}}

                                </button>

                            </td>
                            <td>{{category.created_at|time}}</td>
                            <td style="height:50px;">

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
                                <td colspan="7">
                                    <h5 class="text-center text-danger">Data not found!</h5>
                                </td>
                            </tr>

                        </tbody>

                    </table>
                    </div>

                    <br/>
                   <div class="dropdown margin-top:2">
                        <button class="btn btn-info dropdown-toggle" :disabled="!isSelected" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown">
                           Click
                        </button>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <button  class="dropdown-item" @click="removeItems(selectId)">Remove</button>
                            <button  class="dropdown-item" @click="changeStatus(selectId,1)">Published</button>
                            <button  class="dropdown-item" @click="changeStatus(selectId,0)">Unpublished</button>
                        </div>

                    </div>

                </div>
                <!-- /.card-body -->

          </div>
        </div>

</template>

<script>
export default {

    name: "CategoryList",

    data: function () {
        return{
            selectId: [],
            selectIds: false,
            isSelected:false,
        }
    },

    mounted() {
            this.$store.dispatch("getCategories");
    },

    watch:{
        selectId: function(selectId){
            this.isSelected=(selectId.length > 0);
            this.selectIds= (selectId.length === this.categories.length);
        }
    },

    computed:{
       categories(){
            return this.$store.getters.categories;
        }
    },
    methods:{
        statusName: function (status) {
            let data ={ 0: "Unpublished ",1: "Published"}
            return data [status];
        },
        statusColor: function (status) {
            let data ={ 0: "btn-warning", 1: "btn-success"}
            return data [status];
        },
        // statusArrow: function (status) {
        //     let data ={ 0: "fa fa-arrow-down", 1: "fa fa-arrow-up"}
        //     return data [status];
        // },
        remove: function (slug) {
            this.confirm( ()=>{
                   axios.get("remove-category/"+slug).then((response)=>{
                        this.$store.dispatch("getCategories");
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        )

                        }).catch((error)=>{

                        })
            });

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
                  this.$store.dispatch("getCategories");
              Swal.fire(
                'success'
                )

                }).catch((error)=>{

                })
              }
            })

        },

        emptyData(){
            return (this.categories.length <1);
        },
        selectAll: function(event){
            if(event.target.checked == false){
                this.selectId=[];

            }else{
                this.categories.forEach((category)=>{
                    if(this.selectId.indexOf(category.id)== -1){
                        this.selectId.push(category.id);
                    }
                });
            }
        },
        removeItems: function(selectId){
            this.confirm( ()=>{
           axios.post("/categories/remove-items",{ids:selectId}).then((response)=>{
                this.selectId= [];
                this.selectIds= false;
                this.isSelected=false;
                toastr.success(response.data.total +'Category Delete success');
                this.$store.dispatch("getCategories");
           }).catch((error)=>{

           })
            });
        },
        changeStatus: function(selectId,status){
            let msg=status === 1 ? "Published":"Unpublished";
           axios.post("/categories/change-status",{ids:selectId, status:status}).then((response)=>{
                this.selectId= [];
                this.selectIds= false;
                this.isSelected=false;
                toastr.success(response.data.total +'Category'+' '+msg+' '+ 'success');
                this.$store.dispatch("getCategories");
           }).catch((error)=>{

           })
        },



    }


}
</script>

<style scoped>

</style>
