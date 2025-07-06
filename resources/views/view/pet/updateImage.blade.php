@extends("layout.layout")

@section('header')
    <section class="mb-5">
        <h1 class="fs-3 mb-4">@lang('page.uploadImage')</h1>

        <hr/>
        @include("component.buttonsAction", [
            "id" => $data['id'] ?? ''
        ])
    </section>
@endsection

@section("content")


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
