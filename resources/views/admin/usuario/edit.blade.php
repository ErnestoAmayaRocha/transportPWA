@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.usuario.actions.edit', ['name' => $usuario->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <usuario-form
                :action="'{{ $usuario->resource_url }}'"
                :data="{{ $usuario->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.usuario.actions.edit', ['name' => $usuario->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.usuario.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </usuario-form>

        </div>
    
</div>

@endsection