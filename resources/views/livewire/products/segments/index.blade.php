@section('navbar')
@livewire('layout.navbar', [
'title' => 'List',
'parent' => 'Segments',
'parentRoute' => 'products.segments',
'page' => 'index',
])
@endsection

<div>
    <div class="mb-3">
        Total {{ $totalSegments }} Segments
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
                @foreach($segments as $segment)
                <tr>
                    <td>
                        <img height="50" src="{{asset('storage/'.$segment->image)}}" alt="">
                    </td>
                    <td>{{$segment->title}}</td>
                    <td>{{$segment->visible ? "Yes" : "No"}}</td>
                    <td>
                        <a href="{{route('products.segments.show', $segment->id)}}"
                            class="btn bg-success text-white">View</a>
                        <a href="{{route('products.segments.edit', $segment->id)}}" class="btn bg-warning">Edit</a>
                        
                        <a href="{{route('products.segments.products', $segment->id)}}" class="btn bg-dark text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket" viewBox="0 0 16 16">
                                <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9H2zM1 7v1h14V7H1zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5z"/>
                            </svg>                              
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if( method_exists($segments,'links') )
        {{ $segments->links() }}
        @endif
    </div>
</div>