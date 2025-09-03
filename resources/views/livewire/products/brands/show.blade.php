@section('navbar')
    @livewire('layout.navbar', [
        'title' => $brand->title,
        'parent' => 'Brands',
        'parentRoute' => 'products.brands',
        'page' => 'show',
    ])
@endsection

<div>
    <div class="table-responsive-sm">
        <table class="table table-striped table-bordered align-middle">
            <tr>
                <th scope="col">Title</th>
                <td>{{$brand->title}}</td>
            </tr>
            <tr>
                <th scope="col">Is Visible</th>
                <td>{{$brand->visible ? 'Yes' : 'No'}}</td>
            </tr>
            <tr>
                <th scope="col">Meta Title</th>
                <td>{!!$brand->meta_title!!}</td>
            </tr>
            <tr>
                <th scope="col">Meta Description</th>
                <td>{!!$brand->meta_description!!}</td>
            </tr>
            <tr>
                <th scope="col">Meta Keywords</th>
                <td>{!!$brand->meta_keywords!!}</td>
            </tr>
            <tr>
                <th scope="col">Image</th>
                <td>
                    <img src="{{asset('storage/' . $brand->image_small)}}" alt="">
                </td>
            </tr>
        </table>
    </div>
    <div class="">
        <button wire:click="delete" class="btn btn-dark mt-3 px-5" type="button">Delete</button>
    </div>
</div>