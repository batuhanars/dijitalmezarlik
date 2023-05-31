<option value="" selected disabled>Tüm İlçeler</option>
@foreach ($districts as $district)
    <option value="{{ $district->id }}">{{ $district->name }}</option>
@endforeach
