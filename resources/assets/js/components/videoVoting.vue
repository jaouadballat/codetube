<template>
	
	<div class="voting">
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
				console.log('usrvoted null');
				if(type === 'up') {
					this.up++;
					this.userVote = 'up'
				}else {
					this.down++;
					this.userVote = 'down'
				}
				return;
			}
			if(this.userVote === type) {
				console.log('user voted == type');
				if(type === 'up') {
					this.up--;
					this.userVote = null;
				}else {
					this.down--;
					this.userVote = null;
				}
			}
			else {
				console.log('user voted !== type');
				if(type === 'up') {
					this.up++;
					this.down--;
					this.userVote = 'up'
				}else {
					this.down++;
					this.up--;
					this.userVote = 'down'
				}
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