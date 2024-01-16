@extends('layouts.template')

@section('content')
<div class="mx-auto max-w-lg bg-white rounded-5 shadow-2xl p-5 text-center min-w-[650px] !important mb-5 mt-5">
    <h1 class="text-3xl md:text-4xl lg:text-5xl mb-7 text-teal-500">New Instrument</h1>
    <form action="{{ route('insertInstrument') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name="family" id="family" placeholder="Family" class="w-full p-2 my-3 border-2 border-teal-500 rounded-5 text-base md:text-lg lg:text-xl" value="{{ old('family') }}">
        @error('family')
            <span class="text-sm text-red-500">{{ $message }}</span>
        @enderror

        <input type="text" name="type" id="type" placeholder="Type" class="w-full p-2 my-3 border-2 border-teal-500 rounded-5 text-base md:text-lg lg:text-xl" value="{{ old('type') }}">
        @error('type')
            <span class="text-sm text-red-500">{{ $message }}</span>
        @enderror

        <input type="text" name="brand" id="brand" placeholder="Brand" class="w-full p-2 my-3 border-2 border-teal-500 rounded-5 text-base md:text-lg lg:text-xl" value="{{ old('brand') }}">
        @error('brand')
            <span class="text-sm text-red-500">{{ $message }}</span>
        @enderror

        <input type="text" name="model" id="model" placeholder="Model" class="w-full p-2 my-3 border-2 border-teal-500 rounded-5 text-base md:text-lg lg:text-xl" value="{{ old('model') }}">
        @error('model')
            <span class="text-sm text-red-500">{{ $message }}</span>
        @enderror

        <input type="text" name="serial_number" id="serial_number" placeholder="Serial Number" class="w-full p-2 my-3 border-2 border-teal-500 rounded-5 text-base md:text-lg lg:text-xl" value="{{ old('serial_number') }}">
        @error('serial_number')
            <span class="text-sm text-red-500">{{ $message }}</span>
        @enderror

        <input type="date" name="acquisition_date" id="acquisition_date" class="w-full p-2 my-3 border-2 border-teal-500 rounded-5 text-base md:text-lg lg:text-xl" value="{{ old('acquisition_date') }}">
        @error('acquisition_date')
            <span class="text-sm text-red-500">{{ $message }} <br></span>
        @enderror

        <input type="radio" name="state" id="stateLent" value="lent" class="mr-2" {{ old('state') == 'lent' ? 'checked' : '' }}>
        <label for="stateLent">Lent</label>

        <input type="radio" name="state" id="stateAvailable" value="available" class="ml-4 mr-2" {{ old('state') == 'available' ? 'checked' : '' }}>
        <label for="stateAvailable">Available</label>
        @error('state')
            <span class="text-sm text-red-500"><br>{{ $message }} <br></span>
        @enderror

        <textarea name="comment" id="comment" placeholder="Comment" class="w-full p-2 my-3 border-2 border-teal-500 rounded-5 text-base md:text-lg lg:text-xl">{{ old('comment') }}</textarea>
        @error('comment')
            <span class="text-sm text-red-500">{{ $message }}</span>
        @enderror

        <input type="file" name="image" id="image" placeholder="Instrument Image" accept="image/*" class="w-full p-2 my-3 border-2 border-teal-500 rounded-5 text-base md:text-lg lg:text-xl">
        @error('image')
            <span class="text-sm text-red-500">{{ $message }}</span>
        @enderror

        <button type="submit" class="w-full p-4 bg-teal-500 text-white border-none rounded-5 text-lg md:text-xl lg:text-2xl cursor-pointer transition duration-300 hover:bg-teal-700">Register instrument</button>
    </form>
</div>
@endsection