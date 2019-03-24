<template>
    <section class="text-center">
        <div class="container">
            <form @submit.prevent="checkForm">
                <div class="row  justify-content-md-center">
                    <div class="col col-md-8">
                        <input type="url" class="form-control form-control-lg" required id="instLink"
                               placeholder="https://www.instagram.com/p/BsOGulcndj-/"  v-model="instLink">
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
                    <i class="fa fa-spinner fa-spin fa-3x fa-fw margin-bottom"></i>
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
        <div class="container" v-if="errors.length">
            <div class="row justify-content-md-center">
                <div class="col col-md-8">
                    <div class="alert alert-dismissible fade show"
                         v-bind:class="{ 'alert-warning': error.code === 400, 'alert-danger': error.code === 500 }"
                         role="alert" v-for="error in errors">
                        <strong>{{ error.message }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
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
            loading: false,
            errors: []
        }),
        methods: {
            checkForm: function (e) {
                e.preventDefault();
                this.downloadUrl = null;
                this.errors = [];
                var formData = new FormData();
                formData.append("url", this.instLink);
                console.log(this.instLink);
                if (!this.validUri(this.instLink)) {
                    this.errors.push({'code': 400, 'message' : 'Bad Instagram url'});
                } else {
                    this.loading = true;
                    axios.post('/get-link',
                        formData
                    )
                    .then(response => {
                        console.log(response.data);
                        this.downloadUrl = response.data.result;
                    })
                    .catch(e => {
                        this.errors.push({'code' :e.response.data.error.code, 'message':e.response.data.error.message});
                        console.log(e.response);
                    })
                    .finally(() => (this.loading = false));
                }
            },
            validUri: function (uri) {
                var re = /(https?:\/\/www\.)?instagram\.com(\/p\/\w+\/?)/;
                return re.test(uri);
            }
        }
    }
</script>