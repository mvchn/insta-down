<template>
    <section class="text-center">
        <div class="container">
            <form @submit.prevent="postLink($data)">
                <div class="row">
                    <div class="col col-md-1"></div>
                    <div class="col col-md-8">
                        <input type="url" class="form-control form-control-lg" id="instLink"
                               placeholder="https://instagram.com/xxxxx"  v-model="instLink">
                    </div>
                    <div class="col col-md-2">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Go!</button>
                    </div>
                    <div class="col col-md-1"></div>
                </div>
            </form>
        </div>
        <br>
        <br>
        <div v-if="loading">
            Loading.....
        </div>
        <div class="container" v-if="downloadUrl">
            <a :href="downloadUrl" class="btn btn-success btn-lg">Download!</a>
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