<template>
  <div>
    <!-- disini saya menggunakan bootstrap untuk design tabel nya. secara default bootstrap sudah di include di file welcome.blade.php jadi saya tidak perlu lagi untuk import file nya -->
    <div class="row">
      <div class="col-md-12">
        <br>
        <br>
        <div class="row">
          <div class="col-md-10">
            <h4>Categories</h4>
          </div>
          <div class="col-md-2">
            <!-- push router ke form membuat data -->
            <router-link class="btn btn-primary w-100" to="/create-category">+ ADD</router-link>
          </div>
        </div>
        <br>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Name</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- menampilkan data ke table -->
            <tr v-for="(category,index) in categories" :key="category.id">
              <td style="width:40%">{{index+1}}</td>
              <td :id="category.id" style="width:40%">{{category.category}}</td>
              <td style="width:20%">
                <router-link class="btn btn-warning" :to="'/detail-category/'+category.id">Update</router-link>
                <button class="btn btn-danger" v-on:click="deleteData(category.id)">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<!-- script js -->
<script>
export default {
  data() {
    return {
      // variable array yang akan menampung hasil fetch dari api
      categories: []
    };
  },
  created() {
    this.loadData();
  },
  methods: {
    loadData() {
      // fetch data dari api menggunakan axios
      axios.get("http://admin.theprojectarchive.com/api/category").then(response => {
        // mengirim data hasil fetch ke varibale array persons
        this.categories = response.data;
      });
    },
    deleteData(id) {
      // delete data
      axios.delete("http://admin.theprojectarchive.com/api/category/" + id).then(response => {
        this.loadData();
      });
    }
  }
};
</script>