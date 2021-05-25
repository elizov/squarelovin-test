@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ __('New import') }}</h5>

            <form action="{{ route('import.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

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
        </div>
    </div>
@endsection
