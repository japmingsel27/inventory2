@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">

                    <div class="card-header">
                        <nav class="navbar navbar-expand-lg">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page"
                                            href="{{ route('products.index') }}">Products</a>
                                    </li>
                                </ul>
                            </div>

                        </nav>
                    </div>

                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseOne" aria-expanded="false"
                                        aria-controls="flush-collapseOne">
                                        Add Product
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <form method="POST" action="{{ route('products.addProduct') }}">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="pname" class="form-label">Product Name</label>
                                                <input type="text" class="form-control" name='pname' id="pname"
                                                    aria-describedby="emailHelp">
                                            </div>
                                            <div class="mb-3">
                                                <label for="desc" class="form-label">Description</label>
                                                <input type="text" class="form-control" name='desc' id="desc"
                                                    aria-describedby="emailHelp">
                                            </div>
                                            <div class="mb-3">
                                                <label for="unit" class="form-label">Unit</label>
                                                <input type="text" class="form-control" name='unit' id="unit"
                                                    aria-describedby="emailHelp">
                                            </div>
                                            <div class="mb-3">
                                                <label for="price" class="form-label">Price</label>
                                                <input type="text" class="form-control" name='price' id="price"
                                                    aria-describedby="emailHelp">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-header">Products</div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Description</th>
                                    <th>Unit</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr id="{{ $product->id }}">
                                        <td id="tpname">{{ $product->pname }}</td>
                                        <td id="tdesc">{{ $product->description }}</td>
                                        <td id="tunit">{{ $product->unit }}</td>
                                        <td id="tprice">{{ $product->price }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onclick="setForm('{{ $product->id }}','{{ $product->pname }}','{{ $product->description }}','{{ $product->unit }}', '{{ $product->price }}')">
                                                Update
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteProduct" onclick="deleteProductCOnf('{{ $product->id }}')">
                                                delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br>

    </div>


<!-- Button trigger modal -->

  
  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Update Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            @csrf
                <div class="mb-3">
                    <label for="pid" class="form-label">ID</label>
                    <input type="text" class="form-control" name='epid' id="epid"
                        aria-describedby="emailHelp" readonly>
                </div>
                <div class="mb-3">
                    <label for="epname" class="form-label">Product Name</label>
                    <input type="text" class="form-control" name='epname' id="epname"
                        aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="edesc" class="form-label">Description</label>
                    <input type="text" class="form-control" name='edesc' id="edesc"
                        aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="eunit" class="form-label">Unit</label>
                    <input type="text" class="form-control" name='eunit' id="eunit"
                        aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="eprice" class="form-label">Price</label>
                    <input type="text" class="form-control" name='eprice' id="eprice"
                        aria-describedby="emailHelp">
                </div>
                <button type="submit" class="btn btn-primary" id="saveEdit">Submit</button>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeModal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="deleteProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Confirm Delete</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type='hidden' id="pidfordelete" />
            <h4>Are you surer you want to delete product?</h4>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="proceedDelete()">Proceed</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="closeModalConf">Cancel</button>
        </div>
      </div>
    </div>
  </div>
@endsection
