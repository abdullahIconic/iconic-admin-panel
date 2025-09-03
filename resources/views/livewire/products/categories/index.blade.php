@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'List',
        'parent' => 'Categories',
        'parentRoute' => 'products.categories',
        'page' => 'index',
    ])
@endsection

<div>
    <div class="mb-3">
        Total {{ $totalCategories }} Categories
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
                    <th scope="col">Visible</th>
                    <th scope="col">Products</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>
                        <img height="50" src="{{ asset('storage/' . $category->image_small_1) }}" alt="">
                    </td>
                    <td>{{$category->title}}</td>
                    <td>{{$category->visible ? "Yes" : "No"}}</td>
                    <td>{{$category->products->count()}}</td>
                    <td>
                        <a href="{{route('products.categories.show', $category->id)}}" class="btn bg-success text-white">View</a>
                        <a href="{{route('products.categories.edit', $category->id)}}" class="btn bg-warning">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if( method_exists($categories,'links') )
            {{ $categories->links() }}
        @endif
    </div>
</div>