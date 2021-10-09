import actions from "./tweet/actions"
import mutations from "./tweet/mutations"
export default {
    namespaced: true,

    state : {
        tweets : []
    },
    getters : {
        tweet (state) {
            return id => state.tweets.find(tweet => tweet.id == id);
        },
        parent(state) {
            return id => state.tweets.find(t => t.id != id )
        }, 
        someMethod(state){
            var self = this;
            return function (args) {
                return "hello";
               // return data from store with query on args and self as this
            }; 
        }
    },
    mutations,
    actions
}