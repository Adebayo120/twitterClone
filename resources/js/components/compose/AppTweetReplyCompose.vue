<template>
    <form @submit.prevent="submit"> 
        <div class="flex">
            <img :src="$user.avatar" class="w-12 h-12 mr-3 rounded-full" />
            <div class="flex-grow">
                <app-tweet-compose-textarea 
                    v-model="form.body"
                    placeholder='Tweet Your Reply'
                />
                <app-tweet-media-progress
                    class="mb-4"
                    :progress="media.progress"
                    v-if="media.progress"
                />
                <app-tweet-image-preview
                    :images="media.images"
                    v-if="media.images.length"
                    @removed="removeImage"
                />

                <app-tweet-video-preview
                    :video="media.video"
                    v-if="media.video"
                    @removed="removeVideo"
                />

                <div class="flex justify-between">
                    <ul class="flex items-center">
                        <li class="mr-4">
                            <app-tweet-compose-media-button
                                id="media-compose-reply"
                                @selected="handleMediaSelected"
                            />
                        </li>
                    </ul>
                    <div class="flex items-center justify-end">
                        <app-tweet-compose-limit 
                            class="mr-2"
                            :body="form.body"
                        />
                        <button
                        type="submit"
                        class="bg-blue-500 rounded-full text-gray-300 text-center px-4 py-3 font-bold leading-none"
                        >
                        Reply
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>
<script>
import compose from '../../mixins/compose'
import Axios from 'axios'
import { mapActions } from 'vuex'
export default {
    props : {
        tweet : {
            required : true,
            type : Object
        }
    },
    mixins : [
        compose
    ],
    methods : {
        ...mapActions ( {
            replyToTweet : 'timeline/replyToTweet'
        } ),
        async post () {
            await this.replyToTweet( {
                tweet : this.tweet,
                data : this.form
            } )
            this.$emit('success')
        }
    }
}
</script>