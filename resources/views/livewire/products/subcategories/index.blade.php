@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'List',
        'parent' => 'Subcategories',
        'parentRoute' => 'products.subcategories',
        'page' => 'index',
    ])
@endsection

<div>
    <div class="mb-3">
        Total {{ $totalSubcategories }} Subcategories
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
                    <th scope="col">Title</th>
                    <th scope="col">Visible</th>
                    <th scope="col">Products</th>
                    <th scope="col">Categories</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subcategories as $brand)
                <tr>
                    <td>{{$brand->title}}</td>
                    <td>{{$brand->visible ? "Yes" : "No"}}</td>
                    <td>{{$brand->products->count()}}</td>
                    <td>{{$brand->category->title}}</td>
                    <td>
                        <a href="{{route('products.subcategories.show', $brand->id)}}" class="btn bg-success text-white">View</a>
                        <a href="{{route('products.subcategories.edit', $brand->id)}}" class="btn bg-warning">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if( method_exists($subcategories,'links') )
            {{ $subcategories->links() }}
        @endif
    </div>
</div>