@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'List',
        'parent' => 'Team',
        'parentRoute' => 'team',
        'page' => 'index',
    ])
@endsection

<div>
    <div class="mb-3">
        Total {{ $totalMember }} Member(s)
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
                    <th scope="col">Designation</th>
                    <th scope="col">Visible</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($team as $member)
                <tr>
                    <td>
                        <img height="50" src="{{asset('storage/'.$member->image_small)}}" alt="">
                    </td>
                    <td>{{$member->name}}</td>
                    <td>{{$member->designation}}</td>
                    <td>{{$member->visible ? "Yes" : "No"}}</td>
                    <td>
                        <a href="{{route('team.show', $member->id)}}" class="btn bg-success text-white">View</a>
                        <a href="{{route('team.edit', $member->id)}}" class="btn bg-warning">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if( method_exists($team,'links') )
            {{ $team->links() }}
        @endif
    </div>
</div>