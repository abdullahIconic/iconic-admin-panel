@section('navbar')
    @livewire('layout.navbar', [
        'title' => $activity->title,
        'parent' => 'Activities',
        'parentRoute' => 'activities',
        'page' => 'show',
    ])
@endsection

<div class="table-responsive-sm">
    <table class="table table-striped table-bordered align-middle">
        <tr>
            <th scope="col">Title</th>
            <td>{{$activity->title}}</td>
        </tr>
        <tr>
            <th scope="col">Category</th>
            <td>{{$activity->category->title ?? 'Not Exists'}}</td>
        </tr>
        <tr>
            <th scope="col">Visible</th>
            <td>{{$activity->visible ? 'Yes' : 'No'}}</td>
        </tr>
        <tr>
            <th scope="col">Meta Title</th>
            <td>{{$activity->meta_title}}</td>
        </tr>
        <tr>
            <th scope="col">Meta Description</th>
            <td>{{$activity->meta_description}}</td>
        </tr>
        <tr>
            <th scope="col">Meta Keywords</th>
            <td>{{$activity->meta_keywords}}</td>
        </tr>
        <tr>
            <th scope="col">Image</th>
            <td>
                <img src="{{asset('storage/' . $activity->image_small)}}" alt="">
            </td>
        </tr>
        <tr>
            <th scope="col">Article</th>
            <td>{!!$activity->article!!}</td>
        </tr>
    </table>
</div>