import AppForm from '../app-components/Form/AppForm';

Vue.component('rutasroja-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                nombre_ruta:  '' ,
                costo:  '' ,
                
            }
        }
    }

});