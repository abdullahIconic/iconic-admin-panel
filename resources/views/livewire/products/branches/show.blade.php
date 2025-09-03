@section('navbar')
    @livewire('layout.navbar', [
        'title' => $branch->title,
        'parent' => 'Branches',
        'parentRoute' => 'products.branches',
        'page' => 'show',
    ])
@endsection

<div>
    <div class="table-responsive-sm">
        <table class="table table-striped table-bordered align-middle">
            <tr>
                <th scope="col">Title</th>
                <td>{{$branch->title}}</td>
            </tr>
            <tr>
                <th scope="col">Is Visible</th>
                <td>{{$branch->visible ? 'Yes' : 'No'}}</td>
            </tr>
            <tr>
                <th scope="col">Meta Title</th>
                <td>{!!$branch->meta_title!!}</td>
            </tr>
            <tr>
                <th scope="col">Meta Description</th>
                <td>{!!$branch->meta_description!!}</td>
            </tr>
            <tr>
                <th scope="col">Meta Keywords</th>
                <td>{!!$branch->meta_keywords!!}</td>
            </tr>
        </table>
    </div>
    <div class="">
        <button wire:click="delete" class="btn btn-dark mt-3 px-5" type="button">Delete</button>
    </div>
</div>