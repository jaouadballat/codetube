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
		}
</script>