@foreach ($neighborhoods as $neighborhood)
    <option value="{{ $neighborhood->id }}">{{ $neighborhood->name }}</option>
@endforeach
