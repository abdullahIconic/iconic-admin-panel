@section('navbar')
    @livewire('layout.navbar', [
        'title' => $solution->title,
        'parent' => 'Solution Items',
        'parentRoute' => 'solutions.solution-items',
        'page' => 'show',
    ])
@endsection

<div class="table-responsive-sm">
    <table class="table table-striped table-bordered align-middle">
        <tr>
            <th scope="col">Is Visible</th>
            <td>{{$solution->visible ? 'Yes' : 'No'}}</td>
        </tr>
        <tr>
            <th scope="col">Slogan</th>
            <td>{{$solution->slogan}}</td>
        </tr>
        <tr>
            <th scope="col">Title</th>
            <td>{{$solution->title}}</td>
        </tr>
        <tr>
            <th scope="col">Overview</th>
            <td>{{$solution->overview}}</td>
        </tr>
    </table>
    <div class="">
        <button wire:click="delete" class="btn btn-dark mt-3 px-5" type="button">Delete</button>
    </div>
</div>