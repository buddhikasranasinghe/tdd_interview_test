<template>
    <div v-if="isActive">
        <div class="modal d-block modal-bg" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-group mb-0">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" v-model="entred_email" required>
                            <small id="emailHelp" class="form-text text-danger">{{ emailError }}</small>
                        </div>
                        <div class="row px-3 justify-content-end">
                            <button type="button" class="btn btn-success btn-sm" @click="store()">{{ buttonText }}</button>
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" @click="toggleModal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</template>

<script>
export default {
    props: {
        isActive: {
            type: Boolean,
            default: false
        },
        toggleModal: {
            type: Function,
            required: true
        },
        emailError: {
            type: String,
            default: ''
        },
        buttonText: {
            type: String,
            default: 'Subscribe'
        }
    },
    data() {
        return {
            entred_email: ''
        }
    },
    methods: {
        store() {
            this.$emit('email', this.entred_email)
        }
    },
}
</script>

<style scoped>
.modal-bg {
    background-color: rgba(0, 0, 0, 0.5);
}
</style>
