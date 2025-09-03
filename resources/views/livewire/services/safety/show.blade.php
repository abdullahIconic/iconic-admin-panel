@section('navbar')
    @livewire('layout.navbar', [
        'title' => $safety->title,
        'parent' => 'Service Safety',
        'parentRoute' => 'services.safety',
        'page' => 'show',
    ])
@endsection

<div class="table-responsive-sm">
    <table class="table table-striped table-bordered align-middle">
        <tr>
            <th scope="col">Is Visible</th>
            <td>{{$safety->visible ? 'Yes' : 'No'}}</td>
        </tr>
        <tr>
            <th scope="col">Slogan</th>
            <td>{{$safety->slogan}}</td>
        </tr>
        <tr>
            <th scope="col">Title</th>
            <td>{{$safety->title}}</td>
        </tr>
        <tr>
            <th scope="col">Overview</th>
            <td>{{$safety->overview}}</td>
        </tr>
    </table>
    <div class="">
        <button wire:click="delete" class="btn btn-dark mt-3 px-5" type="button">Delete</button>
    </div>
</div>