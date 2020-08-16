<template>
    <button type="submit" :class="classes" @click="toggle">
        <span>favorite</span>
        <span v-text="favoritesCount"></span>
    </button>
</template>

<script>
    export default {
        props: ['reply'],

        data() {
            return {
                favoritesCount: this.reply.favoritesCount,
                isFavorited: this.reply.isFavorited
            }
        },

        computed: {
            classes() {
                return this.isFavorited ? 'btn btn-primary' : 'btn btn-danger';
            },
            endpoint() {
                return '/replies/' + this.reply.id + '/favorites';
            }
        },

        methods: {
            toggle() {
                this.isFavorited ? this.destroy() : this.create();
            },

            destroy() {
                axios.delete(this.endpoint);

                this.isFavorited = false;
                this.favoritesCount--;
            },

            create() {
                axios.post(this.endpoint);

                this.isFavorited = true;
                this.favoritesCount++;
            }
        }
    }
</script>
