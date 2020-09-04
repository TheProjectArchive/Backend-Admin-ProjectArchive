<template>
  <div>
    <div class="row">
      <div class="col-md-6">
        <br>
        <br>
        <h4>Create new Category</h4>
        <br>
        <!-- prevent form submit untuk reload halaman, kemudian memanggil function addData() -->
        <form @submit.prevent="addData()">
          <div class="form-group">
            <label>Category name</label>
            <input
              type="textfield"
              class="form-control"
              placeholder="Input Category"
              v-model="form.category"
              required
            >
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
        category: '',
      }
    }
  },
  methods: {
    addData() {
      // post data ke api menggunakan axios
      axios
        .post("http://admin.theprojectarchive.com/api/category", {
          category: this.form.category,
        })
        .then(response => {
          // push router ke read data
          this.$router.push("/category-list");
        });
    }
  }
};
</script>