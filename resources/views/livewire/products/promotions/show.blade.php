@section('navbar')
    @livewire('layout.navbar', [
        'title' => $promotion->title,
        'parent' => 'Product Promotions',
        'parentRoute' => 'products.promotions',
        'page' => 'show',
    ])
@endsection

<div>
    <div class="table-responsive-sm">
        <table class="table table-striped table-bordered align-middle">
            <tr>
                <th scope="col">Title</th>
                <td>{{$promotion->title}}</td>
            </tr>
            <tr>
                <th scope="col">Is Visible</th>
                <td>{{$promotion->visible ? 'Yes' : 'No'}}</td>
            </tr>
            <tr>
                <th scope="col">Image</th>
                <td>
                    <img src="{{asset('storage/' . $promotion->image_small)}}" alt="">
                </td>
            </tr>
        </table>
    </div>
    <div class="">
        <button wire:click="delete" class="btn btn-dark mt-3 px-5" type="button">Delete</button>
    </div>
</div>