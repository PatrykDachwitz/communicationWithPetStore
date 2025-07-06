@extends("layout.layout")


@section('header')
    <section class="mb-5">
        <div class="rounded-1 d-flex flex-column text-center">
            <h1 class="fs-3 mb-4">@lang('page.searchByStatus')</h1>
            <form class="d-flex justify-content-center" action="{{ route('pet.index') }}" method="GET">
                <div class="input-group me-2 w-50">
                    <select class="form-select" id="status" name="status">
                        @foreach(config("swagger.pet.findByStatus.status") as $availableStatus)
                            <option value="{{ $availableStatus }}" @if($status === $availableStatus) selected @endif>{{ $availableStatus }}</option>
                        @endforeach

                        <option value="test" >test</option>
                    </select>
                    <input class="btn btn-outline-primary" type="submit" value="@lang('page.search')">

                </div>
            </form>
            @error("status")
            <h3 class="text-danger fs-4">{{ $message }}</h3>
            @enderror
        </div>

        <hr/>
        @include("component.buttonsAction")
    </section>
@endsection

@section("content")

    <section class="pet__list rounded-1">
        <table class="table">
            <thead class="bg-dark position-sticky top-0">
                <tr class="table-dark">
                    <th scope="col">@lang('page.id')</th>
                    <th scope="col">@lang('page.name')</th>
                    <th scope="col">@lang('page.status')</th>
                    <th scope="col">@lang('page.category')</th>
                    <th scope="col">@lang('page.view')</th>
                    <th scope="col">@lang('page.edit')</th>
                    <th scope="col">@lang('page.updatePost')</th>
                    <th scope="col">@lang('page.delete')</th>
                </tr>
            </thead>
            <tbody>

            @foreach($data ?? [] as $item)
                <tr>
                    <th scope="row">{{ $item['id'] ?? __('page.id') }}</th>
                    <td>{{ $item['name'] ?? __('page.name') }}</td>
                    <td>{{ $item['status'] ?? __('page.status') }}</td>
                    <td>{{ $item['category']['name'] ?? __('page.category') }}</td>
                    <td><a title="@lang('page.view')" href="{{ route('pet.show', ['pet' => $item['id']]) }}" class="btn btn-outline-primary">@lang('page.view')</a></td>
                    <td><a title="@lang('page.edit')" href="{{ route('pet.edit', ['pet' => $item['id']]) }}" class="btn btn-outline-warning">@lang('page.edit')</a></td>
                    <td><a title="@lang('page.edit')" href="{{ route('pet.updateViewPost', ['pet' => $item['id']]) }}" class="btn btn-outline-warning">@lang('page.updatePost')</a></td>
                    <td><a title="@lang('page.delete')" href="{{ route('pet.destroy', ['pet' => $item['id']]) }}" class="btn btn-outline-danger">@lang('page.delete')</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>

@endsection
