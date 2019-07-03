<template>
  <div class="app-container">
      <el-table v-loading="listLoading" :data="list" border fit highlight-current-row style="width: 100%">
      <el-table-column align="center" label="ID" width="80">
        <template slot-scope="scope">
          <span>{{ scope.row.id }}</span>
        </template>
      </el-table-column>
      <el-table-column min-width="300px" label="Title">
        <template slot-scope="{row}">
          <router-link :to="'/administrator/articles/edit/'+row.id" class="link-type">
            <span>{{ row.title }}</span>
          </router-link>
        </template>
      </el-table-column>
       <el-table-column min-width="150px" label="Amount">
        <template slot-scope="{row}">
         <span>{{ row.amount }}</span>
        </template>
      </el-table-column>
       <el-table-column min-width="150px" label="User create">
        <template slot-scope="{row}">
         <span>{{ row.assign_id }}</span>
        </template>
      </el-table-column>
       <el-table-column min-width="150px" label="Created by">
        <template slot-scope="{row}">
         <span>{{ row.created_at }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" label="Actions" width="300px">
        <template slot-scope="scope">
          <router-link :to="'/administrator/articles/edit/'+scope.row.id">
            <el-button type="primary" size="small" icon="el-icon-edit">
              Edit
            </el-button>
          </router-link>
          <router-link :to="'/administrator/articles/edit/'+scope.row.id">
            <el-button type="danger" size="small" icon="el-icon-edit">
              Delete
            </el-button>
          </router-link>
        </template>
      </el-table-column>
    </el-table>
    <pagination v-show="total>0" :total="total" :page.sync="listQuery.page" :limit.sync="listQuery.limit" @pagination="getList" />
  </div>
</template>

<script>
import Pagination from '@/components/Pagination'; // Secondary package based on el-pagination
import Resource from '@/api/resource';
const projectResource = new Resource('projects');

export default {
  name: 'Project',
  components: { Pagination },
  filters: {
    statusFilter(status) {
      const statusMap = {
        published: 'success',
        draft: 'info',
        deleted: 'danger',
      };
      return statusMap[status];
    },
  },
  data() {
    return {
      list: null,
      total: 0,
      listLoading: true,
      listQuery: {
        page: 1,
        limit: 20,
      },
    };
  },
  created() {
    this.getList();
  },
  methods: {
    async getList() {
      this.listLoading = true;
      const { data } = await projectResource.list(this.listQuery);
      this.list = data.items;
      this.total = data.total;
      this.listLoading = false;
      console.log(this.list);
    },
  },
};
</script>

<style scoped>
.edit-input {
  padding-right: 100px;
}
.cancel-btn {
  position: absolute;
  right: 15px;
  top: 10px;
}
</style>
