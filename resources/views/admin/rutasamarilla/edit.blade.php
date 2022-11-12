@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.rutasamarilla.actions.edit', ['name' => $rutasamarilla->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <rutasamarilla-form
                :action="'{{ $rutasamarilla->resource_url }}'"
                :data="{{ $rutasamarilla->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.rutasamarilla.actions.edit', ['name' => $rutasamarilla->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.rutasamarilla.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </rutasamarilla-form>

        </div>
    
</div>

@endsection