
import actions from "./tweet/actions"
import getters from "./tweet/getters"
import mutations from "./tweet/mutations"
export default {
    namespaced: true,
    state: {
        tweets: []
    },

    getters,
    mutations,
    actions
}