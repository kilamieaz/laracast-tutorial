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

export default Errors;