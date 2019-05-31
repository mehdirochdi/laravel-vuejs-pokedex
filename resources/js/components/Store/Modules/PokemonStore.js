import axios from 'axios'
const state = {
	params:{
		offset:0,
		limit: 10,
		search:'',
		type:''
	},
	pokemonsData:[], // LISTING PAGINATE
	total : 0, // TOTAL
	loadingSortable:false
}

const getters = {
	getParams: state => state.params,
	getPokemonsData	: state => state.pokemonsData,
	getTotal : state => state.total,
	getPage: state => state.page,
	getLoading : state => state.loadingSortable,
}

const mutations = {
	
	SET_STATE(state, value) {
		state.state = value
	},
	SET_PARAMS(state, value) {
		state.params = value
	},
	SET_PAGE(state, value) {
		state.page = value
	},
	SET_TOTAL(state, value) {
		state.total = value
	},
	SET_LOADING(state, value) {
		state.loadingSortable = value
	},
	SET_POKEMON_DATA(state, value) {
		state.pokemonsData = value
	},
	INVENTORY_BY_PARAMS(state, params) {
		state.params = params
		state.loadingSortable = true
		axios.get(route('pokemon.all', params)).then(({ data }) => {
				state.pokemonsData = data.results
				state.total = data.count
				state.loadingSortable = false
			}).catch(err => console.log('pokemon.all: ', err))
	}
}
const actions = {
	async getInventoriesParams({commit}, params) {
		await commit('INVENTORY_BY_PARAMS', params)
	}
}

export default{
	// namespaced: true,
	state:state,
	mutations:mutations,
	getters:getters,
	actions:actions,
}