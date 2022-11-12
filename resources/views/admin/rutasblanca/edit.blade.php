@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.rutasblanca.actions.edit', ['name' => $rutasblanca->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <rutasblanca-form
                :action="'{{ $rutasblanca->resource_url }}'"
                :data="{{ $rutasblanca->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.rutasblanca.actions.edit', ['name' => $rutasblanca->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.rutasblanca.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </rutasblanca-form>

        </div>
    
</div>

@endsection