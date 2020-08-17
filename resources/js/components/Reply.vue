<script>
    import Favorite from "./Favorite.vue";

    export default {
        props: ['data'],

        components: { Favorite },

        data() {
            return {
                editing: false,
                body: this.data.body
            };
        },

        methods: {
            update() {
                axios.patch('/replies/' + this.data.id, {
                    body: this.body
                });

                this.editing = false;

                flash('Reply has been updated!');
            },

            destroy() {
                axios.delete('/replies/' + this.data.id);

                $(this.$el).fadeOut(400, () => {
                    flash('Your reply has been deleted');
                });
            }
        }
    }
</script>
