@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'List',
        'parent' => 'Sliders',
        'parentRoute' => 'sliders',
        'page' => 'index',
    ])
@endsection

<div>
    <div class="mb-3">
        Total {{ $totalPosts }} Post(s)
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
                    <th scope="col">Page Identifier</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sliders as $slider)
                <tr>
                    <td>
                        <img height="50" src="{{asset('storage/'.$slider->image_small)}}" alt="">
                    </td>
                    <td>{{$slider->title}}</td>
                    <td>{{$slider->visible ? "Yes" : "No"}}</td>
                    <td>{{$slider->page_name}}</td>
                    <td>
                        <a href="{{route('sliders.show', $slider->id)}}" class="btn bg-success text-white">View</a>
                        <a href="{{route('sliders.edit', $slider->id)}}" class="btn bg-warning">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if( method_exists($sliders,'links') )
            {{ $sliders->links() }}
        @endif
    </div>
</div>