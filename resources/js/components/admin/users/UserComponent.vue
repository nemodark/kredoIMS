<template>
<div>

    <div class="card shadow mt-5">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of all Registered Users <router-link to="/admin/users/create"
                    class="btn btn-primary btn-sm float-right">Add
                    User</router-link></h6>
        </div>
        <div class="card-body">
                <div v-show="loading" class="text-center text-primary">
                    <i class="fas fa-circle-notch fa-spin fa-2x"></i>
                </div>
            <div class="table-responsive" v-show="content">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users" :key="user.id">
                            <td>{{ user.id }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.role }}</td>
                            <td><router-link :to="{name: 'admin.editUser', params: {id: user.id}}" class="btn btn-info">Edit</router-link></td>
                        </tr>
                    </tbody>
                </table>

                <!-- <mdb-datatable
                :data="data"
                striped
                bordered
                arrows
                :display="3"
                /> -->
            </div>
        </div>
    </div>
</div>
</template>

<script>
    import { mdbDatatable, mdbContainer } from 'mdbvue';
  export default {
    components: {
      mdbDatatable,
      mdbContainer
    },
        data() {
            return {
                users: [],
                columns: [],
                rows: [],
                loading: false,
                content: true,
            }
        },
        computed: {
            data() {
                return {
                columns: this.columns,
                rows: this.rows
                };
            },
        },
        created() {
            this.loading = true;
            this.content = false;
            let uri = "http://kredoims.test/api/users";
            this.axios.get(uri).then(response => {
                this.content = true;
                this.loading = false;
                this.users = response.data.data;
                let keys = ["id", "email", "role"];
                let entries = this.filterData(this.users, keys);
                //columns
                this.columns = keys.map(key => {
                    return {
                    label: key.toUpperCase(),
                    field: key,
                    sort: 'asc'
                    };
                });
                //rows
                entries.map(entry => this.rows.push(entry));
            })
        },
        methods: {
            filterData(dataArr, keys) {
                let data = dataArr.map(entry => {
                let filteredEntry = {};
                keys.forEach(key => {
                    if (key in entry) {
                    filteredEntry[key] = entry[key];
                    }
                });
                return filteredEntry;
                });
                return data;
            }
        },
    }

</script>
