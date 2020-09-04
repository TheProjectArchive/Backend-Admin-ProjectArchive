<template>
  <div>
    <div class="row">
      <div class="col-md-6">
        <br>
        <br>
        <h4>Update Category</h4>
        <br>
        <!-- prevent form submit untuk reload halaman, kemudian memanggil function updateData() -->
        <form @submit.prevent="updateData()">
          <div class="form-group">
            <label>Category name</label>
            <input
              type="textfield"
              class="form-control"
              placeholder="Input your first name"
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
  data() {
    return {
      form: {
        category: "",
      }
    };
  },
  created() {
    // load data saat pertama kali halaman dibuka
    this.loadData();
  },
  methods: {
    loadData() {
      // load data berdasarkan id
      axios
        .get("http://localhost:8000/api/category/" + this.$route.params.id)
        .then(response => {
          // post value yang dari response ke form
          this.form.category = response.data.category;
        });
    },
    updateData() {
      // put data ke api menggunakan axios
      axios
        .put("http://localhost:8000/api/category/" + this.$route.params.id, {
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