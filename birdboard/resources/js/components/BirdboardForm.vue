class BirdboardForm {
    constructor(data) {
        this.originalData = JSON.parse(JSON.stringify(data));

        // this.data = data;
        Object.assign(this, data);

        this.errors = {};
        this.submitted = false;
    }

    data() {
        // let data = {};

        // for (let attribute in this.originalData) {
        //     data[attribute] = this[attribute]
        // }
        // return data;

        return Object.keys(this.originalData).reduce((data, attribute) => {
            data[attribute] = this[attribute];

            return data;
        }, {});
    }

    post(endpoint) {
        return this.submit(endpoint);
    }

    patch(endpoint) {
        return this.submit(endpoint, 'patch');
    }

    delete(endpoint) {
        return this.submit(endpoint, 'delete');
    }

    submit(endpoint) {
        return axios.post(endpoint, this)
            .catch(this.onFail.bind(this))
            .then(this.onSuccess.bind(this));
    }

    onFail(error) {
        this.errors = error.response.data.errors;
        this.submitted = true;
        throw error;
    }

    onSuccess(response) {
        this.submitted = true;
        this.errors = {};
        return response;
    }

    reset() {
        Object.assign(this, this.originalData);
    }
}

export default BirdboardForm;