@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Products Variants ({{ $product->name }})</h1>
        </div>

        <div>
            <a href="{{ route('admin.product.index') }}" class="btn btn-primary my-3">Go Back</a>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Create Product Variants</h4>

                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.product-variant.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" name="name" id="" class="form-control">
                                        <input type="hidden" value="{{ $product->id }}" name="product_id">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Price</label>
                                        <input type="text" name="price" id="" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card card-primary">

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product->variants as $option)
                                    <tr>
                                        <td>{{ ++$loop->index }}</td>
                                        <td>{{ $option->name }}</td>
                                        <td>{{ $option->price }}</td>
                                        <td>
                                            <a href='{{ route('admin.product-variant.destroy', $option->id) }}'
                                                class='btn btn-danger delete-item mx-2'><i class='fas fa-trash'></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                @if (count($product->variants) === 0)
                                    <tr>
                                        <td colspan='3' class="text-center">No data found!</td>

                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>

    </section>
@endsection
