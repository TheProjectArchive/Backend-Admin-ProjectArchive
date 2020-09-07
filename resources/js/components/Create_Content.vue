<template>
  <div>
    <div class="row">
      <div class="col-md-6">
        <br>
        <br>
        <h4>Create new Content</h4>
        <br>
        <!-- prevent form submit untuk reload halaman, kemudian memanggil function addData() -->
        <form @submit.prevent="addData()" enctype="multipart/form-data">
          <div class="form-group">
            <label>Nama Brand</label>
            <input
              type="textfield"
              class="form-control"
              placeholder="Input Nama Brand"
              v-model="form.nama_brand"
              required
            >
          </div>
          <div class="form-group">
            <label>Category</label><br>
            <select v-model="form.category" style="width:200px;height:30px">
                <option disabled value="">--Choose One--</option>
                <option v-for="category in categories" :key="category.id" :value="category.category">{{category.category}}</option>
            </select>
          </div>
          <div class="form-group">
            <label>Description</label>
            <textarea
              class="form-control"
              placeholder="Input Desc"
              v-model="form.description"
            ></textarea>
          </div>
          <div class="form-group">
            <label>URL LINK</label>
            <input
              type="textfield"
              class="form-control"
              placeholder="Input Description"
              v-model="form.url_content"
            >
          </div>
          <div class="form-group">
              <label>Cover Image</label>
              <input
              type="file"
              class="form-control"
              @change="imageChange"
              >
          </div>
          <div class="form-group">
              <label>Banner Image</label>
              <input
              type="file"
              class="form-control"
              @change="imageChange2"
              >
          </div>
          <div class="form-group">
              <label>Content Image</label>
              <input
              multiple
              type="file"
              class="form-control"
              @change="imageChange3"
              ref="files"
              >
          </div>
          <div class="m-auto">
              <p v-for="(image,index) in form.content_image" :key="index">No.{{index+1}} : {{image.name}}</p>
          </div>
          <button class="btn btn-primary">Submit</button>
          </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
      form:{
        nama_brand: '',
        category: '',
        description: '',
        cover_image: '',
        banner_image: '',
        url_content:'',
        content_image:[],
      },
      categories:'',
    }
  },
  created() {
    this.loadCategory();
  },
  methods: {
    imageChange(e){
        let selectedfile = e.target.files[0];
        this.form.cover_image = selectedfile;
        console.log(this.form.cover_image);
        console.log(this.form);
    },
    imageChange2(e){
        let selectedfile = e.target.files[0];
        this.form.banner_image = selectedfile;
        console.log(this.form.banner_image);
    },
    imageChange3(){
        for(let i = 0 ; i <this.$refs.files.files.length; i++){
            this.form.content_image.push(this.$refs.files.files[i]);
            console.log(this.form.content_image);
        }
    },
    loadCategory(){
      axios.get("http://admin.theprojectarchive.com/api/category").then(response => {
        // mengirim data hasil fetch ke varibale array persons
        this.categories = response.data;
      });
    },
    addData() {
      // post data ke api menggunakan axios

      var self = this;
      let formData = new FormData();


      formData.append('nama_brand',this.form.nama_brand);
      formData.append('category',this.form.category);
      formData.append('description',this.form.description);
      formData.append('url_content',this.form.url_content);
      formData.append('cover_image', this.form.cover_image);
      formData.append('banner_image', this.form.banner_image);
      for(let i = 0;i<this.form.content_image.length;i++)
      {
          let file = self.form.content_image[i];
          formData.append('content_image[' + i + ']', file);
      }
      
      const config = {
          headers:{"content-type" : "multipart/form-data"}
      }

      axios
        .post("http://admin.theprojectarchive.com/api/content", formData,config)
        .then(response => {
          // push router ke read data
          this.$router.push("/content-list");
        });
    }
  }
};
</script>