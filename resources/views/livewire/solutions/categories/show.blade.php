@section('navbar')
    @livewire('layout.navbar', [
        'title' => $category->title,
        'parent' => 'Solution Categories',
        'parentRoute' => 'solutions.categories',
        'page' => 'show',
    ])
@endsection

<div class="table-responsive-sm">
    <table class="table table-striped table-bordered align-middle">
        <tr>
            <th scope="col">Title</th>
            <td>{{$category->title}}</td>
        </tr>
        <tr>
            <th scope="col">URL</th>
            <td>{{$category->url}}</td>
        </tr>
        <tr>
            <th scope="col">Is Visible</th>
            <td>{{$category->visible ? 'Yes' : 'No'}}</td>
        </tr>
        <tr>
            <th scope="col">Image</th>
            <td>
                <img src="{{asset('storage/' . $category->image_medium)}}" alt="">
            </td>
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
    <div class="">
        <button wire:click="delete" class="btn btn-dark mt-3 px-5" type="button">Delete</button>
    </div>
</div>