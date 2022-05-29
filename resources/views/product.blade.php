<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.css') }}">
    <script src="{{  asset('js/jet-js-by-wyl.js') }}"></script>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="form-group col-3">
                                    <label for="free_search" class="h6 fw-bold">Free Search</label>
                                    <input type="text" name="free_search" class="form-control" placeholder="free search" id="free_search">
                                </div>
                                <div class="form-group col-3">
                                    <label for="brand" class="h6 fw-bold">Brand</label>
                                    <select name="brand_id" id="brand" class="form-control" id="brand">
                                        <option value="">Search by brand</option>
                                        @foreach ($brands as $brand )
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-3">
                                    <label for="category" class="h6 fw-bold">Category</label>
                                    <select name="category_id" id="category" class="form-control" disabled>
                                        <option value="">Search by Category</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <span>
                                    <input type="hidden" name="sort_by_price" id="sort-by-price" value="desc">
                                    <button type="button" id="price"
                                        class="btn btn-primary d-inline text-capitalize">Filter price by desc</button>
                                </span>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <h6 class="fw-bold">Quantity</h6>
                                    <div class="form-check">
                                        <input class="form-check-input quantity" value="stock" type="radio" name="stock"
                                            id="stock" {{ request('stock') === 'stock' ? 'checked' : '' }} 
                                            @if (request('stock') === null)
                                                checked
                                            @endif
                                            >
                                        <label class="form-check-label" for="stock">
                                            Stock
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input quantity" value="unstock" type="radio"
                                            name="stock" id="unstock" {{ request('stock') === 'unstock' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="unstock">
                                            Unstock
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input quantity" value="both" type="radio" name="stock"
                                            id="both" {{ request('stock') === 'both' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="both">
                                            Both
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <h6 class="fw-bold">Status</h6>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="refurbish">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Refurbish
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="new" checked>
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Status
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success mt-3" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-0">
                        <table class="table table-striped mb-0">
                            <thead>
                                <th>No</th>
                                <th>Name</th>
                                <th>Brand</th>
                                <th>Category</th>
                            </thead>
                            <tbody>
                                @forelse ($products as $key => $product)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->brandCategory->brand->name }}</td>
                                    <td>{{ $product->brandCategory->category->name}}</td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%">No Data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('js/product.js') }}"></script>
</body>

</html>