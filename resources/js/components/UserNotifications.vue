<template>
    <li class="nav-item dropdown" v-if="notifications.length">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <span class="fa fa-bell"></span>
        </a>

        <ul class="dropdown-menu">
            <li v-for="notification in notifications">
                <a class="nav-link" :href="notification.data.link" v-text="notification.data.message" @click.prevent="markAsRead(notification)"></a>
            </li>
        </ul>
    </li>
</template>

<script>
    export default {
        data() {
            return {
                notifications: false,
            }
        },

        props: ['link'],

        created() {
            axios.get('/profiles/' + this.link + '/notifications')
                .then(response => this.notifications = response.data);

            this.link = 'Frank';
        },

        methods: {
            markAsRead(notification) {
                axios.delete('/profiles/' + this.link + '/notifications/' + notification.id)
            }
        }
    }
</script>

<style scoped>

</style>
