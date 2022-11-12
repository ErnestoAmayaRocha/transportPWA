@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.rutasnaranja.actions.edit', ['name' => $rutasnaranja->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <rutasnaranja-form
                :action="'{{ $rutasnaranja->resource_url }}'"
                :data="{{ $rutasnaranja->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.rutasnaranja.actions.edit', ['name' => $rutasnaranja->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.rutasnaranja.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </rutasnaranja-form>

        </div>
    
</div>

@endsection