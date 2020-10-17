<template>
<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Alumni</h3>

                        <div class="card-tools">

                            <button type="button" class="btn btn-sm btn-primary" @click="newModal">
                                <i class="fa fa-plus-square"></i>
                                Tambah Data
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <app-datatable :items="items" :fields="fields" :meta="meta" :title="'Hapus Data Santri'" @per_page="handlePerPage" @pagination="handlePagination" @search="handleSearch" @sort="handleSort" />
                        <!--table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Nama</th>
                      <th>Alamat</th>
                      <th>Kabupaten</th>
                      <th>Tahun Masuk</th>
                      <th>Tahun Keluar</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="product in products.data" :key="product.id">

                      <td>{{product.id}}</td>
                      <td>{{product.name}}</td>
                      <td>{{product.description | truncate(30, '...')}}</td>
                      <td>{{product.category.name}}</td>
                      <td>{{product.price}}</td>
                      <td>

                        <a href="#" @click="editModal(product)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#" @click="deleteProduct(product.id)">
                            <i class="fa fa-trash red"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table-->
                    </div>
                    <!-- /.card-body -->
                    <!--div class="card-footer">
                  <pagination :data="products" @pagination-change-page="getResults"></pagination>
              </div-->
                </div>
                <!-- /.card -->
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNew" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="!editmode">Tambah Data Alumni</h5>
                        <h5 class="modal-title" v-show="editmode">Edit Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form @submit.prevent="editmode ? updateProduct() : createSantri()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input v-model="form.nama" type="text" name="nama" class="form-control" :class="{ 'is-invalid': form.errors.has('nama') }">
                                <has-error :form="form" field="nama"></has-error>
                            </div>
                            <div class="form-group">
                                <label>NIK</label>
                                <input v-model="form.nik" type="text" name="nik" class="form-control" :class="{ 'is-invalid': form.errors.has('nik') }">
                                <has-error :form="form" field="nik"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input v-model="form.tempat_lahir" type="text" name="tempat_lahir" class="form-control" :class="{ 'is-invalid': form.errors.has('tempat_lahir') }">
                                <has-error :form="form" field="tempat_lahir"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <!--input v-model="form.tanggal_lahir" type="text" name="tanggal_lahir" class="form-control" :class="{ 'is-invalid': form.errors.has('tanggal_lahir') }"-->
                                <!--b-form-datepicker id="tanggal_lahir" v-model="form.tanggal_lahir" placeholder="Pilih Tanggal Lahir" :date-format-options="{ year: 'numeric', month: 'numeric', day: 'numeric' }" locale="en"></b-form-datepicker-->
                                <b-form-input id="type-date" type="date" v-model="form.tanggal_lahir" placeholder="Pilih Tanggal Lahir"></b-form-input>
                                <has-error :form="form" field="tanggal_lahir"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <!--select class="form-control" v-model="form.jenis_kelamin">
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select-->
                                <b-form-select :options="data_jenis_kelamin" @input="loadAsrama" v-model="form.jenis_kelamin" placeholder="== Pilih Jenis Kelamin == "></b-form-select>
                                <has-error :form="form" field="jenis_kelamin"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <input v-model="form.alamat" type="text" name="alamat" class="form-control" :class="{ 'is-invalid': form.errors.has('alamat') }">
                                <has-error :form="form" field="alamat"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Provinsi</label>
                                <!--select class="form-control" v-model="form.provinsi_id">
                                    <option v-for="(provinsi,index) in data_provinsi" :key="index" :value="index" :selected="index == form.provinsi_id">{{ provinsi }}</option>
                                </select-->
                                <b-form-select :options="data_provinsi" @input="loadKabupaten" v-model="form.provinsi_id" placeholder="== Pilih Provinsi == "></b-form-select>
                                <has-error :form="form" field="provinsi_id"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Kabupaten/Kota</label>
                                <!--select class="form-control" v-model="form.kabupaten_id"></select-->
                                <b-form-select :options="data_kabupaten" @input="loadKecamatan" v-model="form.kabupaten_id" placeholder="== Pilih Kab/Kota == "></b-form-select>
                                <has-error :form="form" field="kabupaten_id"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Kecamatan</label>
                                <!--select class="form-control" v-model="form.kecamatan_id"></select-->
                                <b-form-select :options="data_kecamatan" @input="loadDesa" v-model="form.kecamatan_id" placeholder="== Pilih Kecamatan == "></b-form-select>
                                <has-error :form="form" field="kecamatan_id"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Desa/Kelurahan</label>
                                <!--select class="form-control" v-model="form.desa_id"></select-->
                                <b-form-select :options="data_desa" v-model="form.desa_id" placeholder="== Pilih Desa/Kelurahan == "></b-form-select>
                                <has-error :form="form" field="desa_id"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Nomor HP</label>
                                <input v-model="form.nomor_hp" type="text" name="nomor_hp" class="form-control" :class="{ 'is-invalid': form.errors.has('nomor_hp') }">
                                <has-error :form="form" field="nomor_hp"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input v-model="form.email" type="email" name="email" class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                <has-error :form="form" field="email"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Pekerjaan</label>
                                <!--select class="form-control" v-model="form.pekerjaan_id">
                                    <option v-for="(pekerjaan,index) in data_pekerjaan" :key="index" :value="index" :selected="index == form.pekerjaan_id">{{ pekerjaan }}</option>
                                </select-->
                                <b-form-select :options="data_pekerjaan" v-model="form.pekerjaan_id" placeholder="== Pilih Pekerjaan == "></b-form-select>
                                <has-error :form="form" field="pekerjaan_id"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Pendidikan Terakhir</label>
                                <!--select class="form-control" v-model="form.pendidikan_id">
                                    <option v-for="(pendidikan,index) in data_pendidikan" :key="index" :value="index" :selected="index == form.pendidikan_id">{{ pendidikan }}</option>
                                </select-->
                                <b-form-select :options="data_pendidikan" v-model="form.pendidikan_id" placeholder="== Pilih Pendidikan Terakhir == "></b-form-select>
                                <has-error :form="form" field="pendidikan_id"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Asrama</label>
                                <!--select class="form-control" v-model="form.asrama_id">
                                    <option v-for="(asrama,index) in data_asrama" :key="index" :value="index" :selected="index == form.asrama_id">{{ asrama }}</option>
                                </select-->
                                <b-form-select :options="data_asrama" v-model="form.asrama_id" placeholder="== Pilih Asrama == "></b-form-select>
                                <has-error :form="form" field="asrama_id"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Tahun Masuk</label>
                                <input v-model="form.tahun_masuk" type="text" name="tahun_masuk" class="form-control" :class="{ 'is-invalid': form.errors.has('tahun_masuk') }" placeholder="yyyy">
                                <has-error :form="form" field="tahun_masuk"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Tahun Keluar</label>
                                <input v-model="form.tahun_keluar" type="text" name="tahun_keluar" class="form-control" :class="{ 'is-invalid': form.errors.has('tahun_keluar') }" placeholder="yyyy">
                                <has-error :form="form" field="tahun_keluar"></has-error>
                            </div>
                            <!--div class="form-group">
                            <label>Tags</label>
                            <vue-tags-input
                              v-model="form.tag"
                              :tags="form.tags"
                              :autocomplete-items="filteredItems"
                              @tags-changed="newTags => form.tags = newTags"
                            />
                            <has-error :form="form" field="tags"></has-error>
                        </div-->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                            <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
