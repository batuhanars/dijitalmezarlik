@foreach ($cemeteries as $cemetery)
    <option value="{{ $cemetery->id }}">{{ $cemetery->title }}</option>
@endforeach
