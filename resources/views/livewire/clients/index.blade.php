@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'List',
        'parent' => 'Clients',
        'parentRoute' => 'clients',
        'page' => 'index',
    ])
@endsection

<div>
    <div class="mb-3">
        Total {{ $totalClients }} Clients
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
                    <th scope="col">Name</th>
                    <th scope="col">Client For</th>
                    <th scope="col">Visible</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                <tr>
                    <td>
                        <img height="50" src="{{asset('storage/'.$client->image_small)}}" alt="">
                    </td>
                    <td>{{$client->name}}</td>
                    <td>{{$client->client_for}}</td>
                    <td>{{$client->visible ? "Yes" : "No"}}</td>
                    <td>
                        <a href="{{route('clients.show', $client->id)}}" class="btn bg-success text-white">View</a>
                        <a href="{{route('clients.edit', $client->id)}}" class="btn bg-warning">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if( method_exists($clients,'links') )
            {{ $clients->links() }}
        @endif
    </div>
</div>