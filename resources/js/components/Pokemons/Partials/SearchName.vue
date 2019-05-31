<template>
    <v-card-title>
        <v-spacer></v-spacer>
        <v-text-field
            v-model="value"
            @keyup.enter="onSearch"
            append-icon="search"
            label="Search pokemon by name or id"
            single-line
            hide-details>
        </v-text-field>
    </v-card-title>
</template>
<script>
export default {
    methods:{
        onSearch() {
        this.getInventoriesPaginateSortable()
      },
    }
}
</script>

