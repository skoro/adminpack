<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#{{ $modalId }}">
    {{ __('Delete') }}
</button>

{{-- As the modal contains the form for the Delete action --}}
{{-- it must be in the footer section to avoid conflicts with other forms. --}}
@section('footer')
    
    @parent

    <div id="{{ $modalId }}" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ $title }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    {{ $slot }}
                </div>

                <div class="modal-footer">

                    <form action="{{ $action }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                            {{ __('No') }}
                        </button>

                        <button type="submit" class="btn btn-danger" >
                            {{ __('Delete') }}
                        </button>

                    </form>

                </div>

            </div>
        </div>
    </div>
@endsection
