@section('navbar')
    @livewire('layout.navbar', [
        'title' => $blog->title,
        'parent' => 'Blogs',
        'parentRoute' => 'blogs',
        'page' => 'show',
    ])
@endsection

<div class="table-responsive-sm">
    <table class="table table-striped table-bordered align-middle">
        <tr>
            <th scope="col">Title</th>
            <td>{{$blog->title}}</td>
        </tr>
        <tr>
            <th scope="col">Category</th>
            <td>{{$blog->category->title ?? 'Not Exists'}}</td>
        </tr>
        <tr>
            <th scope="col">Visible</th>
            <td>{{$blog->visible ? 'Yes' : 'No'}}</td>
        </tr>
        <tr>
            <th scope="col">Language</th>
            <td>{{$blog->language == 'en' ? 'English' : 'Bangla'}}</td>
        </tr>
        <tr>
            <th scope="col">Meta Title</th>
            <td>{{$blog->meta_title}}</td>
        </tr>
        <tr>
            <th scope="col">Meta Description</th>
            <td>{{$blog->meta_description}}</td>
        </tr>
        <tr>
            <th scope="col">Meta Keywords</th>
            <td>{{$blog->meta_keywords}}</td>
        </tr>
        <tr>
            <th scope="col">Image</th>
            <td>
                <img src="{{asset('storage/' . $blog->image_small)}}" alt="">
            </td>
        </tr>
        <tr>
            <th scope="col">Article</th>
            <td>{!!$blog->article!!}</td>
        </tr>
    </table>
</div>