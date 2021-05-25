@extends('layouts.main')

@section('content')
    <ul>
        <li>
            <a href="{{ route('import.create') }}">Import products from csv</a>
        </li>
        <li>
            <a href="{{ route('product.index') }}">Products</a>
        </li>
    </ul>
@endsection
