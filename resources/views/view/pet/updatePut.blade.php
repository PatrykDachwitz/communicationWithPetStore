@extends("layout.layout")


@section("content")
    <section class="rounded-1 mb-5 d-flex flex-column text-center">
        <h1 class="fs-3 mb-4">@lang('page.edit'): {{ $data['name'] ?? "" }}</h1>

        <div>
            <a href="{{ route("pet.create") }}" class="btn btn-outline-success">@lang('page.addNew')</a>
            <a href="{{ route("pet.index") }}" class="btn btn-outline-success">@lang('page.list')</a>
            @isset($data['id'])
                <a href="{{ route("pet.edit", [
                    'pet' => $data['id']
                ]) }}" class="btn btn-outline-warning">@lang('page.edit')</a>
                <a href="{{ route("pet.updateViewPost", [
                    'pet' => $data['id']
                ]) }}" class="btn btn-outline-warning">@lang('page.updatePost')</a>
                <a href="{{ route("pet.destroy", [
                    'pet' => $data['id']
                ]) }}" class="btn btn-outline-danger">@lang('page.delete')</a>

            @endisset

        </div>
    </section>

    @if(isset($statusCode))
        @if($statusCode !== 200)
            @include("component.communicat.error", [
                'message' => $data
            ])
        @endif
    @endif

    @if(isset($update))

        @if($update === true)
            @include("component.communicat.success", [
                'message' => __("page.successUpdate")
            ])
        @endif
    @endif

    @if(isset($data['id']))
        <section class="px-3">
            <form class="row w-100 g-3" method="POST" action="{{ route('pet.update', [
    "pet" => $data['id']
]) }}">
                @csrf
                @method('PUT')

                <div class="col-3">
                    <label for="id" class="form-label">@lang("form.id")</label>
                    <input type="text" class="form-control" id="id" name="id" value="{{ old('id', $data["id"]) }}">
                    @error("id")
                    <p class="text-danger fs-5">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-4">
                    <label for="categoryName" class="form-label">@lang("form.categoryName")</label>
                    <input type="text" class="form-control" name="category[name]" value="{{ old('category.name', $data['category']['name']) }}" id="categoryName">

                    @error("category.name")
                    <p class="text-danger fs-5">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-5">
                    <label for="categoryId" class="form-label">@lang("form.categoryId")</label>
                    <input type="text" class="form-control" name="category[id]" value="{{ old('category.id', $data['category']['id'] ) }}" id="categoryId">

                    @error("category.id")
                    <p class="text-danger fs-5">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="name" class="form-label">@lang("form.name")</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $data['name']) }}" id="name">
                    @error("name")
                    <p class="text-danger fs-5">{{ $message }}</p>
                    @enderror
                </div><!--TODO dodać tu iterację-->
                @foreach($data['photoUrls'] ?? [] as $key => $photoUrl)
                    <div class="col-6">
                        <label for="photoUrls" class="form-label">@lang("form.photoUrl")</label>
                        <input type="text" class="form-control" name="photoUrls[{{ $key }}]" id="photoUrls" value="{{ old("photoUrls.{$key}", $data['photoUrls'][$key]) }}">
                        @error("photoUrls.{$key}")
                        <p class="text-danger fs-5">{{ $message }}</p>
                        @enderror
                    </div>
                @endforeach
                @foreach($data['tags'] ?? [] as $key => $tag)
                    <div class="col-6">
                        <label for="tagName" class="form-label">@lang("form.tagName")</label>
                        <input type="text" class="form-control" name="tags[{{$key}}][name]" value="{{ old("tags.{$key}.name", $data['tags'][$key]['name']) }}" id="tagName">
                        @error("tags.{$key}.name")
                        <p class="text-danger fs-5">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="tagId" class="form-label">@lang("form.tagId")</label>
                        <input type="text" class="form-control" name="tags[{{$key}}][id]" value="{{ old("tags.{$key}.id", $data['tags'][$key]['id'] ) }}" id="tagId">
                        @error("tags.{$key}.id")
                        <p class="text-danger fs-5">{{ $message }}</p>
                        @enderror
                    </div>
                @endforeach
                <div class="col-12">
                    <label for="status" class="form-label">@lang("form.status")</label>
                    <input type="text" class="form-control" id="status" name="status" value="{{ old('status', $data['status']) }}">
                    @error("status")
                    <p class="text-danger fs-5">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-4">
                    <input type="submit" value="@lang('form.create')" class="btn btn-outline-primary">
                </div>

            </form>
        </section>
    @endif
@endsection
