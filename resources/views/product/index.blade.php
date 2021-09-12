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
                <tr class="data-row">
                    <th scope="row" class="id">{{ $product->id }}</th>
                    <td class="name">{{ $product->name }}</td>
                    <td  class="brand">{{ $product->brand }}</td>
                    <td class="quantity">{{ $product->quantity }}</td>
                    <td> <button type="button"  id="editProduct" class="btn btn-sm btn-success" data-toggle="modal" data-target="#productEditModal" data-attr="{{ route('product.edit', ['id' => $product->id]) }}" data-item-id="{{ $product->id}}"> <i class="fa fa-edit"></i>Edit</button>
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

            <!-- Modal Show Product-->
			<div class="modal fade" id="productShowModal" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
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

                    <!-- Modal Edit Product-->
			<div class="modal fade" id="productEditModal" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        {{-- <div class="modal-body" id="modalBody"> --}}
                            <form id="productData" class="form-horizontal" action="{{ route('product.update',['id'=> $product->id]) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="card text-white bg-dark mb-0">
                                    <div class="card-header">
                                      <h2 class="m-0">Edit</h2>
                                    </div>
                                    <div class="card-body">
                                      <!-- id -->
                                      <div class="form-group">
                                        <label class="col-form-label" for="modal-input-id">Id (just for reference not meant to be shown to the general public) </label>
                                        <input type="text" name="id" readonly class="form-control" id="id" required>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-form-label" for="modal-input-name">Name</label>
                                        <input type="text" name="name" class="form-control" id="name" required autofocus>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-form-label" for="modal-input-brand">Brand</label>
                                        <input type="text" name="brand" class="form-control" id="brand" required>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-form-label" for="modal-input-quantity">Quantity</label>
                                        <input type="text" name="quantity" class="form-control" id="quantity" required>
                                      </div>
                                    </div>

                                  </div>
                                   <div class="modal-footer">


                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="submit" class="btn btn-primary" >Done</button>

                                </div>
                                {{-- <input type="submit" value="Submit" id="submit" class="btn btn-sm btn-success" style="font-size: 0.8em;"> --}}

                           </form>
                        {{-- </div> --}}
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


    $(document).on('click', "#editProduct", function() {
    $(this).addClass('edit-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

    var options = {
      'backdrop': 'static'
    };
    $('#productEditModal').modal(options)
  })

    $('#productEditModal').on('show.bs.modal', function() {
    var el = $(".edit-item-trigger-clicked"); // See how its usefull right here?
    var row = el.closest(".data-row");
    // console.log(row.children,el.data);

    // get the data
    var id = el.data('item-id');
    var name = row.children(".name").text();
    var brand = row.children(".brand").text();
    var quantity= row.children(".quantity").text();
    // var cost= row.children(".cost").text();
    // // var price= row.children("price").text();
    // console.log(cost);

    // fill the data in the input fields
    $("#id").val(id);
    $("#name").val(name);
    $("#brand").val(brand);
    $("#quantity").val(quantity);


  })

  // on modal hide
  $('#productEditModal').on('hide.bs.modal', function() {
    $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
    $("#productData").trigger("reset");
  })


    </script>
@yield('content')
@endsection
