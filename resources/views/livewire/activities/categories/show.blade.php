@section('navbar')
    @livewire('layout.navbar', [
        'title' => $category->title,
        'parent' => 'Avticity Categories',
        'parentRoute' => 'activities.categories',
        'page' => 'show',
    ])
@endsection
<div class="">
    <div class="table-responsive-sm">
        <table class="table table-striped table-bordered align-middle">
            <tr>
                <th scope="col">Title</th>
                <td>{{$category->title}}</td>
            </tr>
            <tr>
                <th scope="col">Is Visible</th>
                <td>{{$category->visible ? 'Yes' : 'No'}}</td>
            </tr>
            <tr>
                <th scope="col">Description</th>
                <td>{{$category->description}}</td>
            </tr>
            <tr>
                <th scope="col">Meta Title</th>
                <td>{{$category->meta_title}}</td>
            </tr>
            <tr>
                <th scope="col">Meta Description</th>
                <td>{{$category->meta_description}}</td>
            </tr>
            <tr>
                <th scope="col">Meta Keywords</th>
                <td>{{$category->meta_keywords}}</td>
            </tr>
        </table>
    </div>

    <div class="">
        <button wire:click="delete" class="btn btn-dark mt-3 px-5" type="button">Delete</button>
    </div>
</div>