<template>
    <div class="message">
        <div class="message-header">
            Push to the Stream..
        </div>
        <div class="message-body">
            <form @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">
                <p class="control">
                    <textarea class="textarea" name="body" placeholder="I have something to say" cols="30" rows="10" v-model="form.body"></textarea>
                    <span class="help is-danger" v-if="form.errors.has('body')" v-text="form.errors.get('body')"></span>
                </p>

                <p class="control">
                    <button class="button is-primary" :disabled="form.errors.any()">Submit</button>
                </p>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: new Form({
                body: ''
            })
        }
    },
    methods: {
        onSubmit() {
            this.form.post('/statuses').then(status => this.$emit('completed', status));
        }
    },
}
</script>