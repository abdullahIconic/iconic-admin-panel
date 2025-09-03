@section('navbar')
    @livewire('layout.navbar', [
        'title' => $tab->title,
        'parent' => 'Rental Tabs',
        'parentRoute' => 'services.rental.tabs',
        'page' => 'show',
    ])
@endsection

<div class="table-responsive-sm">
    <table class="table table-striped table-bordered align-middle">
        <tr>
            <th scope="col">Is Visible</th>
            <td>{{$tab->visible ? 'Yes' : 'No'}}</td>
        </tr>
        <tr>
            <th scope="col">Title</th>
            <td>{{$tab->title}}</td>
        </tr>
        <tr>
            <th scope="col">Description</th>
            <td>{{$tab->description}}</td>
        </tr>
    </table>
    <div class="">
        <button wire:click="delete" class="btn btn-dark mt-3 px-5" type="button">Delete</button>
    </div>
</div>