<template>
        <div :id="'reply-'+id" class="card">
            <div class="card-header">
                <div class="level">
                    <h6 class="flex">
                        <a :href="'/profiles/'+data.owner.name"
                           v-text="data.owner.name">
                        </a> said {{ data.created_at }}...
                    </h6>

                    <div>
                        <favorite :reply="data"></favorite>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <div v-if="editing">
                    <div class="form-group">
                        <textarea class="form-control" v-model="body"></textarea>
                    </div>

                    <button class="btn btn-xs btn-primary" @click="update">Update</button>
                    <button class="btn btn-xs btn-link" @click="editing = false">Cancel</button>
                </div>

                <div v-else v-text="body"></div>
            </div>

           <!-- @can('destroy', $reply)
            <div class="panel-footer">
                <div class="card-header level">
                    <button class="btn btn-xs mr-1" @click="editing = true">Edit</button>
                    <button class="btn btn-danger btn-xs" @click="destroy">Delete</button>

                </div>
            </div>
            @endcan
            -->
        </div>
</template>
<script>
    import Favorite from "./Favorite.vue";

    export default {
        props: ['data'],

        components: {Favorite},

        data() {
            return {
                editing: false,
                id: this.data.id,
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

                this.$emit('deleted', this.data.id);
            }
        }
    }
</script>
