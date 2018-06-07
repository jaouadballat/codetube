<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Upload Video</div>

                    <div class="card-body">
                        <input type="file" name="video" class="form-control" 
                        @change="fileUploadChange" v-if="!uploading">
                        <div v-if="uploading && !failed">
                            Form
                        </div>
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
                uploadComplete: false,
                failed: false
            }
        },
        methods: {
            fileUploadChange() {
                console.log('file change')
                this.uploading = true;
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
