@section('navbar')
@livewire('layout.navbar', [
'title' => $segment->title,
'parent' => 'Segments',
'parentRoute' => 'products.segments',
'page' => 'show',
])
@endsection

<div>
    <div class="table-responsive-sm">
        <table class="table table-striped table-bordered align-middle">
            <tr>
                <th scope="col">Title</th>
                <td>{{$segment->title}}</td>
            </tr>
            <tr>
                <th scope="col">Is Visible</th>
                <td>{{$segment->visible ? 'Yes' : 'No'}}</td>
            </tr>
            <tr>
                <th scope="col">Description</th>
                <td>{!!$segment->description!!}</td>
            </tr>
            <tr>
                <th scope="col">Overview</th>
                <td>{!!$segment->overview!!}</td>
            </tr>
            <tr>
                <th scope="col">Solution Overview</th>
                <td>{!!$segment->solution_overview!!}</td>
            </tr>
            <tr>
                <th scope="col">Project Overview</th>
                <td>{!!$segment->project_overview!!}</td>
            </tr>
            <tr>
                <th scope="col">Meta Title</th>
                <td>{!!$segment->meta_title!!}</td>
            </tr>
            <tr>
                <th scope="col">Meta Description</th>
                <td>{!!$segment->meta_description!!}</td>
            </tr>
            <tr>
                <th scope="col">Meta Keywords</th>
                <td>{!!$segment->meta_keywords!!}</td>
            </tr>
            <tr>
                <th scope="col">Image</th>
                <td>
                    <img src="{{asset('storage/' . $segment->image_small)}}" alt="">
                </td>
            </tr>
        </table>
    </div>
    <div class="">
        <button wire:click="delete" class="btn btn-dark mt-3 px-5" type="button">Delete</button>
    </div>
</div>
