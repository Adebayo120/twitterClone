<template>
<div>
    <div class="border-b-8 border-gray-800 p-4 w-full">
        <app-tweet-compose />
    </div>
    <app-tweet
        v-for="tweet in tweets"
        :key="tweet.id"
        :tweet="tweet"
    />
    <div
        v-if="tweets.length"
        v-observe-visibility ="{
            callback: handleScollToBottomTimeline
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
            tweets : 'timeline/tweets'
        }),
        urlOfTweetsToIncludeToPage () {
            return `/api/timeline?page=${this.page}`
        }
    },
    methods : {
        ...mapActions({
            getTweets : 'timeline/getTweets'
        }),

        ...mapMutations({
            PUSH_TWEETS : 'timeline/PUSH_TWEETS'
        }),

        handleScollToBottomTimeline (isVisible) {
            if (!isVisible) {
                return;
            }

            if( this.page == this.lastPage ) {
                return;
            }
            this.page++
            this.loadTweets();
        },

        loadTweets () {
            this.getTweets(this.urlOfTweetsToIncludeToPage).then( (response) => {
                this.lastPage = response.data.meta.last_page
            } )
        }
    },

    mounted () {
        this.loadTweets();
        Echo.private(`timeline.${this.$user.id}`)
            .listen('.TweetWasCreated', (e) => {
                this.PUSH_TWEETS([e]);
            })
    }
}
</script>