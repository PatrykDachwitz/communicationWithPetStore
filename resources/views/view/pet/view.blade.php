@extends("layout.layout")


@section("content")
    <section class="rounded-1 mb-5 d-flex flex-column text-center">
        <h1 class="fs-3 mb-4">@lang('page.browsing') {{ $data['name'] ?? __("page.name") }}</h1>

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
    @if(isset($create))
        @if($create === true)
            @include("component.communicat.success", [
                'message' => __("swagger.successCreate")
            ])
        @endif
    @endif

    <section class="px-3">
        <form class="row w-100 g-3">
            <div class="col-md-6">
                <label for="id" class="form-label">@lang("form.id")</label>
                <input type="text" class="form-control" id="id" value="{{ $data['id'] ?? '' }}" disabled>
            </div>
            <div class="col-md-6">
                <label for="category" class="form-label">@lang('form.category')</label>
                <input type="text" class="form-control" id="category" value="{{ $data['category']['name'] ?? '' }}" disabled>
            </div>
            <div class="col-12">
                <label for="name" class="form-label">@lang("form.name")</label>
                <input type="text" class="form-control" value="{{ $data['name'] ?? "" }}" id="name" disabled>
            </div>
            @foreach($data['photoUrl'] ?? [] as $key => $photo)
                <div class="col-12">
                    <label for="photoUrl-{{ $key }}" class="form-label">@lang("form.photoUrl")</label>
                    <input type="text" class="form-control" value="{{ $photo }}" id="photoUrl-{{ $key }}" disabled>
                </div>
            @endforeach
            @foreach($data['tags'] ?? [] as $key => $tag)
                <div class="col-12">
                    <label for="tag-{{ $key }}" class="form-label">@lang("form.tag")</label>
                    <input type="text" class="form-control" value="{{ $tag['name'] }}" id="tag-{{ $key }}" disabled>
                </div>
            @endforeach
            <div class="col-md-6">
                <label for="status" class="form-label">@lang("form.status")</label>
                <input type="text" class="form-control" id="status" value="{{ $data['status'] ?? "" }}" disabled>
            </div>

        </form>
    </section>
@endsection
