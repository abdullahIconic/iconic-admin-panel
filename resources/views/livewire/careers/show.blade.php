@section('navbar')
    @livewire('layout.navbar', [
        'title' => $career->title,
        'parent' => 'Careers',
        'parentRoute' => 'careers',
        'page' => 'show',
    ])
@endsection

<div class="table-responsive-sm">
    <table class="table table-striped table-bordered align-middle">
        <tr>
            <th scope="col">Title</th>
            <td>{{$career->title}}</td>
        </tr>
        <tr>
            <th scope="col">Visible</th>
            <td>{{$career->visible ? 'Yes' : 'No'}}</td>
        </tr>
        <tr>
            <th scope="col">Decription</th>
            <td>{{$career->description}}</td>
        </tr>
        <tr>
            <th scope="col">Meta Title</th>
            <td>{{$career->meta_title}}</td>
        </tr>
        <tr>
            <th scope="col">Meta Description</th>
            <td>{{$career->meta_description}}</td>
        </tr>
        <tr>
            <th scope="col">Meta Keywords</th>
            <td>{{$career->meta_keywords}}</td>
        </tr>
    </table>
</div>
