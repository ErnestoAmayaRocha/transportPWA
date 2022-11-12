@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('Editar', ['name' => $usuarioss->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <usuarioss-form
                :action="'{{ $usuarioss->resource_url }}'"
                :data="{{ $usuarioss->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('Editar', ['name' => $usuarioss->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.usuarioss.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('Guardar') }}
                        </button>
                    </div>
                    
                </form>

        </usuarioss-form>

        </div>
    
</div>

@endsection