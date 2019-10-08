<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

    </head>
    <body>
        <div id="app">
                {{-- <li v-for="skill in skills" v-text="skill"></li> --}}
                {{-- <input type="text" v-model="coupon"> --}}
                {{-- <input type="text" :value="coupon" @input="coupon = $event.target.value"> --}}
            <coupon v-model="coupon"></coupon>
        </div>
        {{-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> --}}
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.js"></script> --}}
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
