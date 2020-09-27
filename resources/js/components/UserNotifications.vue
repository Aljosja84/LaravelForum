<template>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            Notifications
        </a>

        <ul class="dropdown-menu">
            <li v-for="notification in notifications">
                <a href="#">Blue</a>
            </li>
        </ul>
    </li>
</template>

<script>
    export default {
        name: "UserNotifications",

        data() {
            return {
                notifications: false
            }
        }
    }
</script>

<style scoped>

</style>
