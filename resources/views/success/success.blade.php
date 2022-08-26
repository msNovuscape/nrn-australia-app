@if(session()->has('success'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Success!</strong>  {{ session()->get('success') }}
        {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
    </div>
@endif

@if(session()->has('deleted'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong> Deleted!</strong>  {{ session()->get('deleted') }}
        {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
    </div>
@endif


@if(session()->has('validation_error'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Error!</strong>  {{ session()->get('validation_error') }}
        {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
    </div>
@endif

@if(session()->has('custom_errors'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Error!</strong>  {{ session()->get('success') }}
        {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
    </div>
@endif
@if(session()->has('error_message'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Error!</strong>  {{ session()->get('error_message') }}
        {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
    </div>
@endif
