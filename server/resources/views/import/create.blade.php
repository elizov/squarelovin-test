@extends('layouts.main')

@section('content')
    <form action="{{ route('import.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-heading">
            <h3 class="mb-0">{{ __('New import') }}</h3>
        </div>

        <div class="form-body">
            <input type="file" name="file">

            @if ($errors->has('file'))
                <span class="help-block">
                    <strong>{{ $errors->first('file') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-action">
            <button type="submit" class="btn btn-info">Submit</button>
        </div>

    </form>
@endsection
