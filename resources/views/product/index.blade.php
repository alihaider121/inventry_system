@extends('app')

@section('content')

<!DOCTYPE html>
<html>

<body>
    <div class="container mt-5">
        <table class="table table-bordered mb-5">
            <thead>
                <tr class="table-success">
                    <th scope="col">#</th>
                    <th scope="col">Name </th>
                    <th scope="col">Brand </th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($products) && $products->count())
                @foreach($products as $product)
                <tr>
                    <th scope="row">{{ $product->id }}</th>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->brand }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td> <a class="btn btn-sm btn-success" href="{{ url('products/edit', ['id' => $product->id]) }}"><i class="fa fa-edit"></i>Edit</a>
                        <form style="display:inline-block" action="{{ route('product.delete', ['id' => $product->id])}}" method="POST">
                            @method('delete')
                            @csrf
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> Delete</button>
                        </form>
                        <button type="button" id="showProduct" class="btn btn-sm btn-success" data-toggle="modal" data-target="#productShowModal" data-attr="{{ route('product.show', ['id' => $product->id]) }}" >Show Product</button>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="10">There are no data.</td>
                </tr>
            @endif
            </tbody>

            <!-- Modal Example Start-->
			<div class="modal fade" id="productShowModal" tabindex="-1" role="dialog" aria-
            labelledby="demoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modalBody">
                        <div>
                            <h1>Showing {{ $product->name }}</h1>

                            <div class="jumbotron text-center">
                                <h2>{{ $product->name }}</h2>
                                <p>
                                    <strong>Cost:</strong> {{ $product->cost }}<br>
                                    <strong>price:</strong> {{ $product->price }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </table>

        {{-- Pagination --}}
        <div>
            {!! $products->links() !!}
        </div>
    </div>
</body>

</html>


<script>
    // display a modal (small modal)
    $(document).on('click', '#showProduct', function(event) {
        event.preventDefault();
        let href = $(this).attr('data-attr');
        $.ajax({
            url: href,
            beforeSend: function() {
                $('#loader').show();
            },
            // return the result
            success: function(result) {
                // $('#productShowModal').modal("show");
                // $('#modalBody').html(result).show();
            },
            complete: function() {
                $('#loader').hide();
            },
            error: function(jqXHR, testStatus, error) {
                console.log(error);
                alert("Page " + href + " cannot open. Error:" + error);
                $('#loader').hide();
            },
            timeout: 8000
        })
    });

    </script>
@yield('content')
@endsection
