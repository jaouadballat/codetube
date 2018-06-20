<template>
    <div>
        <p>{{ comments.length }} {{ comments.length > 1 ? 'comments' : 'comment' }}</p>

        <div class="video-comment clearfix" v-if="$root.user.authenticated">
            <textarea class="form-control" v-model="body"></textarea>
            <button class="btn btn-default float-right mt-3" @click="createComment">Comment</button>
        </div>

        <div class="media mt-3" v-for="(comment, index) in comments" :key="comment.id">
            
            <a :href="`/channel/${comment.channel.slug}`">
                <img class="mr-3" v-bind:src="comment.channel.image">
            </a>
            <div class="media-body">
                <h5 class="mt-0">
                    {{ comment.channel.name }} 
                    <span class="ml-5 font-weight-light">{{ comment.created_at_human }}</span>
                </h5>
                {{ comment.body }} <br>

                 <a href="#" @click.prevent="replayComment(comment.id)"
                 v-if="$root.user.authenticated">{{ commentId !== comment.id ? 'Replay' : 'Cancel' }}</a>
                
                <a class="ml-3" href="#" @click.prevent="deleteComment(comment.id, index)"
                 v-if="$root.user.id === comment.user_id">Delete</a>

                 <div class="media mt-2" v-if="commentId === comment.id">
                    <div class="media-body">
                        <textarea class="form-control" v-model="replay"></textarea>
                        <button class="btn btn-default btn-sm mt-2 float-right"
                         @click="addReplay(index)">Replay</button>
                    </div>
                </div>
                <div class="media mt-2" v-for="(replay, Rindex) in comment.replies" :key="replay.id">
                    <a :href="`/channel/${replay.channel.slug}`">
                        <img class="mr-3" :src="replay.channel.image" >
                    </a>
                    <div class="media-body">
                        <h5 class="mt-0">{{ replay.channel.name }}
                            <span class="ml-3 font-weight-light">{{ replay.created_at_forHumain }}</span>
                        </h5>
                        
                            {{ replay.body }} <br>
                        <a class="ml-3" href="#" @click.prevent="deleteReplay(comment.id,replay.id, index,Rindex)"
                        v-if="$root.user.id === replay.user_id">Delete</a>
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
            body: null,
            replay: null,
            commentId: null
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
        },
        replayComment(id) {
            this.replay = null;
            this.commentId === id ? this.commentId = null : this.commentId = id;
        },
        addReplay(index) {
            axios.post(`/comments/${this.commentId}/replay`, {
                body: this.replay
            }).then(response => {
                 this.comments[index].replies.push(response.data.data)
                 this.replay = null;
            });
        },
        deleteComment(id, index) {           
            axios.delete(`/comments/${id}/delete`)
                .then(() => {
                    this.comments.splice(index, 1)
                });
        },
        deleteReplay(commentId, replayId,commentIndex, replayIndex) {
            axios.delete(`/comments/${commentId}/replay/${replayId}`)
                .then(() => {
                     this.comments[commentIndex].replies.splice(replayIndex, 1)
                });
        }
    }
}
</script>

<style>
a:hover {
    text-decoration: none;
}
</style>

