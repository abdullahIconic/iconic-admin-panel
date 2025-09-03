@section('navbar')
    @livewire('layout.navbar', [
        'title' => $project->title,
        'parent' => 'Industry Projects',
        'parentRoute' => 'industries.projects',
        'page' => 'show',
    ])
@endsection

<div>
    <div class="table-responsive-sm">
        <table class="table table-striped table-bordered align-middle">
            <tr>
                <th scope="col">Title</th>
                <td>{{$project->title}}</td>
            </tr>
            <tr>
                <th scope="col">Is Visible</th>
                <td>{{$project->visible ? 'Yes' : 'No'}}</td>
            </tr>
            <tr>
                <th scope="col">Meta Title</th>
                <td>{!!$project->meta_title!!}</td>
            </tr>
            <tr>
                <th scope="col">Meta Description</th>
                <td>{!!$project->meta_description!!}</td>
            </tr>
            <tr>
                <th scope="col">Meta Keywords</th>
                <td>{!!$project->meta_keywords!!}</td>
            </tr>
            <tr>
                <th scope="col">Image</th>
                <td>
                    <img src="{{asset('storage/' . $project->image_small)}}" alt="">
                </td>
            </tr>
            <tr>
                <th scope="col">Article</th>
                <td>{!!$project->article!!}</td>
            </tr>
        </table>
    </div>
    <div class="">
        <button wire:click="delete" class="btn btn-dark mt-3 px-5" type="button">Delete</button>
    </div>
</div>
