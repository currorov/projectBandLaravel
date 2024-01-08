@extends('layouts.template')

@section('content')
<div class="mx-auto max-w-lg bg-white rounded-5 shadow-2xl p-5 text-center min-w-[650px] !important">
    <h1 class="text-3xl md:text-4xl lg:text-5xl mb-7 text-teal-500">New Instrument</h1>
    <form action="">
        @csrf
        <input type="text" name="family" id="family" placeholder="Familia" class="w-full p-2 my-3 border-2 border-teal-500 rounded-5 text-base md:text-lg lg:text-xl">
        
        <input type="text" name="type" id="type" placeholder="Tipo" class="w-full p-2 my-3 border-2 border-teal-500 rounded-5 text-base md:text-lg lg:text-xl">
        
        <input type="text" name="brand" id="brand" placeholder="Marca" class="w-full p-2 my-3 border-2 border-teal-500 rounded-5 text-base md:text-lg lg:text-xl">
        
        <input type="text" name="model" id="model" placeholder="Modelo" class="w-full p-2 my-3 border-2 border-teal-500 rounded-5 text-base md:text-lg lg:text-xl">
        
        <input type="text" name="serial_number" id="serial_number" placeholder="Número de Serie" class="w-full p-2 my-3 border-2 border-teal-500 rounded-5 text-base md:text-lg lg:text-xl">
        
        <input type="date" name="acquisition_date" id="acquisition_date" class="w-full p-2 my-3 border-2 border-teal-500 rounded-5 text-base md:text-lg lg:text-xl">
        
        <input type="radio" name="state" id="stateLent" value="lent" class="mr-2" checked>
        <label for="stateLent">Lent</label>

        <input type="radio" name="state" id="stateAvailable" value="available" class="ml-4 mr-2">
        <label for="stateAvailable">Available</label>
        
        <textarea name="comment" id="comment" placeholder="Comentario" class="w-full p-2 my-3 border-2 border-teal-500 rounded-5 text-base md:text-lg lg:text-xl"></textarea>
        
        <input type="text" name="image" id="image" placeholder="Nombre de la Imagen" class="w-full p-2 my-3 border-2 border-teal-500 rounded-5 text-base md:text-lg lg:text-xl">
        
        <button type="submit" class="w-full p-4 bg-teal-500 text-white border-none rounded-5 text-lg md:text-xl lg:text-2xl cursor-pointer transition duration-300 hover:bg-teal-700">Registrar Instrumento</button>
    </form>
</div>
@endsection