<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">About Component</div>
                    <br>
                    <div class="card-body">
                        <!-- <list :items="['one', 'two', 'three']">
                            <template slot="list-item" slot-scope="props">
                                <h2 class="title" v-text="props.data"></h2>
                            </template>
                        </list> -->
                        <carousel :autoplay="true">
                            <img src="http://placeimg.com/640/480/any">
                            <img src="http://placeimg.com/640/480/any?2">
                            <img src="http://placeimg.com/640/480/any?3">
                            <img src="http://placeimg.com/640/480/any?4">
                            <img src="http://placeimg.com/640/480/any?5">
                        </carousel>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import List from '../components/List';
    import Carousel from '../components/Carousel';
    export default {
        components: {
            List, Carousel
        },
    }
</script>
