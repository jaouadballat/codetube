<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Upload Video</div>

                    <div class="card-body">

                    <div class="alert alert-danger" v-if="failed">Somthing goes wrong here</div>
                    
                    <div class="alert alert-info" v-if="uploading && !uploadingComplete">
                        Your video will be availlable at {{ $root.url + uid  }}
                    </div>
                    <div class="alert alert-info" v-if="uploadingComplete">
                        Uploading complete. <a :href="$root.url+'videos/'+uid">Check you video</a>
                    </div>

                        <div class="progress mb-2" v-if="uploading && !uploadingComplete">
                          <div class="progress-bar" role="progressbar" :style="{width: fileProgress + '%' }" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <input type="file" name="video" id="video" class="form-control" 
                        @change="fileUploadChange" v-if="!uploading">
                        <form v-if="uploading && !failed" enctype="multipart/form-data">

                            <div class="form-group">
                                <label>Tile: </label>
                                <input type="text" class="form-control" v-model="title">
                            </div>

                            <div class="form-group">
                                <label>Description: </label>
                              <textarea class="form-control" v-model="description"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Visibility: </label>
                                <select v-model="visibility" class="form-control">
                                    <option value="private">Private</option>
                                    <option value="unlisted">Unlisted</option>
                                    <option value="public">Public</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Video Thumbnail:</label>
                                <input type="file" name="video_thumbnail" id="video_thumbnail" class="form-control">
                            </div>

                            <input type="submit" value="Update" class="btn btn-default" @click.prevent = "update">
                            <span class="hfont-weight-light float-right">{{ saveStatus }}</span>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                uploading: false,
                uploadingComplete: false,
                failed: false,
                title: 'untitled',
                visibility: 'private',
                description:null,
                file: '',
                uid: '',
                fileProgress: 0,
                saveStatus: null,
                video_thumbnail: ''
            }
        },
        methods: {
            fileUploadChange() {

                this.uploading = true;
                this.file = document.getElementById('video').files[0];
                this.store();
            },

            store() {
                axios.post('/video', {

                    title: this.title,
                    visibility: this.visibility,
                    extension: this.file.name.split('.').pop()
 
                }).then(response => {
                    this.uid = response.data.uid
                }).then(() => {
                    let form = new FormData();
                    form.append('video', this.file)
                    form.append('uid', this.uid)

                    axios.post('/upload', form, {
                        onUploadProgress : (e) =>{
                            this.fileProgress = e.loaded * 100 / e.total;
                        }
                    }).then(() => this.uploadingComplete = true)
                      .catch(error => this.failed = true)
               
                }).catch(error => this.failed = true)
            },
            update() {
                this.saveStatus = 'Saving Changes';
                this.video_thumbnail = document.getElementById('video_thumbnail').files[0];
                let formData = new FormData();
                formData.append('title', this.title)
                formData.append('description', this.description)
                formData.append('visibility', this.visibility)
                formData.append('visibility', this.visibility)
                formData.append('video_thumbnail', this.video_thumbnail)
                
                axios.post(`/video/${this.uid}`, formData)
                .then(response => {
                        this.saveStatus = 'Changes Saved'
                        
                        setTimeout(() => {
                            this.saveStatus = null;
                        }, 3000);



                    }).catch(error => {
                        this.saveStatus = 'Changes Saved Failed'
                    })
            }
        },
        mounted() {
        }
    }
</script>
