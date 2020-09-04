<template>
  <div>
    <!-- disini saya menggunakan bootstrap untuk design tabel nya. secara default bootstrap sudah di include di file welcome.blade.php jadi saya tidak perlu lagi untuk import file nya -->
    <div class="row">
      <div class="col-md-12">
        <br>
        <br>
        <div class="row">
          <div class="col-md-10">
            <h4>About Desc</h4>
          </div>
        </div>
        <br>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Text</th>
            </tr>
          </thead>
          <tbody>
            <!-- menampilkan data ke table -->
              <td style="width:40%">{{aboutDesc[0].about_text}}</td>
              <td style="width:20%">
                <router-link class="btn btn-warning" :to="'/detail-aboutdesc/'+aboutDesc[0].id">Update</router-link>
              </td>
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
      aboutDesc: '',
    };
  },
  created() {
    this.loadData();
  },
  methods: {
    loadData() {
      // fetch data dari api menggunakan axios
      axios.get("http://localhost:8000/api/aboutdesc").then(response => {
        // mengirim data hasil fetch ke varibale array persons
        this.aboutDesc = response.data;
      });
    },
  }
};
</script>
