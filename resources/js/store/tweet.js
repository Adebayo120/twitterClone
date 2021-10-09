import axios from "axios"

export default {
    namespaced: true,
    state: {
        tweets: []
    },

    getters: {
        tweets ( state ) {
            return state.tweets
        }
    },

    mutations: {
        PUSH_TWEETS (state, data) {
            state.tweets.push(...data)
        }
    },

    actions: {
       async storeTweet ({ commit }, data) {
            let response = await axios.post(url);
            commit('PUSH_TWEETS', response.data.data)
            return response;
        }
    }
}