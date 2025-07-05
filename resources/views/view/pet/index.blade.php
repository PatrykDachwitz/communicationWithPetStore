@extends("layout.layout")


@section("content")
    <section class="rounded-1 mb-5 d-flex flex-column text-center">
        <h1 class="fs-3 mb-4">@lang('page.searchByStatus')</h1>
        <form class="d-flex justify-content-center" action="{{ route('pet.index') }}" method="GET">
            <div class="input-group me-2 w-50">
                <select class="form-select" id="status" name="status">
                    @foreach(config("swagger.pet.findByStatus.status") as $availableStatus)
                        <option value="{{ $availableStatus }}" @if($status === $availableStatus) selected @endif>{{ $availableStatus }}</option>
                    @endforeach
                </select>
                <input class="btn btn-outline-primary" type="submit" value="@lang('page.search')">
                @error("status")
                <h3 class="text-danger">{{ $message }}</h3>
                @enderror
            </div>
            <div>
                <a class="btn btn-outline-primary" href="{{ route('pet.create') }}" title="@lang('page.addNewTitle')">@lang('page.addNew')</a>
            </div>
        </form>
    </section>

    @if(isset($statusCode) & $statusCode !== 200)
        @include("component.communicat.error", [
    'message' => "Test"
])
    @endif
    <section class="pet__list rounded-1">
        <table class="table">
            <thead class="bg-dark position-sticky top-0">
                <tr class="table-dark">
                    <th scope="col">@lang('page.id')</th>
                    <th scope="col">@lang('page.name')</th>
                    <th scope="col">@lang('page.status')</th>
                    <th scope="col">@lang('page.category')</th>
                    <th scope="col">@lang('page.edit')</th>
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
                    <td><a title="@lang('page.edit')" href="{{ route('pet.edit', ['pet' => $item['id']]) }}">@lang('page.edit')</a></td>
                    <td><a title="@lang('page.delete')" href="{{ route('pet.destroy', ['pet' => $item['id']]) }}">@lang('page.delete')</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>

@endsection
