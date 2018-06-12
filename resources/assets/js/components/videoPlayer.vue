<template>
	

 <div>
 	<video
            id="video"
            class="video-js vjs-default-skin vjs-big-play-centered vjs-16-9"
            controls
            preload="auto"
            data-setup='{"fluid": true, "preload": "auto"}'
            :poster="videoThumbnail">
    <source :src="videoUrl" type='video/mp4' />
 </video>

 </div>



</template>

<script>
import videojs from 'video.js';
	export default {
		props: ['videoUid', 'videoUrl', 'videoThumbnail'],
		data() {
			return {
				duration:0
			}
		},

		methods: {
			hitView() {
				axios.post(`/video/${this.videoUid}/views`)
				.then(response => console.log(response))
			}
		},
		mounted() {
			let video = document.getElementById('video');
			video.onloadedmetadata = (e) => {
				this.duration = Math.round(video.duration)
			}

			setInterval(() => {
				if(!this.duration){
					return 0;
				}
				if(Math.round(Math.round(this.duration * 10 / 100)) === Math.round(video.currentTime)){
					this.hitView()
				}

			}, 1000)
		}
	}
</script>