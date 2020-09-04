<template>
  <div>
    <div class="row">
      <div class="col-md-6">
        <br>
        <br>
        <h4>Update Text</h4>
        <br>
        <!-- prevent form submit untuk reload halaman, kemudian memanggil function updateData() -->
        <form @submit.prevent="updateData()">
          <div class="form-group">
            <label>Text</label>
            <textarea
              class="form-control"
              placeholder="Input Text"
              v-model="form.text"
              required
            ></textarea>
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
        text: "",
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
        .get("http://admin.theprojectarchive.com/api/aboutdesc/" + this.$route.params.id)
        .then(response => {
          // post value yang dari response ke form
          this.form.text = response.data.about_text;
        });
    },
    updateData() {
      // put data ke api menggunakan axios
      axios
        .put("http://admin.theprojectarchive.com/api/aboutdesc/" + this.$route.params.id, {
          about_text: this.form.text,
        })
        .then(response => {
          // push router ke read data
          this.$router.push("/about-desc");
        });
    }
  }
};
</script>