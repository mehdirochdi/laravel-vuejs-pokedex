
require('./bootstrap');
import HelperMixin from './components/Mixins/HelperMixin.js' // IMPORT GLOBALMIXIN
import store from'./components/Store' // MODULE STORE
import Vuetify from 'vuetify' // VUETIFY

Vue.use(Vuetify)
Vue.mixin(HelperMixin)

/*//////////////////////////////////////////////
                ALL COMPONENTS
//////////////////////////////////////////////*/
import HeaderComponent from './components/Layouts/HeaderComponent'
import ListingComponent from './components/Pokemons/ListingComponent'
import CollectionComponent from './components/Collections/CollectionComponent'
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#vue-app',
    store,
    components:{
        HeaderComponent,
        ListingComponent,
        CollectionComponent,
    }
});
