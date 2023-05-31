@foreach ($provinces as $province)
    <optgroup label="{{ $province->name }}">
        @foreach ($province->districts as $district)
            <option value="{{ $district->id }}">{{ $district->name }}</option>
        @endforeach
    </optgroup>
@endforeach
