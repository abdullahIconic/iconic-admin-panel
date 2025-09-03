@section('navbar')
    @livewire('layout.navbar', [
        'title' => $service->title,
        'parent' => 'Service List',
        'parentRoute' => 'service-list',
        'page' => 'show',
    ])
@endsection

<div>
    <div class="table-responsive-sm">
        <table class="table table-striped table-bordered align-middle">
            <tr>
                <th scope="col">Is Visible</th>
                <td>{{$service->visible ? 'Yes' : 'No'}}</td>
            </tr>
            <tr>
                <th scope="col">Service For</th>
                <td>{{$service->service_for}}</td>
            </tr>
            <tr>
                <th scope="col">Title</th>
                <td>{{$service->title}}</td>
            </tr>
            <tr>
                <th scope="col">Identifier</th>
                <td>{{$service->identifier}}</td>
            </tr>
            <tr>
                <th scope="col">Service Items</th>
                <td>{{$service->services}}</td>
            </tr>
            <tr>
                <th scope="col">Overview</th>
                <td>{{$service->overview}}</td>
            </tr>
            <tr>
                <th scope="col">Caption</th>
                <td>{{$service->caption}}</td>
            </tr>
            <tr>
                <th scope="col">Image</th>
                <td>
                    <img src="{{asset('storage/' . $service->image_small)}}" alt="">
                </td>
            </tr>
        </table>
    </div>
    <div class="">
        <button wire:click="delete" class="btn btn-dark mt-3 px-5" type="button">Delete</button>
    </div>
</div>