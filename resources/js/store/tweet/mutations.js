import { get } from "lodash"
export default {
    PUSH_TWEETS ( state, data ) {
        state.tweets.push(
            ...data.filter( ( tweet ) => {
                return !state.tweets.map( ( stateTweet ) => stateTweet.id ).includes( tweet.id );
            })
        )
    },
    POP_TWEET ( state, id ) {
        state.tweets = state.tweets.filter( ( tweet ) => {
            return tweet.id != id;
        })
    },
    SET_LIKES ( state, { id, count } ) {
        state.tweets = state.tweets.map( ( tweet ) => {
            if (id == tweet.id) {
                tweet.likes_count = count;
            }
            if ( get( tweet.original_tweet, "id" ) == id ) {
                tweet.original_tweet.likes_count = count;
            }
            return tweet;
        })
    },
    SET_RETWEETS ( state, { id, count } ) {
        state.tweets = state.tweets.map( ( tweet ) => {
            if (id == tweet.id) {
                tweet.retweets_count = count;
            }
            if ( get( tweet.original_tweet, "id" ) == id ) {
                tweet.original_tweet.retweets_count = count;
            }
            return tweet;
        })
    },
    SET_REPLIES ( state, { id, count } ) {
        state.tweets = state.tweets.map( ( tweet ) => {
            if (id == tweet.id) {
                tweet.replies_count = count;
            }
            if ( get( tweet.original_tweet, "id" ) == id ) {
                tweet.original_tweet.replies_count = count;
            }
            return tweet;
        })
    }
}