<template>
  <div>
    <!-- disini saya menggunakan bootstrap untuk design tabel nya. secara default bootstrap sudah di include di file welcome.blade.php jadi saya tidak perlu lagi untuk import file nya -->
    <div class="row">
      <div class="col-md-12">
        <br>
        <br>
        <div class="row">
          <div class="col-md-10">
            <h4>Contents</h4>
          </div>
          <div class="col-md-2">
            <!-- push router ke form membuat data -->
            <router-link class="btn btn-primary w-100" to="/create-content">+ Tambah Content</router-link>
          </div>
        </div>
        <br>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Name Brand</th>
              <th scope="col">Category</th>
              <th scope="col">Description</th>
              <th scope="col">URL</th>
              <th scope="col">Cover Image</th>
              <th scope="col">Banner Image</th>
              <th scope="col">Content Image</th>
            </tr>
          </thead>
          <tbody>
            <!-- menampilkan data ke table -->
            <tr v-for="(content,index) in contents" :key="content.id">
              <td style="width:40%">{{content.nama_brand}}</td>
              <td style="width:40%">{{content.category}}</td>
              <td style="width:40%" @click="modal2=true"><button class="btn-style" @click="getName(index)" :id="index" v-if="content.description">{{!content.description ? content.description = "" : content.description.length > 77 ? content.description.substring(0,77) + "..." : content.description}}</button></td>
              <td style="width:40%">{{content.url_content}}</td>
              <td style="width:40%"><img :src="'http://admin.theprojectarchive.com'+ content.cover_image.slice(2,-1)" width="200px" height="200px"></td>
              <td style="width:40%"><img :src="'http://admin.theprojectarchive.com'+ content.banner_image.slice(2,-1)" width="200px" height="200px"></td>
              <td style="width:40%"><button @click="modal=true" class="btn-style"><img @click="getName(index)" :id="index" :src="'http://admin.theprojectarchive.com' + content.content_image[0]" width="200px" height="200px"></button></td>
              <td style="width:20%">
                <router-link class="btn btn-warning" :to="'/detail-content/'+content.id">Update</router-link>
                <button class="btn btn-danger" v-on:click="deleteData(content.id)">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="modal-overlay flex-center" v-if="modal">
        <button v-for="content in contents[this.tempId].content_image" :key="content" @click="modal = false " class="btn-margin btn-style" >
            <img width="200px" height="200px" :src="'http://admin.theprojectarchive.com'+ content">
        </button>
    </div>
    <div class="modal-overlay flex-center" v-else-if="modal2">
        <button @click="modal2 = false " class="btn-margin btn-style" >
            <h1 style="color:white;">{{contents[this.tempId].description}}</h1>
        </button>
    </div>
  </div>
</template>

<!-- script js -->
<script>
export default {
  data() {
    return {
      // variable array yang akan menampung hasil fetch dari api
      contents: [],
      modal: false,
      modal2: false,
      modalImage:'',
      tempId:'',
    };
  },
  created() {
    this.loadData()
    
  },
  mounted(){
    this.loadWorkItems()
  },
  methods: {
    loadData() {
      // fetch data dari api menggunakan axios
      axios.get("http://admin.theprojectarchive.com/api/content").then(response => {
        // mengirim data hasil fetch ke varibale array persons
        this.contents = response.data;
      });
    },
    deleteData(id) {
      // delete data
      axios.delete("http://admin.theprojectarchive.com/api/content/" + id).then(response => {
        this.loadData();
      });
    },
    loadWorkItems(){
      axios.get("http://admin.theprojectarchive.com/api/workitems").then(response => {
        console.log(response.data);
      }

      );
    },
    getName(id){
      this.tempId = id;
    },
  }
};
</script>

<style lang="css" scoped>
  .modal-overlay{
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 98;
        background-color: rgb(0, 0, 0, 0.9);
    }
  .flex-center{
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: scroll;
  }
  .btn-margin{
    margin-left: 20px;
  }
  .btn-style{
        background: none;
        color: inherit;
        border: none;
        padding: 0;
        font: inherit;
        cursor: pointer;
        outline: inherit;
    }
</style>