@section('navbar')
    @livewire('layout.navbar', [
        'title' => $service->title,
        'parent' => 'Services',
        'parentRoute' => 'services',
        'page' => 'show',
    ])
@endsection

<div class="table-responsive-sm">
    <table class="table table-striped table-bordered align-middle">
        <tr>
            <th scope="col">Title</th>
            <td>{{$service->title}}</td>
        </tr>
        <tr>
            <th scope="col">Category</th>
            <td>{{$service->category->title ?? 'Not Exists'}}</td>
        </tr>
        <tr>
            <th scope="col">Visible</th>
            <td>{{$service->visible ? 'Yes' : 'No'}}</td>
        </tr>
        <tr>
            <th scope="col">Image</th>
            <td>
                <img src="{{asset('storage/' . $service->image_medium)}}" alt="">
            </td>
        </tr>
        <tr>
            <th scope="col">Meta Title</th>
            <td>{{$service->meta_title}}</td>
        </tr>
        <tr>
            <th scope="col">Meta Description</th>
            <td>{{$service->meta_description}}</td>
        </tr>
        <tr>
            <th scope="col">Meta Keywords</th>
            <td>{{$service->meta_keywords}}</td>
        </tr>
        <tr>
            <th scope="col">Article</th>
            <td>{!!$service->article!!}</td>
        </tr>
    </table>
    <div class="">
        <button wire:click="delete" class="btn btn-dark mt-3 px-5" type="button">Delete</button>
    </div>
</div>