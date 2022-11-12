@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.rutaverde.actions.edit', ['name' => $rutaverde->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <rutaverde-form
                :action="'{{ $rutaverde->resource_url }}'"
                :data="{{ $rutaverde->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.rutaverde.actions.edit', ['name' => $rutaverde->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.rutaverde.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </rutaverde-form>

        </div>
    
</div>

@endsection