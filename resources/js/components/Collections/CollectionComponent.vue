<template>
  <div>
    <v-snackbar
      :color="snackbarColor"
      v-model="snackbar"
      :timeout="6000"
      top="top">
      {{ snackbarText }}
      <v-btn flat @click="snackbar = false"> Close </v-btn>
    </v-snackbar>
    <v-data-table
      :headers="headers"
      :items="getPokemonsData"
      :pagination.sync="pagination"
      :total-items="getTotal"
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
        <td class="text-xs-center">{{ props.item.base_experience }}</td>
        <td class="text-xs-center"><a href="" @click.prevent="onUnCatch(props.item)"> <v-img :src="asset('images/pokeball_black.png')" aspect-ratio="4.7" contain> </v-img> </a></td>
      </template>
    </v-data-table>
  </div>
</template>

<script>
  import { mapGetters, mapMutations, mapActions } from 'vuex'
  export default {
    data:()=>({
      snackbar: false,
      snackbarText:'',
      snackbarColor:'',
      headers: [
        { text: 'ID',value: 'id', sortable: true, align: 'center', class:"cols-1"},
        { text: 'POKEMON',value: 'pokemon', sortable: true, align: 'center'},
        { text: 'NAME',value: 'name', sortable: true, align: 'center'},
        { text: 'WEIGHT',value: 'weight', sortable: false, align: 'center'},
        { text: 'EXPERIENCE',value: 'experience', sortable: false, align: 'center'},
        { text: 'Actions', value: 'actions', sortable: false, align: 'center' }
	    ],
      rowsPerPageItems: [10, 20, 40, 60, 100],
      pagination: {},
    }),
    computed:{
      ...mapGetters([ 'getPokemonsData', 'getTotal', 'getLoading', 'getParams']),
    },
    watch: {
      pagination() {
        this.getInventoriesPaginateSortable()
      }
    },
    methods:{
        ...mapMutations(['SET_POKEMON_DATA', 'SET_TOTAL', 'SET_LOADING']),
        getInventoriesPaginateSortable() {
            let params = {
                page:this.pagination.page,
                limit:this.pagination.rowsPerPage,
            }
            this.SET_LOADING(true)
            axios.post(route('collection.all', params),).then(({ data }) => {
                console.log(data)
                    this.SET_POKEMON_DATA(data.results)
                    this.SET_TOTAL(data.total)
                    this.SET_LOADING(false)
                }).catch(err => console.log('collection.all: ', err))
            // this.getInventoriesParams({
            //     offset:(this.pagination.page > 1) ? (this.pagination.page - 1) * this.pagination.rowsPerPage : 0,
            //     limit:this.pagination.rowsPerPage,
            //     keyword:''
            // })
        },
        onUnCatch(item) {
            let params = {
                id:item.id,
                name:item.name
            }
            axios.delete(route('collection.destroy'), {id:item.id}).then(res => {
                console.log()
                let text = "mistake remove this pokemon from your collection !!!"
                let color = 'error'
                
                if(res.data.statut) {
                    text = "this pokemon was successfully removed from your collection"
                    color = "success"
                }

                // DISPLAY SNACKBAR
                this.snackbar = true
                this.snackbarText = text
                this.snackbarColor = color
            }).catch(err => {
                console.log('err', err)
            })
        },
    }
}
</script>