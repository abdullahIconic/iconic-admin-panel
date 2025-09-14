@section('navbar')
    @livewire('layout.navbar', [
        'title' => $serviceSubcategory->title,
        'parent' => 'Business Wings Subcategories',
        'parentRoute' => 'services',
        'page' => 'show',
    ])
@endsection

<div class="table-responsive-sm">
    <table class="table table-striped table-bordered align-middle">
        <tr>
            <th scope="col">Title</th>
            <td>{{$serviceSubcategory ->title}}</td>
        </tr>
        <tr>
            <th scope="col">Category</th>
            <td>{{$serviceSubcategory->category->title ?? 'Not Exists'}}</td>
        </tr>
        <tr>
            <th scope="col">Visible</th>
            <td>{{$serviceSubcategory->visible ? 'Yes' : 'No'}}</td>
        </tr>
        <tr>
            <th scope="col">Image</th>
            <td>
                <img src="{{asset('storage/' . $serviceSubcategory->image_medium)}}" alt="">
            </td>
        </tr>
        <tr>
            <th scope="col">Meta Title</th>
            <td>{{$serviceSubcategory->meta_title}}</td>
        </tr>
        <tr>
            <th scope="col">Meta Description</th>
            <td>{{$serviceSubcategory->meta_description}}</td>
        </tr>
        <tr>
            <th scope="col">Meta Keywords</th>
            <td>{{$serviceSubcategory->meta_keywords}}</td>
        </tr>
        <tr>
            <th scope="col">Article</th>
            <td>{!!$serviceSubcategory->article!!}</td>
        </tr>
    </table>
    <div class="">
        <button wire:click="delete" class="btn btn-dark mt-3 px-5" type="button">Delete</button>
    </div>
</div>
