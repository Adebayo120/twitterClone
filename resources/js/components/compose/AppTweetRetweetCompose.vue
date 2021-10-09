<template>
    <form @submit.prevent="submit"> 
        <div class="flex">
            <img :src="$user.avatar" class="w-12 h-12 mr-3 rounded-full" />
            <div class="flex-grow">
                <app-tweet-compose-textarea 
                    v-model="form.body"
                    placeholder="Add a Comment"
                />

                <div class="flex justify-between">
                    <ul class="flex items-center">

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
                        Retweet
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
            quoteTweet : 'timeline/quoteTweet'
        } ),
        async post () {
            await this.quoteTweet( {
                tweet : this.tweet,
                data : this.form
            } )
            this.$emit('success')
        }
    }
}
</script>