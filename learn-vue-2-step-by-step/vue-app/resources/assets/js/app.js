import Vue from 'vue';
import axios from 'axios';
import Form from './core/Form';
import Example from './components/Example';

window.Form = Form;
window.axios = axios;

new Vue({
    el: '#app',
    components: {
        Example
    },
    data:{
        form: new Form({
            name:'',
            description:''
        })
    },
    methods: {
        onSubmit() {
            this.form.post('/projects')
            .then(data => console.log(data))
            .catch(errors => console.log(errors));
        }
    },
})