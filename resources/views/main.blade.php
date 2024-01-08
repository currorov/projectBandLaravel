@extends('layouts.template')

@section('filesjs')
    <script src="{{ asset('js/scriptMainShowMore.js') }}"></script>
@endsection

@section('content')
<div class="main-content flex">
    <div class="sidebar bg-white border-r-2 border-teal-500 w-1/5 p-4 flex flex-col text-center text-base">
        <h1 class="text-2xl mb-4 text-teal-500">Cerca</h1>
        <form id="filterForm" action="" method="POST" class="text-center items-center">
            <h2 class="mt-4 ">Instrument</h2>
            <h2 class="mt-4 ">Brand</h2>
            <input type="text" name="brandFilter" id="brandFilter" value="" class="w-full p-2 border-2 border-teal-500 rounded-5">
            <h2 class="mt-4 ">Model</h2>
            <input type="text" name="modelFilter" id="modelFilter" value="" class="w-full p-2 border-2 border-teal-500 rounded-5">
            <h2 class="mt-4 ">Serial Number</h2>
            <input type="text" name="serialNumberFilter" id="serialNumberFilter" value="" class="w-full p-2 border-2 border-teal-500 rounded-5">
            <h2 class="mt-4 ">Estat</h2>
            <label><input type="radio" name="stateFilter" value="Borrowed"> Borrowed</label> <br>
            <label><input type="radio" name="stateFilter" value="Not borrowed"> Not borrowed</label> <br>
            <label ><input type="radio" name="stateFilter" value="All"> All</label> <br>
            <button type="submit" class="mt-4 w-full p-4 bg-teal-500 text-white border-none rounded-5 text-base hover:bg-teal-700 mx-auto mb-4">Filtrar</button>
            <button type="submit" name="filterAction" value="reset" class="w-full p-4 bg-teal-500 text-white border-none rounded-5 text-base hover:bg-teal-700 mx-auto mb-4">Borrar filtres</button>
            <input type="hidden" name="action" value="filter">
        </form>
    </div>
    <div class="content w-4/5 p-4 flex flex-wrap justify-between bg-white">
        @for ($i = 1; $i <= 15; $i++)
            <div class="instrument-card bg-white border-2 border-teal-500 p-4 mb-4">
                <h2 class="text-2xl text-teal-500">Instrumento {{ $i }}</h2>
                <p>Familia: InstrumentoFamilia{{ $i }}</p>
                <p>Tipo: InstrumentoTipo{{ $i }}</p>
                <p>Marca: InstrumentoMarca{{ $i }}</p>
                <p>Modelo: InstrumentoModelo{{ $i }}</p>
                <p>Número de serie: InstrumentoSerial{{ $i }}</p>
                <p>Fecha de adquisición: 2022-01-01</p>
                <p>Estado: Disponible</p>
                <p>Comentario: Este es un comentario para el instrumento {{ $i }}</p>
            </div>
        @endfor
    </div>
</div>
@endsection