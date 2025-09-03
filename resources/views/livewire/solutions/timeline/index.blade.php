@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'List',
        'parent' => 'Solution Timeline',
        'parentRoute' => 'solutions.timeline',
        'page' => 'index',
    ])
@endsection

<div>
    <div class="mb-3">
        Total {{ $totalTimelines }} Timelines
    </div>
    <div class="table-responsive-sm">
        <div class="d-flex gap-5 mb-3">
            <div class="d-flex align-timelines-center">
                <label for="qty" class="me-2">Items:</label>
                <div>
                    <input wire:model="qty" type="text" class="form-control" id="qty">
                </div>
            </div>
            <div class="d-flex align-timelines-center">
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
                    <th scope="col">Title 1</th>
                    <th scope="col">Visible</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($timelines as $timeline)
                <tr>
                    <td>
                        <img height="50" src="{{asset('storage/'.$timeline->image_small)}}" alt="">
                    </td>
                    <td>{{$timeline->title_1}}</td>
                    <td>{{$timeline->visible ? "Yes" : "No"}}</td>
                    <td>
                        <a href="{{route('solutions.timeline.show', $timeline->id)}}" class="btn bg-success text-white">View</a>
                        <a href="{{route('solutions.timeline.edit', $timeline->id)}}" class="btn bg-warning">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if( method_exists($timelines,'links') )
            {{ $timelines->links() }}
        @endif
    </div>
</div>