</template>

<script>
//import VueTagsInput from '@johmun/vue-tags-input';
//import Datatable from 'datatables/Santri.vue' //IMPORT COMPONENT DATATABLENYA
import Datatable from './../components/datatable/Alumni.vue' //IMPORT COMPONENT DATATABLENYA
export default {
    components: {
        //VueTagsInput,
        'app-datatable': Datatable //REGISTER COMPONENT DATATABLE
    },
    data() {
        return {
            fields: [{
                    key: 'nama',
                    'label': 'Nama',
                    sortable: true
                },
                {
                    key: 'alamat',
                    'label': 'Alamat',
                    sortable: true
                },
                {
                    key: 'kabupaten',
                    'label': 'Kab/Kota',
                    sortable: true
                },
                {
                    key: 'tahun_masuk',
                    'label': 'Tahun Masuk',
                    sortable: true
                },
                {
                    key: 'tahun_keluar',
                    'label': 'Tahun Keluar',
                    sortable: true
                },
                {
                    key: 'actions',
                    'label': 'Aksi',
                    sortable: false
                }, //TAMBAHKAN CODE INI
            ],
            items: [], //DEFAULT VALUE DARI ITEMS ADALAH KOSONG
            meta: [], //JUGA BERLAKU UNTUK META
            current_page: 1, //DEFAULT PAGE YANG AKTIF ADA PAGE 1
            per_page: 10, //DEFAULT LOAD PERPAGE ADALAH 10
            search: '',
            sortBy: 'created_at', //DEFAULT SORTNYA ADALAH CREATED_AT
            sortByDesc: true, //ASCEDING
            editmode: false,
            data_jenis_kelamin: [{
                    'value': 'L',
                    'text': 'Laki-laki',
                },
                {
                    'value': 'P',
                    'text': 'Perempuan',
                }
            ],
            data_provinsi: [],
            data_kabupaten: [],
            data_kecamatan: [],
            data_desa: [],
            data_pekerjaan: [],
            data_pendidikan: [],
            data_asrama: [],
            //products : {},
            form: new Form({
                nama: '',
                nik: '',
                tempat_lahir: '',
                tanggal_lahir: '',
                jenis_kelamin: '',
                alamat: '',
                provinsi_id: '',
                kabupaten_id: '',
                kecamatan_id: '',
                desa_id: '',
                nomor_hp: '',
                email: '',
                pekerjaan_id: '',
                pendidikan_id: '',
                asrama_id: '',
                tahun_masuk: '',
                tahun_keluar: '',
            }),
            //categories: [],
            //tag:  '',
            //autocompleteItems: [],
        }
    },
    methods: {

        /*getResults(page = 1) {

            this.$Progress.start();

            axios.get('api/product?page=' + page).then(({ data }) => (this.products = data.data));

            this.$Progress.finish();
        },
        loadProducts(){

          // if(this.$gate.isAdmin()){
            axios.get("api/product").then(({ data }) => (this.products = data.data));
          // }
        },
        loadCategories(){
            axios.get("/api/category/list").then(({ data }) => (this.categories = data.data));
        },
        loadTags(){
            axios.get("/api/tag/list").then(response => {
                this.autocompleteItems = response.data.data.map(a => {
                    return { text: a.name, id: a.id };
                });
            }).catch(() => console.warn('Oh. Something went wrong'));
        },*/
        loadPostsData() {
            let current_page = this.search == '' ? this.current_page : 1
            //LAKUKAN REQUEST KE API UNTUK MENGAMBIL DATA POSTINGAN
            axios.get(`/api/alumni`, {
                    //KIRIMKAN PARAMETER BERUPA PAGE YANG SEDANG DILOAD, PENCARIAN, LOAD PERPAGE DAN SORTING.
                    params: {
                        page: current_page,
                        per_page: this.per_page,
                        q: this.search,
                        sortby: this.sortBy,
                        sortbydesc: this.sortByDesc ? 'DESC' : 'ASC'
                    }
                })
                .then((response) => {
                    //JIKA RESPONSENYA DITERIMA
                    let getData = response.data.data
                    this.items = getData.data //MAKA ASSIGN DATA POSTINGAN KE DALAM VARIABLE ITEMS
                    //DAN ASSIGN INFORMASI LAINNYA KE DALAM VARIABLE META
                    this.meta = {
                        total: getData.total,
                        current_page: getData.current_page,
                        per_page: getData.per_page,
                        from: getData.from,
                        to: getData.to,
                        isBusy: false,
                    }
                })
        },
        //JIKA ADA EMIT TERKAIT LOAD PERPAGE, MAKA FUNGSI INI AKAN DIJALANKAN
        handlePerPage(val) {
            this.per_page = val //SET PER_PAGE DENGAN VALUE YANG DIKIRIM DARI EMIT
            this.loadPostsData() //DAN REQUEST DATA BARU KE SERVER
        },
        //JIKA ADA EMIT PAGINATION YANG DIKIRIM, MAKA FUNGSI INI AKAN DIEKSEKUSI
        handlePagination(val) {
            this.current_page = val //SET CURRENT PAGE YANG AKTIF
            this.loadPostsData()
        },
        //JIKA ADA DATA PENCARIAN
        handleSearch(val) {
            this.search = val //SET VALUE PENCARIAN KE VARIABLE SEARCH
            this.loadPostsData() //REQUEST DATA BARU
        },
        //JIKA ADA EMIT SORT
        handleSort(val) {
            if (val.sortBy) {
                this.sortBy = val.sortBy
                this.sortByDesc = val.sortDesc

                this.loadPostsData() //DAN LOAD DATA BARU BERDASARKAN SORT
            }
        },
        editModal(product) {
            this.editmode = true;
            this.form.reset();
            $('#addNew').modal('show');
            this.form.fill(product);
        },
        newModal() {
            this.editmode = false;
            this.form.reset();
            $('#addNew').modal('show');
        },
        createSantri() {
            this.$Progress.start();

            this.form.post('api/santri')
                .then((data) => {
                    if (data.data.status === 'success') {
                        $('#addNew').modal('hide');

                        Toast.fire({
                            icon: 'success',
                            title: data.data.message
                        });
                        this.$Progress.finish();
                        this.loadProducts();

                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: 'Some error occured! Please try again'
                        });

                        this.$Progress.failed();
                    }
                })
                .catch((e) => {
                    console.log(e)
                    Toast.fire({
                        icon: 'error',
                        title: 'Some error occured! Please try again'
                    });
                })
        },
        /*
        updateProduct(){
            this.$Progress.start();
            this.form.put('api/product/'+this.form.id)
            .then((response) => {
                // success
                $('#addNew').modal('hide');
                Toast.fire({
                  icon: 'success',
                  title: response.data.message
                });
                this.$Progress.finish();
                    //  Fire.$emit('AfterCreate');

                this.loadProducts();
            })
            .catch(() => {
                this.$Progress.fail();
            });

        },
        deleteProduct(id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {

                    // Send request to the server
                      if (result.value) {
                            this.form.delete('api/product/'+id).then(()=>{
                                    Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                    );
                                // Fire.$emit('AfterCreate');
                                this.loadProducts();
                            }).catch((data)=> {
                                Swal.fire("Failed!", data.message, "warning");
                            });
                      }
                })
        },*/
        loadProvinsi() {
            axios.get("/api/get-provinsi").then(({
                data
            }) => (this.data_provinsi = data.data));
        },
        loadKabupaten() {
            axios.get("/api/get-kabupaten", {
                params: {
                    provinsi_id: this.form.provinsi_id,
                }
            }).then(({
                data
            }) => (this.data_kabupaten = data.data));
        },
        loadKecamatan() {
            axios.get("/api/get-kecamatan", {
                params: {
                    kabupaten_id: this.form.kabupaten_id,
                }
            }).then(({
                data
            }) => (this.data_kecamatan = data.data));
        },
        loadDesa() {
            axios.get("/api/get-desa", {
                params: {
                    kecamatan_id: this.form.kecamatan_id,
                }
            }).then(({
                data
            }) => (this.data_desa = data.data));
        },
        loadPekerjaan() {
            axios.get("/api/get-pekerjaan").then(({
                data
            }) => (this.data_pekerjaan = data.data));
        },
        loadPendidikan() {
            axios.get("/api/get-pendidikan").then(({
                data
            }) => (this.data_pendidikan = data.data));
        },
        loadAsrama() {
            axios.get("/api/get-asrama", {
                params: {
                    jenis_kelamin: this.form.jenis_kelamin,
                }
            }).then(({
                data
            }) => (this.data_asrama = data.data));
        },
    },
    mounted() {

    },
    created() {
        this.$Progress.start();
        this.loadPostsData();
        this.loadProvinsi();
        this.loadPekerjaan();
        this.loadPendidikan();
        this.loadAsrama();
        this.$Progress.finish();
        console.log(this.data_jenis_kelamin)
        console.log(this.data_provinsi)
    },
    filters: {
        truncate: function (text, length, suffix) {
            return text.substring(0, length) + suffix;
        },
    },
    computed: {
        filteredItems() {
            return this.autocompleteItems.filter(i => {
                return i.text.toLowerCase().indexOf(this.tag.toLowerCase()) !== -1;
            });
        },
    },
}
</script>
