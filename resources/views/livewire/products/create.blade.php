@section('navbar')
    @livewire('layout.navbar', [
        'title' => 'Create',
        'parent' => 'Products',
        'parentRoute' => 'products',
        'page' => 'create',
    ])
@endsection

<form class="body" action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    
    <div class="row g-3">
        <div class="col-md-4">
            <label class="form-label" for="title">Title</label>
            <input wire:model="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Title" value="{{ old('title') }}" required>
            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="url">Url</label>
            <input wire:model="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" id="url" placeholder="Url" value="{{ old('url') }}" required>
            @error('url')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-2">
            <label class="form-label" for="price">Price</label>
            <input wire:model="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" id="price" placeholder="Price" value="{{ old('price') }}">
            @error('price')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-2">
            <label class="form-label" for="regular_price">Regular Price</label>
            <input wire:model="regular_price" type="number" class="form-control @error('regular_price') is-invalid @enderror" name="regular_price" id="regular_price" placeholder="Regular Price" value="{{ old('regular_price') }}">
            @error('regular_price')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-2">
            <label class="form-label" for="quantity">Quantity</label>
            <input wire:model="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" id="quantity" placeholder="Quantity" value="{{ old('quantity') }}">
            @error('quantity')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
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
        <div class="col-md-2">
            <label class="form-label" for="featured">Featured?</label>
            <select wire:model="featured" class="form-control @error('featured') is-invalid @enderror" name="featured" required>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            @error('featured')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label" for="meta_title">Meta Title</label>
            <input wire:model="meta_title" type="text" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title" id="meta_title" placeholder="Meta Title" value="{{ old('meta_title') }}">
            @error('meta_title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-3">
            <label class="form-label" for="brand">Brand</label>
            <select wire:model="brand" class="form-control @error('brand') is-invalid @enderror" name="brand" id="brand" required>
                <option value="">-- Select Brand --</option>
                @foreach($brands as $brand)
                <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                @endforeach
            </select>
            @error('brand')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-3">
            <label class="form-label" for="branch">Branch</label>
            <select wire:model="branch" class="form-control{{ $errors->has('branch') ? ' is-invalid' : '' }}" name="branch" id="branch">
                <option value="">-- Select Branch --</option>
                @foreach($branches as $branch)
                <option value="{{ $branch->id }}">{{ $branch->title }}</option>
                @endforeach
            </select>
            @error('branch')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-3">
            <label class="form-label" for="category">Category</label>
            <select wire:model="category" class="form-control @error('category') is-invalid @enderror" name="category" id="category" required>
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
            @error('category')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-3">
            <label class="form-label" for="subcategory">Sub Category</label>
            <select wire:model="subcategory" class="form-control @error('subcategory') is-invalid @enderror" name="subcategory" id="subcategory">
                <option value="">-- Select Subcategory --</option>
                @foreach($subcategories as $subcategory)
                <option value="{{ $subcategory->id }}">{{ $subcategory->title }}</option>
                @endforeach
            </select>
            @error('subcategory')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="image">Image</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" required>
            <small class="text-muted">Recommended Size: 500px x 500px</small>
            @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-12" wire:ignore>
            <ul class="nav nav-tabs" id="myPillTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active show" id="pOverview-tab" data-bs-toggle="tab" href="#pOverview" role="tab" aria-controls="pOverview" aria-selected="true">Overview</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pFeature-tab" data-bs-toggle="tab" href="#pFeature" role="tab" aria-controls="pFeature" aria-selected="true">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pSpec-tab" data-bs-toggle="tab" href="#pSpec" role="tab" aria-controls="pSpec" aria-selected="true">Specifications</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pIncludes-tab" data-bs-toggle="tab" href="#pIncludes" role="tab" aria-controls="pIncludes" aria-selected="true">Includes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pAccessories-tab" data-bs-toggle="tab" href="#pAccessories" role="tab" aria-controls="pAccessories" aria-selected="true">Accessories</a>
                </li>
            </ul>
            <div class="tab-content" id="myPillTabContent">
                <div class="tab-pane fade active show" id="pOverview" role="tabpanel" aria-labelledby="pOverview-tab">
                    <textarea class="form-control tinymce" name="overview" id="overviewField" placeholder="Overview">{{ old('overview') }}</textarea>
                </div>
                <div class="tab-pane fade" id="pFeature" role="tabpanel" aria-labelledby="pFeature-tab">
                    <textarea class="form-control tinymce" name="features" id="featuresField" placeholder="Features">{{ old('features') }}</textarea>
                </div>
                <div class="tab-pane fade" id="pSpec" role="tabpanel" aria-labelledby="pSpec-tab">
                    <textarea class="form-control tinymce" name="specifications" id="specificationsField" placeholder="Specifications">{{ old('specifications') }}</textarea>
                </div>
                <div class="tab-pane fade" id="pIncludes" role="tabpanel" aria-labelledby="pIncludes-tab">
                    <textarea class="form-control tinymce" name="includes" id="includesField" placeholder="Includes">{{ old('includes') }}</textarea>
                </div>
                <div class="tab-pane fade" id="pAccessories" role="tabpanel" aria-labelledby="pAccessories-tab">
                    <textarea class="form-control tinymce" name="accessories" id="accessoriesField" placeholder="Accessories">{{ old('accessories') }}</textarea>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <label class="form-label" for="short_description">Short Description</label>
            <textarea wire:model="short_description" type="text" class="form-control @error('short_description') is-invalid @enderror" name="short_description" id="short_description" placeholder="Short Description">{{ old('short_description') }}</textarea>
            @error('short_description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label" for="meta_description">Meta Description</label>
            <textarea wire:model="meta_description" type="text" class="form-control @error('meta_description') is-invalid @enderror" name="meta_description" id="meta_description" placeholder="Meta Description">{{ old('meta_description') }}</textarea>
            @error('meta_description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label" for="meta_description">Meta Description</label>
            <textarea wire:model="meta_description" type="text" class="form-control @error('meta_description') is-invalid @enderror" name="meta_description" id="meta_description" placeholder="Meta Description">{{ old('meta_description') }}</textarea>
            @error('meta_description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label" for="meta_keywords">Meta keywords</label>
            <textarea wire:model="meta_keywords" type="text" class="form-control @error('meta_keywords') is-invalid @enderror" name="meta_keywords" placeholder="Meta keywords">{{ old('meta_keywords') }}</textarea>
            @error('meta_keywords')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <button class="btn btn-dark mt-3 px-5" type="submit">Store</button>
</form>