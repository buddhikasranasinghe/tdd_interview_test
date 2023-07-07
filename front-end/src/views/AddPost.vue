<template>
    <div class="m-4">
        <h1 class="text-center">Add A Post</h1>
        <div class="mt-2 h-100">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <form @submit.prevent="store"> 
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" placeholder="Title" v-model="form.title" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" rows="3" v-model="form.description" placeholder="Description" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="website">Website</label>
                                    <select class="form-control" id="website" v-model="form.website_id" required>
                                        <option v-for="(website, index) in website_list" :key="index" :value="website.id">{{ website.domain }}</option>
                                    </select>
                                </div>
                                <div class="row px-3 justify-content-end">
                                    <button type="submit" class="btn btn-success btn-sm">{{ button_text }}</button>
                                    <button type="button" class="btn btn-secondary btn-sm" @click="clearForm()">Clear</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import api from '@/services/api';

    export default {
        data() {
            return {
                website_list: [],
                form: {
                    title: '',
                    description: '',
                    website_id: ''
                },
                button_text: 'Post'
            }
        },
        mounted() {
            this.getWebsiteList();
        },
        methods: {
            async getWebsiteList() {
                const response = await api.get('websites')
                if (response.status == 200 && response.data.status == true) {
                    this.website_list = response.data.data.message
                }
            },
            async store() {
                this.button_text = 'Saving...'
                const response = await api.post('post', this.form)
                if (response.status == 201) {
                    alert(response.data.message)
                    this.clearForm()
                }
            },
            clearForm() {
                this.form = {
                    title: '',
                    description: '',
                    website_id: ''
                }
                this.button_text = 'Post'
            }
        },
    }
</script>

<style>
</style>
