class Errors {
    constructor() {
        this.listErrors = {};
    }

    has(field) {
        // if this.listerrors contains a "field" property
        return this.listErrors.hasOwnProperty(field);
    }

    any() {
        return Object.keys(this.listErrors).length > 0;
    }

    get(field) {
        if (this.listErrors[field]) {
            return this.listErrors[field][0];
        }
    }

    record(errors) {
        this.listErrors = errors;
    }

    clear(field) {
        if(field) {
            delete this.listErrors[field];
            return;
        }
        this.listErrors = {};
    }
}

class Form {
    constructor(data) {
        this.originalData = data; //this.data.name
        // { name : 'aoe'}
        for (let field in data) {
            this[field] = data[field];
        }
        this.errors = new Errors();
    }

    data() {
        let data = {};
        for (let property in this.originalData) {
            data[property] = this[property];
        }
        return data;
    }

    reset() {
        for (let field in this.originalData) {
            this[field] = '';
        }
        this.errors.clear();
    }

    post(url) {
        return this.submit('post', url);
    }

    delete(url) {
        return this.submit('delete', url);
    }

    submit(requestType, url) {
        return new Promise((resolve, reject) => {
            axios[requestType](url, this.data())
            .then(response => {
                this.onSuccess(response.data);
                resolve(response.data);
            })
            .catch(error => {
                this.onFail(error.response.data.errors);
                reject(error.response.data.errors);
            })
        });
    }

    onSuccess(data) {
        //temporary
        alert(data.message);
        this.reset;
    }

    onFail(errors) {
        this.errors.record(errors)
    }
}

new Vue({
    el: '#app',
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