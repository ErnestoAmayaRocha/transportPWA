@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.rutasnaranjass.actions.edit', ['name' => $rutasnaranjass->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <rutasnaranjass-form
                :action="'{{ $rutasnaranjass->resource_url }}'"
                :data="{{ $rutasnaranjass->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.rutasnaranjass.actions.edit', ['name' => $rutasnaranjass->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.rutasnaranjass.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </rutasnaranjass-form>

        </div>
    
</div>

@endsection