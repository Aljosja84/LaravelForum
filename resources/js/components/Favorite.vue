<template>
    <button type="submit" class="btn btn-outline-primary d-flex">
        <i class="material-icons mr-2 text-primary">favorite</i>
        <span v-text="favouritesCount"></span>
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
              return ['btn', this.isFavorited ? 'btn-primary' : 'btn-default'];
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
