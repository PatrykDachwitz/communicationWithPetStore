@extends("layout.layout")


@section("content")
    <section class="rounded-1 mb-5 d-flex flex-column text-center">
        <h1 class="fs-3 mb-4">@lang('page.addNewPet')</h1>

        <div>
            <a href="{{ route("pet.create") }}" class="btn btn-outline-success">@lang('page.addNew')</a>
            <a href="{{ route("pet.index") }}" class="btn btn-outline-success">@lang('page.list')</a>

        </div>
    </section>

    @if(isset($statusCode))
        @if($statusCode !== 200)
            @include("component.communicat.error", [
                'message' => $data
            ])
        @endif
    @endif
    <section class="px-3">
        <form class="row w-100 g-3" method="POST" action="{{ route('pet.store') }}">
            @csrf
            <div class="col-3">
                <label for="id" class="form-label">@lang("form.id")</label>
                <input type="text" class="form-control" id="id" name="id" value="{{ old('id', '') }}">
                @error("id")
                <p class="text-danger fs-5">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-4">
                <label for="categoryName" class="form-label">@lang("form.categoryName")</label>
                <input type="text" class="form-control" name="category[name]" value="{{ old('category.name', '') }}" id="categoryName">

                @error("category.name")
                <p class="text-danger fs-5">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-5">
                <label for="categoryId" class="form-label">@lang("form.categoryId")</label>
                <input type="text" class="form-control" name="category[id]" value="{{ old('category.id', '' ) }}" id="categoryId">

                @error("category.id")
                <p class="text-danger fs-5">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-6">
                <label for="name" class="form-label">@lang("form.name")</label>
                <input type="text" class="form-control" name="name" value="{{ old('name', '') }}" id="name">
                @error("name")
                <p class="text-danger fs-5">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-6">
                <label for="photoUrls" class="form-label">@lang("form.photoUrl")</label>
                <input type="text" class="form-control" name="photoUrls[0]" id="photoUrls">
                @error("photoUrls.0")
                <p class="text-danger fs-5">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-6">
                <label for="tagName" class="form-label">@lang("form.tagName")</label>
                <input type="text" class="form-control" name="tags[0][name]" value="{{ old('tags.0.name', '') }}" id="tagName">
                @error("tags.0.name")
                <p class="text-danger fs-5">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-6">
                <label for="tagId" class="form-label">@lang("form.tagId")</label>
                <input type="text" class="form-control" name="tags[0][id]" value="{{ old('tags.0.id', '' ) }}" id="tagId">
                @error("tags.0.id")
                <p class="text-danger fs-5">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-12">
                <label for="status" class="form-label">@lang("form.status")</label>
                <input type="text" class="form-control" id="status" name="status" value="{{ old('status', '') }}">
                @error("status")
                <p class="text-danger fs-5">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-4">
                <input type="submit" value="@lang('form.create')" class="btn btn-outline-primary">
            </div>

        </form>
    </section>
@endsection
