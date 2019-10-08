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
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';
    import Status from '../models/Status';

    export default {
        data() {
            return {
                statuses: []
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
