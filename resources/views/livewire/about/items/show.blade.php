@section('navbar')
    @livewire('layout.navbar', [
        'title' => $item->title,
        'parent' => 'About Items',
        'parentRoute' => 'about.items',
        'page' => 'show',
    ])
@endsection

<div class="table-responsive-sm">
    <table class="table table-striped table-bordered align-middle">
        <tr>
            <th scope="col">Title</th>
            <td>{{$item->title}}</td>
        </tr>
        <tr>
            <th scope="col">URL</th>
            <td>{{$item->url}}</td>
        </tr>
        <tr>
            <th scope="col">Is Visible</th>
            <td>{{$item->visible ? 'Yes' : 'No'}}</td>
        </tr>
        <tr>
            <th scope="col">Image</th>
            <td>
                <img src="{{asset('storage/' . $item->image_medium)}}" alt="">
            </td>
        </tr>
        <tr>
            <th scope="col">Meta Title</th>
            <td>{{$item->meta_title}}</td>
        </tr>
        <tr>
            <th scope="col">Meta Description</th>
            <td>{{$item->meta_description}}</td>
        </tr>
        <tr>
            <th scope="col">Meta Keywords</th>
            <td>{{$item->meta_keywords}}</td>
        </tr>
    </table>
    <div class="">
        <button wire:click="delete" class="btn btn-dark mt-3 px-5" type="button">Delete</button>
    </div>
</div>