<div class="d-flex justify-content-start">
    <a href="{{ route("pet.create") }}" class="btn btn-outline-success">@lang('page.addNew')</a>
    <a href="{{ route("pet.index") }}" class="btn btn-outline-success mx-2">@lang('page.list')</a>
    @isset($data['id'])
        <a href="{{ route("pet.edit", [
                    'pet' => $data['id']
                ]) }}" class="btn btn-outline-warning">@lang('page.edit')</a>
        <a href="{{ route("pet.show", [
                    'pet' => $data['id']
                ]) }}" class="btn btn-outline-warning mx-2">@lang('page.view')</a>
        <a href="{{ route("pet.uploadImage", [
                    'pet' => $data['id']
                ]) }}" class="btn btn-outline-warning">@lang('page.uploadImage')</a>
        <a href="{{ route("pet.updateViewPost", [
                    'pet' => $data['id']
                ]) }}" class="btn btn-outline-warning mx-2">@lang('page.updatePost')</a>
        <form action="{{ route('pet.destroy', [
                'pet' => $data['id']
                ]) }}" method="post">
            @csrf
            @method('delete')
            <button class="btn btn-outline-danger">@lang('page.delete')</button>
        </form>

    @endisset

</div>
