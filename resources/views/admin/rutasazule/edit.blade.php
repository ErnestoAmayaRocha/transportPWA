@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.rutasazule.actions.edit', ['name' => $rutasazule->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <rutasazule-form
                :action="'{{ $rutasazule->resource_url }}'"
                :data="{{ $rutasazule->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('Editar', ['name' => $rutasazule->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.rutasazule.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('Guardar') }}
                        </button>
                    </div>
                    
                </form>

        </rutasazule-form>

        </div>
    
</div>

@endsection