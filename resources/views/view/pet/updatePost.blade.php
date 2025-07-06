@extends("layout.layout")

@section('header')
    <section class="mb-5">
        <h1 class="fs-3 mb-4">@lang('page.updatePost')</h1>

        <hr/>
        @include("component.buttonsAction", [
            "id" => $data['id'] ?? ''
        ])
    </section>
@endsection

@section("content")

    @isset($data['id'])
        <section class="px-3">
            <form class="row w-100 g-3" method="post" action="{{ route('pet.updatePost', ['pet' => $data['id']]) }}">
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
    @endisset
@endsection
