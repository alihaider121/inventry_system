@extends('app')

@section('content')

<h3>Create a Product</h3>
<main class="cotainer mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <h3 class="card-header text-center">Signup</h3>
                <div class="card-body">
                    <form action="{{ route('product.store') }}" method="POST" >
                        @csrf
                        <div class="form-group mb-2">
                            <input type="text" name="name" placeholder="Name" id="name" class="form-control">
                            @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <div class="form-group mb-2">
                            <input type="text" name="cost" placeholder="Cost" id="cost" class="form-control">
                            @if ($errors->has('cost'))
                            <span class="text-danger">{{ $errors->first('cost') }}</span>
                            @endif
                        </div>

                        <div class="form-group mb-2">
                            <input type="text" name="brand" placeholder="Company Name" id="brand" class="form-control">
                            @if ($errors->has('brand'))
                            <span class="text-danger">{{ $errors->first('brand') }}</span>
                            @endif
                        </div>

                        <div class="form-group mb-2">
                            <input type="text" name="price" placeholder="Price" id="price" class="form-control">
                            @if ($errors->has('price'))
                            <span class="text-danger">{{ $errors->first('price') }}</span>
                            @endif
                        </div>

                        <div class="form-group mb-2">
                            <input type="text" name="quantity" placeholder="Quantity" id="quantity" class="form-control">
                            @if ($errors->has('quantity'))
                            <span class="text-danger">{{ $errors->first('quantity') }}</span>
                            @endif
                         </div>



                        <div class="d-grid mx-auto">
                            <button type="submit" class="btn btn-primary btn-block">Add Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>


@yield('content')
@endsection
