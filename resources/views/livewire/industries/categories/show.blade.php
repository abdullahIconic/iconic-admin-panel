@section('navbar')
    @livewire('layout.navbar', [
        'title' => $category->title,
        'parent' => 'Industry Categories',
        'parentRoute' => 'industries.categories',
        'page' => 'show',
    ])
@endsection

<div>
    <div class="table-responsive-sm">
        <table class="table table-striped table-bordered align-middle">
            <tr>
                <th scope="col">Title</th>
                <td>{{$category->title}}</td>
            </tr>
            <tr>
                <th scope="col">URL</th>
                <td>{{$category->url}}</td>
            </tr>
            <tr>
                <th scope="col">Is Visible</th>
                <td>{{$category->visible ? 'Yes' : 'No'}}</td>
            </tr>
            <tr>
                <th scope="col">Image</th>
                <td>
                    <img src="{{asset('storage/' . $category->image_medium)}}" alt="">
                </td>
            </tr>
            <tr>
                <th scope="col">Meta Title</th>
                <td>{{$category->meta_title}}</td>
            </tr>
            <tr>
                <th scope="col">Meta Description</th>
                <td>{{$category->meta_description}}</td>
            </tr>
            <tr>
                <th scope="col">Meta Keywords</th>
                <td>{{$category->meta_keywords}}</td>
            </tr>
        </table>
        <div class="">
            <button wire:click="delete" class="btn btn-dark mt-3 px-5" type="button">Delete</button>
        </div>
    </div>

    {{-- Best Feature Images --}}
    <h2 class="mt-5">Best Features Images</h2>
    <form class="body" action="{{ route('industries.best-feature-images.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
            <div class="col-md-2">
                <label class="form-label" for="visible">Visible?</label>
                <select wire:model="visible" class="form-control @error('visible') is-invalid @enderror" name="visible" required>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                @error('visible')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label" for="title">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Title" required>
                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label" for="image">Image</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" required>
                @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <button class="btn btn-success mt-3 px-5" type="submit" name="page" value="{{$category->id}}">Store</button>
    </form>

    <div class="table-responsive-sm mt-5">
        <div class="d-flex gap-5 mb-3">
            <div class="d-flex align-items-center">
                <label for="qty" class="me-2">Items:</label>
                <div>
                    <input wire:model="qty" type="text" class="form-control" id="qty">
                </div>
            </div>
            <div class="d-flex align-items-center">
                <label for="searech" class="me-2">Search:</label>
                <div>
                    <input wire:model="keyword" type="text" class="form-control" id="searech" placeholder="Title">
                </div>
            </div>
        </div>
        <table class="table table-striped table-bordered align-middle">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">Visible</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($feature_images as $image)
                <tr>
                    <td>
                        <img height="50" src="{{asset('storage/'.$image->image_small)}}" alt="">
                    </td>
                    <td>{{$image->title}}</td>
                    <td>{{$image->visible ? "Yes" : "No"}}</td>
                    <td>
                        <button wire:click="featureImageToggle('{{$image->id}}')" class="btn bg-warning">
                            {{$image->visible ? "Hide" : "Show"}}
                        </button>
                        <button wire:click="featureImageDelete('{{$image->id}}')" class="btn bg-danger text-white">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if( method_exists($feature_images,'links') )
            {{ $feature_images->links() }}
        @endif
    </div>
</div>