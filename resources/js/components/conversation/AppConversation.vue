<template>
    <div>
        <div>
            {{id}}
            {{parent(id)}}
            <!-- {{someMethod(id)}} -->
        </div>
        <div class="text-lg border-b-8 border-t-8 border-gray-800">
            <!-- <app-tweet
                :tweet="tweet(id)"
            /> -->
            {{tweet(id)}}
        </div>
        <div>
            replies
        </div>
    </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex"
export default {
    props : {
        id : {
            required : true,
            type : String
        }
    },
    data () {
        return {
            ...mapGetters( {
                tweet : "notifications/tweet",
                parent : 'notifications/parent',
                someMethod : "conversation/someMethod",
            } )
        }
    },
    methods : {
        ...mapActions({
            getTweets : "conversation/getTweets"
        })
    },
    mounted () {
        this.getTweets(`/api/tweets/${this.id}`)
    }
}
</script>