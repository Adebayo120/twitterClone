<template>
    <div>
        <component 
            :is="`app-tweet-variant-${tweet.type}`"
            :tweet="tweet"
            class="mb-4"
        />
        <app-tweet-reply-compose
            v-if="tweet"
            :tweet="tweet"
            @success="$emit('close')"
        />
    </div>
</template>
<script>
export default {
    props : {
        tweet : {
            required : true,
            type : Object
        }
    }
}
</script>