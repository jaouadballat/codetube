<template>
    <div class="subscribe">
        {{ subscribers }} {{ subscribers > 1 ? 'Subscribers' : 'Subscriber' }} <button class="btn btn-default btn-sm" v-if="userCanSubscriber"
        @click="toggleSubscribe">
            {{ userSubscribed ? 'Unsubscribe' : 'Subscribe' }}
        </button>
    </div>
</template>

<script>
export default {
   props: ['channelSlug'],
    data() {
        return {
            subscribers: null,
            userCanSubscriber: null,
            userSubscribed: null,
        }
    },methods: {
        toggleSubscribe() {
            if(this.userSubscribed) {
                this.unsubscribe()
            }else {
                this.subscribe()
            }
        },
        subscribe() {
           
            axios.post(`/subscription/${this.channelSlug}`)
                .then(response => {
                     this.subscribers++;
                     this.userSubscribed = true;
                 });
        },
        unsubscribe() {
            
            axios.delete(`/subscription/${this.channelSlug}`)
                .then(response => {
                    this.subscribers--;
                    this.userSubscribed = false;
                 });
        }
    },
    created() {
        axios.get(`/subscription/${this.channelSlug}`)
            .then(({ data }) => {
               this.subscribers = data.count,
               this.userCanSubscriber = data.can_subscribed,
               this.userSubscribed = data.user_subscribed
            });
    }
}
</script>

