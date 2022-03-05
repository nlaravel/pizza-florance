<template>
    <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown" @click="markAsRead()">
        <i class="ficon feather icon-bell"></i><span class="badge badge-pill badge-primary badge-up">{{unreadNotification.length}}</span></a>
        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
            <li class="dropdown-menu-header">
                <div class="dropdown-header m-0 p-2">
                    <h3 class="white">{{unreadNotification.length}} New</h3><span class="notification-title">App Notifications</span>
                </div>
            </li>
            <notification-item v-for='unread in unreadNotification' :unread='unread' :key=''></notification-item>

        </ul>
    </li>

</template>

<script>
    import axios from 'axios';
    import NotificationItem from './NotificationItem.vue';
    export default {
        props:['unread','userid'],
        components:{NotificationItem},
        data(){
            return{
                unreadNotification: this.unread
            }
        },
        methods:{
            markAsRead() {
                if (this.unreadNotification.length) {
                    axios.get('/markAsRead');

                }
            }
        },
        mounted() {
            console.log('Component mounted.');
            Echo.private('App.User.' + this.userid)
                .notification((notification) => {
                    console.log(notification);
                    let newUnreadNotification={data:{data:notification.data},user:notification.user};
                    this.unreadNotification.push(newUnreadNotification);
                });
        }
    }
</script>
<style>

</style>