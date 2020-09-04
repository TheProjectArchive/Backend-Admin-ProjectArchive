<template>
  <div>
    <div class="row">
      <div class="col-md-6">
        <br>
        <br>
        <h4>UPDATE DATA</h4>
        <br>
        <!-- prevent form submit untuk reload halaman, kemudian memanggil function updateData() -->
        <form @submit.prevent="updateData()">
          <div class="form-group">
            <label>Name</label>
            <input
              type="textfield"
              class="form-control"
              placeholder="Input Name"
              v-model="form.name"
              required
            >
          </div>
          <div class="form-group">
            <label>Email</label>
            <input
              type="textfield"
              class="form-control"
              placeholder="Input Email"
              v-model="form.email"
              required
            >
          </div>
          <div class="form-group">
            <label>Phone</label>
            <input
              type="textfield"
              class="form-control"
              placeholder="Input Phone"
              v-model="form.phone"
              required
            >
          </div>
          <div class="form-group">
            <label>Message</label>
            <textarea
              class="form-control"
              placeholder="Input message"
              v-model="form.message"
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
        name: "",
        email: "",
        phone: "",
        message: "",
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
        .get("http://admin.theprojectarchive.com/api/contact/" + this.$route.params.id)
        .then(response => {
          // post value yang dari response ke form
          this.form.name = response.data.name;
          this.form.email = response.data.email;
          this.form.phone = response.data.phone;
          this.form.message = response.data.message;
        });
    },
    updateData() {
      // put data ke api menggunakan axios
      axios
        .put("http://admin.theprojectarchive.com/api/contact/" + this.$route.params.id, {
          name: this.form.name,
          email: this.form.email,
          phone: this.form.phone,
          message: this.form.message,
        })
        .then(response => {
          // push router ke read data
          this.$router.push("/");
        });
    }
  }
};
</script>