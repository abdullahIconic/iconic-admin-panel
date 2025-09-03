@section('navbar')
    @livewire('layout.navbar', [
        'title' => $section->title,
        'parent' => 'Section Data',
        'parentRoute' => 'section-data',
        'page' => 'show',
    ])
@endsection

<div>
    <div class="table-responsive-sm">
        <table class="table table-striped table-bordered align-middle">
            <tr>
                <th scope="col">Section</th>
                <td>{{$section->section}}</td>
            </tr>
            <tr>
                <th scope="col">Page</th>
                <td>{{$section->page}}</td>
            </tr>
            <tr>
                <th scope="col">Title</th>
                <td>{{$section->title}}</td>
            </tr>
            <tr>
                <th scope="col">URL</th>
                <td>{{$section->url}}</td>
            </tr>
            <tr>
                <th scope="col">Overview</th>
                <td>{{$section->overview}}</td>
            </tr>
            <tr>
                <th scope="col">Image</th>
                <td>
                    <img height="100" src="{{asset('storage/' . $section->image)}}" alt="">
                </td>
            </tr>
        </table>
    </div>
    <div class="">
        <button wire:click="delete" class="btn btn-dark mt-3 px-5" type="button">Delete</button>
    </div>
</div>