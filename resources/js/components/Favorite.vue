<template>
    <button type="submit" class="btn btn-primary" @click="toggle">
        <span class="glyphicon glyphicon-heart"></span>
        <span v-text="favoritesCount"></span>
    </button>
</template>

<script>
    export default {
        data() {
            return {
                favoritesCount: 10
            }
        },

        methods: {
            toggle() {
                
            }
        }
    }
</script>
