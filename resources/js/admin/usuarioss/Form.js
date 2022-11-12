import AppForm from '../app-components/Form/AppForm';

Vue.component('usuarioss-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                nombre:  '' ,
                correo:  '' ,
                telefono:  '' ,
                password:  '' ,
                
            }
        }
    }

});