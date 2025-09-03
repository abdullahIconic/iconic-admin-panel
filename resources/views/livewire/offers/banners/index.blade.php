@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'List',
        'parent' => 'Offer Banners',
        'parentRoute' => 'offers.banners',
        'page' => 'index',
    ])
@endsection

<div>
    <div class="mb-3">
        Total {{ $totalBanners }} Banners
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
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($banners as $banner)
                <tr>
                    <td>
                        <img height="50" src="{{asset('storage/'.$banner->image_small)}}" alt="">
                    </td>
                    <td>{{$banner->title}}</td>
                    <td>{{$banner->visible ? "Yes" : "No"}}</td>
                    <td>
                        <a href="{{route('offers.banners.show', $banner->id)}}" class="btn bg-success text-white">View</a>
                        <a href="{{route('offers.banners.edit', $banner->id)}}" class="btn bg-warning">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if( method_exists($banners,'links') )
            {{ $banners->links() }}
        @endif
    </div>
</div>