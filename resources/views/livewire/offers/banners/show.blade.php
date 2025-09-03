@section('navbar')
    @livewire('layout.navbar', [
        'title' => $banner->title,
        'parent' => 'Offer Banners',
        'parentRoute' => 'offers.banners',
        'page' => 'show',
    ])
@endsection

<div class="table-responsive-sm">
    <table class="table table-striped table-bordered align-middle">
        <tr>
            <th scope="col">Is Visible</th>
            <td>{{$banner->visible ? 'Yes' : 'No'}}</td>
        </tr>
        <tr>
            <th scope="col">Title</th>
            <td>{{$banner->title}}</td>
        </tr>
        <tr>
            <th scope="col">URL</th>
            <td>{{$banner->url}}</td>
        </tr>
        <tr>
            <th scope="col">Button Label</th>
            <td>{{$banner->label}}</td>
        </tr>
        <tr>
            <th scope="col">Overview</th>
            <td>{{$banner->overview}}</td>
        </tr>
        <tr>
            <th scope="col">Image</th>
            <td>
                <img src="{{asset('storage/' . $banner->image_medium)}}" alt="">
            </td>
        </tr>
    </table>
    <div class="">
        <button wire:click="delete" class="btn btn-dark mt-3 px-5" type="button">Delete</button>
    </div>
</div>