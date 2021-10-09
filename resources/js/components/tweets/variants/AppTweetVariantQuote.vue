<template>
    <div class="flex w-full">
        <img :src="tweet.user.avatar" class="w-12 h-12 mr-3 rounded-full" />
        <div class="flex-grow">
            <app-tweet-username
                :user="tweet.user"
            />
            <p class="text-gray-300 whitespace-pre-wrap ">{{ tweet.body }}</p>
            <app-tweet
                class="border border-gray-800 rounded-lg mt-4"
                :tweet="tweet.original_tweet"
            />
            <app-tweet-action-group 
                :tweet="tweet"
            />
        </div>
    </div>
</template>
<script>
export default {
    data () {
        return {
        }
    },
    props : {
        tweet : {
            required : true,
            type : Object, 
        }
    }

}
</script>