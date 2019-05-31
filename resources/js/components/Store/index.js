import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import PokemonStore from './Modules/PokemonStore.js'
//const debug = process.env.NODE_ENV !== 'production'

Vue.use(Vuex)

let store = new Vuex.Store({
	modules: {
    	PokemonStore
  	},
  	strict:false
})

global.store = store

export default store