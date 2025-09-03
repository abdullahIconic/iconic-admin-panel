@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'List',
        'parent' => 'Service Carousel',
        'parentRoute' => 'service-carousel',
        'page' => 'index',
    ])
@endsection

<div>
    <div class="mb-3">
        Total {{ $totalCarousels }} Carousels
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
                <label for="qty" class="me-2">Carousel For:</label>
                <select wire:model="carousel_for" class="form-control">
                    <option value="">All</option>
                    <option value="home">Home</option>
                    <option value="solution">Solutions</option>
                </select>
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
                    <th scope="col">Carousel For</th>
                    <th scope="col">Visible</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($carousels as $carousel)
                <tr>
                    <td>{{$carousel->title}}</td>
                    <td>{{$carousel->carousel_for}}</td>
                    <td>{{$carousel->visible ? "Yes" : "No"}}</td>
                    <td>
                        <a href="{{route('service-carousel.show', $carousel->id)}}" class="btn bg-success text-white">View</a>
                        <a href="{{route('service-carousel.edit', $carousel->id)}}" class="btn bg-warning">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if( method_exists($carousels,'links') )
            {{ $carousels->links() }}
        @endif
    </div>
</div>