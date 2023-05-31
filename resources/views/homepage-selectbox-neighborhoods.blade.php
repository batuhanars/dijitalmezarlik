<option value="" selected disabled>Tüm Mahalleler</option>
@foreach ($neighborhoods as $neighborhood)
    <option value="{{ $neighborhood->id }}">{{ $neighborhood->name }}</option>
@endforeach
