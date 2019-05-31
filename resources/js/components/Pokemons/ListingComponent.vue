<template>
    <div>
        <manage-pokemon></manage-pokemon>
        <sortable-pokemon></sortable-pokemon>
    </div>
</template>

<script>
import ManagePokemon from './Partials/ManagePokemon'
import SortablePokemon from './Partials/SortablePokemon'
export default {
    components:{
        ManagePokemon,
        SortablePokemon
    }
}
</script>

