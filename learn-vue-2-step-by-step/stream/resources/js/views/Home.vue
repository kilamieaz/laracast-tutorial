<template>
    <div class="container">
        <div class="columns">
            <div class="column">
                <div class="message" v-for="status in statuses" :key="status.id">
                    <div class="message-header">
                        <p>
                            {{ status.user.name }} said
                        </p>
                        <p>
                            {{ status.created_at | ago | capitalize}}
                        </p>
                    </div>

                    <div class="message-body" v-text="status.body"></div>
                </div>
                <add-to-stream @completed="addStatus"></add-to-stream>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';
    import Status from '../models/Status';
    import AddToStream from '../components/AddToStream';

    export default {
        // this view has following child components
        components: {
            AddToStream
        },
        data() {
            return {
                statuses: []
            }
        },
        methods: {
            addStatus(status) {
                this.statuses.unshift(status);
                alert('Your status has been added to the stream.');
                window.scrollTo(0, 0);
            }
        },
        filters: {
            ago(date) {
                return moment(date).fromNow();
            },
            capitalize(value) {
                return value.toUpperCase();
            }
        },
        created() {
            Status.all()
            .then(({data}) => this.statuses = data);
        }
    }
</script>
