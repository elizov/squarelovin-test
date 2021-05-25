@extends('layouts.main')

@section('content')

    {{ $products->links() }}

    <div class="row">
        @foreach ($products as $product)
            <div class="col-sm-4">
                <div class="card mt-4 mb-4">
                    <ul class="list-group list-group-flush">
                        @foreach ($product->productAttrubites as $attribute)
                            <li class="list-group-item">
                                {{ $attribute->name }}: {{ $attribute->pivot->value }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </div>

    {{ $products->links() }}

@endsection
