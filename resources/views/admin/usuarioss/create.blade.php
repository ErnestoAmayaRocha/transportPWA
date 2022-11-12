@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('Nuevo Usuario'))

@section('body')

    <div class="container-xl">

                <div class="card">
        
        <usuarioss-form
            :action="'{{ url('admin/usuariosses') }}'"
            v-cloak
            inline-template>

            <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="action" novalidate>
                
                <div class="card-header">
                    <i class="fa fa-plus"></i> {{ trans('Nuevo Usuario') }}
                </div>

                <div class="card-body">
                    @include('admin.usuarioss.components.form-elements')
                </div>
                                
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" :disabled="submiting">
                        <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                        {{ trans('Guadar') }}
                    </button>
                </div>
                
            </form>

        </usuarioss-form>

        </div>

        </div>

    
@endsection