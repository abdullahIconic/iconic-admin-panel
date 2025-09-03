@section('navbar')
    @livewire('layout.navbar', [
        'title' => $data->page_name,
        'parent' => 'Metadata',
        'parentRoute' => 'metadata',
        'page' => 'show',
    ])
@endsection

<div>
    <div class="table-responsive-sm">
        <table class="table table-striped table-bordered align-middle">
            <tr>
                <th scope="col">Page Name</th>
                <td>{{$data->page_name}}</td>
            </tr>
            <tr>
                <th scope="col">Title</th>
                <td>{{$data->title}}</td>
            </tr>
            <tr>
                <th scope="col">Overview</th>
                <td>{{$data->overview}}</td>
            </tr>
        </table>
    </div>
    <div class="">
        <button wire:click="delete" class="btn btn-dark mt-3 px-5" type="button">Delete</button>
    </div>
</div>