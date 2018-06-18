<template>
    <div>
        <p>{{ comments.length }} {{ comments.length > 1 ? 'comments' : 'comment' }}</p>

        <div class="video-comment clearfix" v-if="$root.user.authenticated">
            <textarea class="form-control" v-model="body"></textarea>
            <button class="btn btn-default float-right mt-3" @click="createComment">Comment</button>
        </div>

        <div class="media mt-3" v-for="comment in comments" :key="comment.id">
            <a :href="`/channel/${comment.channel.slug}`">
                <img class="mr-3" v-bind:src="comment.channel.image">
            </a>
            <div class="media-body">
                <h5 class="mt-0">
                    {{ comment.channel.name }}
                </h5>
                {{ comment.body }}
                <div class="media mt-2" v-for="reply in comment.replies" :key="reply.id">
                    <a :href="`/channel/${reply.channel.slug}`">
                        <img class="mr-3" :src="reply.channel.image" >
                    </a>
                    <div class="media-body">
                        <h5 class="mt-0">{{ reply.channel.name }}</h5>
                            {{ reply.body }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['videoUid'],
    data() {
        return {
            comments: [],
            body: null
        }
    },
    mounted() {
        this.getComments();
    },
    methods: {
        getComments() {
            axios.get(`/video/${this.videoUid}/comment`)
                .then(response => {
                     this.comments = _.orderBy(response.data.data, 'created_at', 'desc')
                })
                
        },
        createComment() {
            axios.post(`/video/${this.videoUid}/comment`, {
                body: this.body
            }).then(response => {
                this.body = null;
                let {data} = response.data;
               this.comments.unshift(data);

            })
        }
    }
}
</script>
