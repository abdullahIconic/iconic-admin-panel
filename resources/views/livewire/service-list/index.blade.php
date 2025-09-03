@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'List',
        'parent' => 'Service List',
        'parentRoute' => 'service-list',
        'page' => 'index',
    ])
@endsection

<div>
    <div class="mb-3">
        Total {{ $totalServices }} Services
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
                    <th scope="col">Title</th>
                    <th scope="col">Service For</th>
                    <th scope="col">Visible</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                <tr>
                    <td>{{$service->title}}</td>
                    <td>{{$service->service_for}}</td>
                    <td>{{$service->visible ? "Yes" : "No"}}</td>
                    <td>
                        <a href="{{route('service-list.show', $service->id)}}" class="btn bg-success text-white">View</a>
                        <a href="{{route('service-list.edit', $service->id)}}" class="btn bg-warning">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if( method_exists($services,'links') )
            {{ $services->links() }}
        @endif
    </div>
</div>