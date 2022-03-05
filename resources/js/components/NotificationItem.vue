<template>
    <li class="scrollable-container media-list"><a class="d-flex justify-content-between" href="javascript:void(0)">
        <div class="media d-flex align-items-start">
            <div class="media-left"><i class="feather icon-plus-square font-medium-5 primary"></i></div>
            <div class="media-body">
                <h6 class="primary media-heading">You have new order!</h6> <a :href="dataUrl"> <small class="notification-text">{{unread.data['data']}}</small></a>
            </div>
        </div>
    </a>
    </li>


</template>

<script>

    export default {
        props:['unread'],
        data(){
            return{
                dataUrl:""
            }
        },
        mounted() {
            this.dataUrl="/dashboard/order"
        }
    }
</script>