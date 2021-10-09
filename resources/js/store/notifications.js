import Axios from "axios";
import getters from "./tweet/getters"
import mutations from "./tweet/mutations"
import actions from "./tweet/actions"

export default {
    namespaced : true,

    state : {
        tweets : [],
        notifications : [],
    },
    getters : {
        ...getters,
        notifications (state) {
            return state.notifications
        },
        tweetFromNotifications (state) {
            return state.notifications.map( n => n.data.tweet.id );
        }
    },
    mutations : {
        ...mutations,
        PUSH_NOTIFICATIONS (state, data) {
            state.notifications.push(...data);
        }
    },
    actions : {
        ...actions,

        async getNotifications ( { commit, dispatch, getters },url ) {
           let response = await Axios.get(url);

           commit('PUSH_NOTIFICATIONS', response.data.data);

           dispatch('getTweets', `api/tweet?ids=${getters.tweetFromNotifications.join(',')}`)
           return response;
        }
    }
}