<template>
  <div>
    <v-dialog
      v-model="dialog"
      hide-overlay
      persistent
      width="300">
      <v-card color="primary" dark>
        <v-card-text>
          Please stand by
          <v-progress-linear
            indeterminate
            color="white"
            class="mb-0"
          ></v-progress-linear>
        </v-card-text>
      </v-card>
    </v-dialog>
    <v-snackbar
      :color="snackbarColor"
      v-model="snackbar"
      :timeout="6000"
      top="top">
      {{ snackbarText }}
      <v-btn flat @click="snackbar = false"> Close </v-btn>
    </v-snackbar>
    <v-card>
       <v-container grid-list-md text-xs-center>
        <v-layout row wrap>
            <v-flex xs10 >
              <v-layout>
                <v-flex xs7>
                  <v-card-title>
                    <v-spacer></v-spacer>
                    <v-text-field
                      v-model="search"
                      @keyup.enter="onSearch"
                      append-icon="search"
                      label="Search pokemon by name or id"
                      single-line
                      hide-details>
                    </v-text-field>
                  </v-card-title>
                </v-flex>
                <v-flex xs5>
                  <v-card-title>
                    <v-spacer></v-spacer>
                    <v-text-field
                      v-model="type"
                      @keyup.enter="onSearchType"
                      append-icon="search"
                      label="Search pokemon by type"
                      single-line
                      hide-details>
                    </v-text-field>
                  </v-card-title>
                </v-flex>
              </v-layout>
            </v-flex>
        </v-layout>
       </v-container>
      <v-data-table
        :headers="headers"
        :items="getPokemonsData"
        :pagination.sync="pagination"
        :total-items="getTotalQuery"
        :rows-per-page-items="rowsPerPageItems"
        :loading="getLoading"
        class="elevation-1">
        <template v-slot:items="props">
          <td class="text-xs-center">{{ props.item.id }}</td>
          <td class="text-xs-center">
            <v-img :src="props.item.sprites.front_default" aspect-ratio="3" contain>
              <template v-slot:placeholder>
                  <v-layout
                    fill-height
                    align-center
                    justify-center
                    ma-0>
                    <v-progress-circular indeterminate color="lighten-5"></v-progress-circular>
                  </v-layout>
                </template>
            </v-img>
            
          </td>
          <td class="text-xs-center">{{ props.item.name }}</td>
          <td class="text-xs-center">{{ props.item.weight }}</td>
          <td class="text-xs-center">
            <v-tooltip top v-if="props.item.isCatched">
              <template v-slot:activator="{ on }">
                <a v-on="on" href="" @click.prevent=""> <v-img :src="asset('images/pokeball_black.png')" aspect-ratio="4.7" contain> </v-img> </a>
              </template>
              <span>Catched</span>
            </v-tooltip>
            <v-tooltip top v-else>
              <template v-slot:activator="{ on }">
                <a v-on="on" href="" @click.prevent="onCatch(props.item)"> <v-img :src="asset('images/pokeball.png')" aspect-ratio="4.7" contain> </v-img> </a>
              </template>
              <span>Catche me</span>
            </v-tooltip>
            </td>
        </template>
      </v-data-table>
    </v-card>
  </div>
</template>

<script>
  import { mapGetters, mapMutations, mapActions } from 'vuex'
  export default {
    data:()=>({
      dialog: false,
      snackbar: false,
      snackbarText:'',
      snackbarColor:'',
      search:'',
      type:'',
      headers: [
        { text: 'ID',value: 'id', sortable: true, align: 'center', class:"cols-1"},
        { text: 'POKEMON',value: 'pokemon', sortable: true, align: 'center'},
        { text: 'NAME',value: 'name', sortable: true, align: 'center'},
        { text: 'WEIGHT',value: 'weight', sortable: false, align: 'center'},
        { text: 'Actions', value: 'actions', sortable: false, align: 'center' }
	    ],
      rowsPerPageItems: [10, 20, 40, 60, 100],
      pagination: {},
    }),
    computed:{
      ...mapGetters([ 'getPokemonsData', 'getTotal', 'getLoading']),
      getTotalQuery() {
        return this.getTotal
      }
    },
    watch: {
      pagination() {
        this.getInventoriesPaginateSortable()
      },
      dialog (val) {
        if (!val) return
        setTimeout(() => (this.dialog = false), 4000)
      }
    },
    methods:{
			...mapActions(['getInventoriesParams']),
      getInventoriesPaginateSortable() {
				this.getInventoriesParams({
          offset:(this.pagination.page > 1) ? (this.pagination.page - 1) * this.pagination.rowsPerPage : 0,
          limit:this.pagination.rowsPerPage,
          search:this.search,
          type:this.type
				})
      },
      onCatch(item) {
        let params = {
          id:item.id,
          name:item.name
        }
        this.dialog = true
        axios.post(route('collection.store'), params).then(res => {
          let text = res.data.hasOwnProperty('error') ? res.data.error : "mistake adding this pokemon !!!"
          let color = res.data.hasOwnProperty('error') ? 'info' : 'error'
          
          if(res.data.statut) {
            text = "this pokemon was successfully caught"
            color = "success"
          }

          this.dialog = false
          // DISPLAY SNACKBAR
          this.snackbar = true
          this.snackbarText = text
          this.snackbarColor = color
        }).catch(err => {
          console.log('err', err)
        })
        .finally(() => this.dialog = false);
      },
      onSearch() {
        this.getInventoriesPaginateSortable()
      },
      onSearchType() {
        this.getInventoriesPaginateSortable()
      }
    }
  }
</script>