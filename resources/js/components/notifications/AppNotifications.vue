<template>
    <div>
        <app-notification
            v-for="notification in notifications"
            :key="notification.id"
            :notification="notification"
        />
        <div
            v-if="notifications.length"
            v-observe-visibility ="{
                callback: handleScollToBottomNotifications
            }"
        >
        </div>
    </div>
</template>
<script>
import { mapGetters, mapActions, mapMutations } from 'vuex'

export default {
    data () {
        return {
            page : 1,
            lastPage : 1
        }
    },
    computed : {
        ...mapGetters({
            notifications : 'notifications/notifications'
        }),
        urlOfNotificationsToIncludeToPage () {
            return `/api/notifications?page=${this.page}`
        }
    },
    methods : {
        ...mapActions({
            getNotifications : 'notifications/getNotifications'
        }),

        ...mapMutations({
            PUSH_NOTIFICATIONS : 'notifications/PUSH_NOTIFICATIONS'
        }),

        handleScollToBottomNotifications (isVisible) {
            if (!isVisible) {
                return;
            }

            if( this.page == this.lastPage ) {
                return;
            }
            this.page++
            this.loadNotifications();
        },

        loadNotifications () {
            this.getNotifications(this.urlOfNotificationsToIncludeToPage).then( (response) => {
                this.lastPage = response.data.meta.last_page
            } )
        },
    },
    mounted () {
        this.loadNotifications();
        // Echo.private(`timeline.${this.$user.id}`)
        //     .listen('.NotificationWasCreated', (e) => {
        //         this.PUSH_NOTIFICATIONS([e]);
        //     })
    }
}
</script>