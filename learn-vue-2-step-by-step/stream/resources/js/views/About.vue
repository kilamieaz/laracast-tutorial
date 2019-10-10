<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">About Component</div>
                    <br>
                    <div class="card-body">
                        <list :items="['one', 'two', 'three']">
                            <template slot="list-item" slot-scope="props">
                                <h2 class="title" v-text="props.data"></h2>
                            </template>
                        </list>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import List from '../components/List';
    export default {
        components: {
            List
        },
    }
</script>
