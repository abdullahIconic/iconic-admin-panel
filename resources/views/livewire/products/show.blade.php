@section('navbar')
    @livewire('layout.navbar', [
        'title' => $product->title,
        'parent' => 'Products',
        'parentRoute' => 'products',
        'page' => 'show',
    ])
@endsection

<div class="table-responsive-sm">
    <table class="table table-striped table-bordered align-middle">
        <tr>
            <th scope="col">Title</th>
            <td>{{$product->title}}</td>
        </tr>
        <tr>
            <th scope="col">Brand</th>
            <td>{{$product->brand->title ?? 'Not Exists'}}</td>
        </tr>
        <tr>
            <th scope="col">Category</th>
            <td>{{$product->category->title ?? 'Not Exists'}}</td>
        </tr>
        <tr>
            <th scope="col">Subcategory</th>
            <td>{{$product->subcategory->title ?? 'Not Exists'}}</td>
        </tr>
        <tr>
            <th scope="col">Is Visible</th>
            <td>{{$product->visible ? 'Yes' : 'No'}}</td>
        </tr>
        <tr>
            <th scope="col">Price</th>
            <td>{{$product->price}}</td>
        </tr>
        <tr>
            <th scope="col">Regular Price</th>
            <td>{{$product->regular_price}}</td>
        </tr>
        <tr>
            <th scope="col">Quantity</th>
            <td>{{$product->quantity}}</td>
        </tr>
        <tr>
            <th scope="col">Meta Title</th>
            <td>{!!$product->meta_title!!}</td>
        </tr>
        <tr>
            <th scope="col">Meta Description</th>
            <td>{!!$product->meta_description!!}</td>
        </tr>
        <tr>
            <th scope="col">Meta Keywords</th>
            <td>{!!$product->meta_keywords!!}</td>
        </tr>
        <tr>
            <th scope="col">Image</th>
            <td>
                <img src="{{asset('storage/' . $product->image_small)}}" alt="">
            </td>
        </tr>
        <tr>
            <th scope="col">Overview</th>
            <td>{!!$product->overview!!}</td>
        </tr>
        <tr>
            <th scope="col">Features</th>
            <td>{!!$product->features!!}</td>
        </tr>
        <tr>
            <th scope="col">Specifications</th>
            <td>{!!$product->specifications!!}</td>
        </tr>
        <tr>
            <th scope="col">Includes</th>
            <td>{!!$product->includes!!}</td>
        </tr>
        <tr>
            <th scope="col">Accessories</th>
            <td>{!!$product->accessories!!}</td>
        </tr>
    </table>
    <div class="">
        <button wire:click="delete" class="btn btn-dark mt-3 px-5" type="button">Delete</button>
    </div>
</div>