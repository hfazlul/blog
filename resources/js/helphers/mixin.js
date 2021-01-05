
import Vue from "vue";
Vue.mixin({
methods:{
   confirm: function (callback) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {

        if (result.isConfirmed) callback();

        });
    },
   confirm2: function (callback) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to chage this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, change it!'
        }).then((result) => {

        if (result.isConfirmed) callback();

        });
    },
    LoadThumbnail: function(e){
        let file = e.target.files[0];
        console.log(file.type);
        if(file.type === 'image/jpeg'){
                let reader = new FileReader();
                reader.onload = e => {
                this.form.thumbnail =e.target.result;
                }
               reader.readAsDataURL(file);
        }else{
           toastr.error('Select png or jpg formate');

        }
    },
    fileLink: function (name){
        if(name !== '' && name.length<256){
            return 'assets/images/' + name;
        } else{
            return this.form.thumbnail;
        }

        },


}
});
