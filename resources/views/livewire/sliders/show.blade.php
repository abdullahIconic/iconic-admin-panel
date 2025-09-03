@section('navbar')
    @livewire('layout.navbar', [
        'title' => $slider->title,
        'parent' => 'Sliders',
        'parentRoute' => 'sliders',
        'page' => 'show',
    ])
@endsection

<div class="table-responsive-sm">
    <table class="table table-striped table-bordered align-middle">
        <tr>
            <th scope="col">Slogan</th>
            <td>{{$slider->slogan}}</td>
        </tr>
        <tr>
            <th scope="col">Title</th>
            <td>{{$slider->title}}</td>
        </tr>
        <tr>
            <th scope="col">Visible</th>
            <td>{{$slider->visible ? 'Yes' : 'No'}}</td>
        </tr>
        <tr>
            <th scope="col">Position</th>
            <td>{{$slider->position}}</td>
        </tr>
        <tr>
            <th scope="col">Overview</th>
            <td>{{$slider->overview}}</td>
        </tr>
        <tr>
            <th scope="col">Meta Title</th>
            <td>{{$slider->meta_title}}</td>
        </tr>
        <tr>
            <th scope="col">Meta Description</th>
            <td>{{$slider->meta_description}}</td>
        </tr>
        <tr>
            <th scope="col">Meta Keywords</th>
            <td>{{$slider->meta_keywords}}</td>
        </tr>
        <tr>
            <th scope="col">Image</th>
            <td>
                <img src="{{asset('storage/' . $slider->image_small)}}" alt="">
            </td>
        </tr>
    </table>
</div>