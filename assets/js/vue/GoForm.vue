<template>
    <section class="text-center">
        <div class="container">
            <form @submit.prevent="postLink($data)">
                <div class="row  justify-content-md-center">
                    <div class="col col-md-8">
                        <input type="url" class="form-control form-control-lg" id="instLink"
                               placeholder="https://instagram.com/xxxxx"  v-model="instLink">
                    </div>
                    <div class="col col-md-2">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Go!</button>
                    </div>
                </div>
            </form>
        </div>
        <br>
        <br>
        <div v-if="downloadUrl" class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-3">
                    <a :href="downloadUrl" class="btn btn-success btn-lg btn-block">
                        <i class="fas fa-download"></i>&nbsp;&nbsp;<b>Download!</b></a>
                </div>
            </div>
        </div>
        <div class="container" v-else-if="loading">
            <div class="row justify-content-md-center">
                <div class="col-md-2">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%" aria-valuenow="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import axios from 'axios';
    
    export default {
        data: () => ({
            instLink: null,
            downloadUrl: null,
            loading: false
        }),
        methods: {
            postLink() {
                var formData = new FormData();
                formData.append("url", this.instLink);
                this.loading = true;
                this.downloadUrl = null;
                axios.post('/get-link',
                    formData
                )
                .then(response => {
                    this.downloadUrl = response.data.link;
                })
                .catch(e => {
                    this.errors.push(e);
                })
                .finally(() => (this.loading = false));
            }
        }
    }
</script>