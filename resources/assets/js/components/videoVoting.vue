<template>
	
	<div class="voting" v-if="canVote">
		<a href="" class="voting-up mr-2" :class="{voted: userVote == 'up'}" @click.prevent="vote('up')">
			<span class="fa fa-thumbs-up" ></span>{{ up }}
		</a>
		<a href="" class="voting-down" :class="{voted: userVote == 'down'}" @click.prevent="vote('down')">
			<span class="fa fa-thumbs-down" ></span>{{ down }}
		</a>
	</div>

</template>

<script>
export default {
	props : ['videoUid'],
	data() {
		return {
			up: null,
			down: null,
			userVote: null,
			canVote: false,
		}
	},
	mounted() {
		this.getVotes();
	},
	methods: {
		vote(type) {
			if(!this.userVote){
				this[type]++;
				this.userVote = type;
				this.creatVote(type)
				return;
			}
			if(this.userVote === type) {
				this[type]--;
				this.userVote = null;
				this.deleteVote();
			}
			else {
				this[type === 'up' ? 'down' : 'up']--;
				this[type]++;
				this.userVote = type;
				this.deleteVote();
				this.creatVote(type);

			}
		},
		getVotes() {
			axios.get(`/video/${this.videoUid}/votes`)
			.then(response => response.data.data)
			.then(data => {
				this.up = data.up,
				this.down = data.down,
				this.userVote = data.user_vote,
				this.canVote = data.can_vote
			});
		},
		creatVote(type) {
			axios.post(`/video/${this.videoUid}/votes`, {
				type: type
			});
		},
		deleteVote() {
			axios.delete(`/video/${this.videoUid}/votes`);
		}
	}

}
</script>

<style>
 .voting a{
 	color: #212529;
 }

 .voted,.voting a:hover, focus {
 	text-decoration: none;
 	color: #007bff !important;
 }
</style>