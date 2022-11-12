@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.rutasazule.actions.create'))

@section('body')

    <div class="container-xl">

                <div class="card">
        
        <rutasazule-form
            :action="'{{ url('admin/rutasazules') }}'"
            v-cloak
            inline-template>

            <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="action" novalidate>
                
                <div class="card-header">
                    <i class="fa fa-plus"></i> Nueva Ruta Azul
                </div>

                <div class="card-body">
                    @include('admin.rutasazule.components.form-elements')
                </div>
                                
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" :disabled="submiting">
                        <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                        Guardar
                    </button>
                </div>
                
            </form>

        </rutasazule-form>

        </div>

        </div>

    
@endsection