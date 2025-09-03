@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'List',
        'parent' => 'Products',
        'parentRoute' => 'products',
        'page' => 'index',
    ])
@endsection

<div>
    <div class="mb-3">
        Total {{ $totalProducts }} Product(s)
    </div>
    <div class="table-responsive-sm">
        <div class="d-flex gap-5 mb-3">
            <div class="d-flex align-items-center">
                <label for="qty" class="me-2">Items:</label>
                <div>
                    <input wire:model="qty" type="text" class="form-control" id="qty">
                </div>
            </div>
            <div class="d-flex align-items-center">
                <label for="searech" class="me-2">Search:</label>
                <div>
                    <input wire:model="keyword" type="text" class="form-control" id="searech" placeholder="Title">
                </div>
            </div>
        </div>
        <table class="table table-striped table-bordered align-middle">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Category</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>
                        <img height="50" src="{{asset('storage/'.$product->image_small)}}" alt="">
                    </td>
                    <td>{{$product->title}}</td>
                    <td>{{$product->brand->title ?? 'Not Exists'}}</td>
                    <td>{{$product->category->title}}</td>
                    <td>
                        <a href="{{route('products.show', $product->id)}}" class="btn bg-success text-white">View</a>
                        <a href="{{route('products.edit', $product->id)}}" class="btn bg-warning">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if( method_exists($products,'links') )
            {{ $products->links() }}
        @endif
    </div>
</div>