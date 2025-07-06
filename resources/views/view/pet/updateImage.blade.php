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
            <form class="row w-100 g-3" method="POST" enctype="multipart/form-data" action="{{ route('pet.uploadImage', [
    "pet" => $data['id']
]) }}">
                @csrf

                <div class="col-3">
                    <label for="id" class="form-label">@lang("form.id")</label>
                    <input type="text" class="form-control" id="id" name="id" value="{{ old('id', $data["id"]) }}">
                    @error("id")
                    <p class="text-danger fs-5">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-4">
                    <label for="additionalMetadata" class="form-label">@lang("form.additionalMetadata")</label>
                    <input type="text" class="form-control" name="additionalMetadata" value="{{ old('additionalMetadata') }}" id="additionalMetadata">

                    @error("additionalMetadata")
                    <p class="text-danger fs-5">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-5">
                    <label for="file" class="form-label">@lang("form.file")</label>
                    <input type="file" class="form-control" id="file" name="file">

                    @error("file")
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
