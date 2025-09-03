@section('navbar')
    @livewire('layout.navbar', [
        'title' => $solution->title,
        'parent' => 'Segment Solutions',
        'parentRoute' => 'products.segments.solutions',
        'page' => 'show',
    ])
@endsection

<div>
    <div class="table-responsive-sm">
        <table class="table table-striped table-bordered align-middle">
            <tr>
                <th scope="col">Title</th>
                <td>{{$solution->title}}</td>
            </tr>
            <tr>
                <th scope="col">Is Visible</th>
                <td>{{$solution->visible ? 'Yes' : 'No'}}</td>
            </tr>
            <tr>
                <th scope="col">Meta Title</th>
                <td>{!!$solution->meta_title!!}</td>
            </tr>
            <tr>
                <th scope="col">Meta Description</th>
                <td>{!!$solution->meta_description!!}</td>
            </tr>
            <tr>
                <th scope="col">Meta Keywords</th>
                <td>{!!$solution->meta_keywords!!}</td>
            </tr>
            <tr>
                <th scope="col">Image</th>
                <td>
                    <img src="{{asset('storage/' . $solution->image_small)}}" alt="">
                </td>
            </tr>
            <tr>
                <th scope="col">Article</th>
                <td>{!!$solution->article!!}</td>
            </tr>
        </table>
    </div>
    <div class="">
        <button wire:click="delete" class="btn btn-dark mt-3 px-5" type="button">Delete</button>
    </div>
</div>
