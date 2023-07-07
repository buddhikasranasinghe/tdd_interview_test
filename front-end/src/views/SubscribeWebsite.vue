<template>
    <div>
        <div class="m-4">
            <h1>Subscribe Any Website...</h1>
            <div class="mt-2 h-100">
                <div class="row">
                    <div class="col-auto" v-for="(website, index) in website_list" :key="index">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-success">{{ website.domain }}</h4>
                                <div class="row justify-content-end pr-3">
                                    <button class="btn btn-sm btn-primary" type="button" @click="openModal(website.id)">Subscribe</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <email-modal
            :is-active="modal_status"
            :toggleModal="closeModal"
            :email-error="from_error"
            :button-text="button_text"
            @email="subscribe"
        />
    </div>
</template>

<script>
import api from '@/services/api';
import EmailModal from '../components/EmailModel.vue'

    export default {
        components: {
            'email-modal': EmailModal
        },
        data() {
            return {
                website_list: [],
                modal_status: false,
                selected_website_id: '',
                from_error: '',
                button_text: 'Subscribe'
            }
        },
        mounted() {
            this.fetchWebsites()
        },
        methods: {
            async fetchWebsites() {
                const response = await api.get('websites')
                if (response.status == 200 && response.data.status == true) {
                    this.website_list = response.data.data.message
                }
            },
            openModal(website_id) {
                this.selected_website_id = website_id
                this.modal_status = !this.modal_status
            },
            closeModal() {
                this.modal_status = !this.modal_status
            },
            validateEmail(email) {
                const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return regex.test(email);
            },
            async subscribe(email) {
                let error = this.validateEmail(email)
                if (!error) {
                    this.from_error = 'Invalied Email'
                } else {
                    this.button_text = 'Subscribing...'
                    const response = await api.post('subscribe', {'website_id': this.selected_website_id, 'email': email})
                    if (response.status == 201) {
                        alert(response.data.message)
                        this.modal_status = false
                        this.button_text = 'Subscribe'
                    } else {
                        console.log(response.data)
                    }
                }
            },
        },
    }
</script>

<style>
</style>
