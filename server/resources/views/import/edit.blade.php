@extends('layouts.main')

@section('content')
    <form action="{{ route('import.update', $import) }}" method="POST">
        @method('PATCH')
        @csrf

        <div class="form-heading">
            <h3 class="mb-0">{{ __('Import confirmation') }}</h3>
        </div>

        <div class="form-body">
            @foreach ($import->mapping as $field)
                <div class="mapping-item form-group row mb-1">
                    <label for="input-{{ $field }}" class="col-sm-2 col-form-label col-form-label-sm">
                        {{ $field }}
                    </label>
                    <div class="col-sm-9">
                        <input
                            type="text"
                            class="form-control form-control-sm"
                            id="input-{{ $field }}"
                            name="{{ $field }}"
                            value="{{ $field }}"
                        />

                        @if ($errors->has($field))
                            <span class="help-block">
                                <strong>{{ $errors->first($field) }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-1">
                        <button
                            type="button"
                            class="btn btn-danger btn-sm"
                            data-action="remove-mapping">Del</button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="form-action">
            <button type="submit" class="btn btn-info">Confirm</button>
        </div>

    </form>

    <script>
        $(document)
            .on('click', '[data-action="remove-mapping"]', function () {
                if (confirm('Are you sure?')) {
                    $(this).closest('.mapping-item').remove();
                }
            })
        ;
    </script>
@endsection
