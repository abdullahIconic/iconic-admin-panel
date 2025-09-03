@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'Offer Products',
        'parent' => 'Offers',
        'parentRoute' => 'offers',
        'page' => 'products',
    ])
@endsection

<div>
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
                    <td>
                        @if($offer->products()->where('products.id', $product->id)->exists())
                        <button wire:click="detach({{$product->id}})" class="btn bg-danger text-white">Detach</button>
                        @else
                        <button wire:click="attach({{$product->id}})" class="btn bg-success text-white">Attach</button>
                        @endif
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