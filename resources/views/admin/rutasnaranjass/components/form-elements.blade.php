<div class="form-group row align-items-center" :class="{'has-danger': errors.has('nombre_ruta'), 'has-success': fields.nombre_ruta && fields.nombre_ruta.valid }">
    <label for="nombre_ruta" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.rutasnaranjass.columns.nombre_ruta') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.nombre_ruta" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('nombre_ruta'), 'form-control-success': fields.nombre_ruta && fields.nombre_ruta.valid}" id="nombre_ruta" name="nombre_ruta" placeholder="{{ trans('admin.rutasnaranjass.columns.nombre_ruta') }}">
        <div v-if="errors.has('nombre_ruta')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('nombre_ruta') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('costo'), 'has-success': fields.costo && fields.costo.valid }">
    <label for="costo" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.rutasnaranjass.columns.costo') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.costo" v-validate="'required|decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('costo'), 'form-control-success': fields.costo && fields.costo.valid}" id="costo" name="costo" placeholder="{{ trans('admin.rutasnaranjass.columns.costo') }}">
        <div v-if="errors.has('costo')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('costo') }}</div>
    </div>
</div>


