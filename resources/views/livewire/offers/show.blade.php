@section('navbar')
    @livewire('layout.navbar', [
        'title' => $offer->title,
        'parent' => 'Offers',
        'parentRoute' => 'offers',
        'page' => 'show',
    ])
@endsection

<div class="table-responsive-sm">
    <table class="table table-striped table-bordered align-middle">
        <tr>
            <th scope="col">Regular Price</th>
            <td>{{$offer->regular_price}}</td>
        </tr>
        <tr>
            <th scope="col">Price</th>
            <td>{{$offer->price}}</td>
        </tr>
        <tr>
            <th scope="col">Discount</th>
            <td>{{$offer->discount}}</td>
        </tr>
        <tr>
            <th scope="col">Title</th>
            <td>{{$offer->title}}</td>
        </tr>
        <tr>
            <th scope="col">URL</th>
            <td>{{$offer->url}}</td>
        </tr>
        <tr>
            <th scope="col">Is Visible</th>
            <td>{{$offer->visible ? 'Yes' : 'No'}}</td>
        </tr>
        <tr>
            <th scope="col">Image</th>
            <td>
                <img src="{{asset('storage/' . $offer->image_medium)}}" alt="">
            </td>
        </tr>
        <tr>
            <th scope="col">Meta Title</th>
            <td>{{$offer->meta_title}}</td>
        </tr>
        <tr>
            <th scope="col">Meta Description</th>
            <td>{{$offer->meta_description}}</td>
        </tr>
        <tr>
            <th scope="col">Meta Keywords</th>
            <td>{{$offer->meta_keywords}}</td>
        </tr>
        <tr>
            <th scope="col">Products</th>
            <td>
                @foreach($offer->products as $product)
                <a href="{{route('products.show', $product->id)}}"><img height="50" src="{{asset('storage/'.$product->image_small)}}" alt="{{$product->title}}" title="{{$product->title}}"></a>
                @endforeach
            </td>
        </tr>
    </table>
    <div class="">
        <button wire:click="delete" class="btn btn-dark mt-3 px-5" type="button">Delete</button>
    </div>
</div>