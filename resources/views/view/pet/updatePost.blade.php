@extends("layout.layout")


@section("content")
    <section class="rounded-1 mb-5 d-flex flex-column text-center">
        <h1 class="fs-3 mb-4">@lang('page.updatePost')</h1>

        <div>
            <a href="{{ route("pet.create") }}" class="btn btn-outline-success">@lang('page.addNew')</a>
            <a href="{{ route("pet.index") }}" class="btn btn-outline-success">@lang('page.list')</a>
            @isset($data['id'])
                <a href="{{ route("pet.edit", [
                    'pet' => $data['id']
                ]) }}" class="btn btn-outline-warning">@lang('page.edit')</a>
                <a href="{{ route("pet.show", [
                    'pet' => $data['id']
                ]) }}" class="btn btn-outline-primary">@lang('page.view')</a>
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
    <section class="px-3">
        <form class="row w-100 g-3" method="post" action="{{ route('pet.updatePost', [
    'pet' => $data['id']
]) }}">
            @csrf
            <div class="col-3">
                <label for="id" class="form-label">@lang("form.id")</label>
                <input type="text" class="form-control" id="id" name="id" value="{{ $data['id'] }}" disabled>
            </div>

            <div class="col-4">
                <label for="name" class="form-label">@lang("form.name")</label>
                <input type="text" class="form-control" name="name" value="{{ old('name', $data['name']) }}" id="name">
                @error("name")
                <p class="text-danger fs-5">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-5">
                <label for="status" class="form-label">@lang("form.status")</label>
                <input type="text" class="form-control" id="status" name="status" value="{{ old('status', $data['status']) }}">
                @error("status")
                <p class="text-danger fs-5">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-4">
                <input type="submit" value="@lang('form.update')" class="btn btn-outline-primary">
            </div>

        </form>
    </section>
@endsection
