@extends('layouts.template')

@section('filesjs')
    <script src="{{ asset('js/scriptMainShowMore.js') }}"></script>
@endsection

@section('content')
<div class="main-content flex">
    <div class="sidebar bg-white border-r-2 border-teal-500 w-1/5 p-4 flex flex-col text-center text-base">
        <h1 class="text-2xl mb-2 text-teal-500">Cerca</h1>
        <form id="filterForm" action="{{route('filter')}}" method="POST" class="text-center items-center">
            @csrf
            <h2 class="mt-2 ">Family</h2>
            <div class="mt-3">
            @foreach ($familys as $family)
                <input type="checkbox" name="familyfilter[]" value="{{ $family }}" @if(isset($familyfilter) && in_array($family, $familyfilter)) checked @endif> {{ $family }} <br>
            @endforeach
            </div>
            <h2 class="mt-4 ">Brand</h2>
            <input type="text" name="brandFilter" id="brandFilter" value="{{ old('brandFilter', isset($brandfilter) ? $brandfilter : '') }}" class="w-full p-2 border-2 border-teal-500 rounded-5">
            <h2 class="mt-4 ">Model</h2>
            <input type="text" name="modelFilter" id="modelFilter" value="{{ old('modelFilter', isset($modelfilter) ? $modelfilter : '') }}" class="w-full p-2 border-2 border-teal-500 rounded-5">
            <h2 class="mt-4 ">Serial Number</h2>
            <input type="text" name="serialNumberFilter" id="serialNumberFilter" value="{{ old('serialNumberFilter', isset($serialfilter) ? $serialfilter : '') }}" class="w-full p-2 border-2 border-teal-500 rounded-5">
            <h2 class="mt-4 ">State</h2>
            <label><input type="radio" name="stateFilter" value="lent" @if(isset($statefilter)) {{ $statefilter == 'lent' ? 'checked' : '' }} @endif> Lent</label> <br>
            <label><input type="radio" name="stateFilter" value="available" @if(isset($statefilter)) {{ $statefilter == 'available' ? 'checked' : '' }} @endif> Available</label> <br>
            <label><input type="radio" name="stateFilter" value="all" {{ !isset($statefilter) || $statefilter == 'all' ? 'checked' : '' }}> All</label> <br>
            <button type="submit" class="mt-4 w-full p-4 bg-teal-500 text-white border-none rounded-5 text-base hover:bg-teal-700 mx-auto mb-4">Filtrar</button>
            <button type="button" onclick="resetFilters()" class="w-full p-4 bg-teal-500 text-white border-none rounded-5 text-base hover:bg-teal-700 mx-auto mb-4">Borrar filtros</button>            <input type="hidden" name="action" value="filter">
        </form>
    </div>
    <div class="content w-4/5 p-4 flex flex-wrap justify-between bg-white">
        @foreach ($arrayInstruments as $instrument)
            <div class="instrument-card bg-white border-2 border-teal-500 p-4 mb-4 min-w-64 max-w-xs mx-auto" >
                <h2 class="text-2xl text-teal-500 text-center"> {{ $instrument->type }}</h2>
                <p>Family: {{ $instrument->family }}</p>
                <p>Brand: {{ $instrument->brand }}</p>
                <p>Model: {{ $instrument->model }}</p>
                @if(!is_null($instrument->serial_number))
                <p>Serial number: {{ $instrument->serial_number }}</p>
                @endif
                @if(!is_null($instrument->acquisition_date))
                <p>Acquisition date: {{ $instrument->acquisition_date}}</p>
                @endif
                @if($instrument->state == "lent")
                    <p>State: <a class="text-red-500">{{ $instrument->state }}</a></p>
                @else
                    <p>State: <a class="text-green-500">{{ $instrument->state }}</a></p>
                @endif
                <p class="text-center mt-2 mb-4">{{ $instrument->comment }}</p>
                @if (!is_null($instrument->image) && file_exists($instrument->image))
                    <img src="{{ $instrument->image }}" alt="Isntrument image" class="mx-auto w-2/4">
                @else
                    <img src="/uploads/instruments/trompet.png" alt="Isntrument image" class="mx-auto w-2/4">
                @endif
                <form action="">
                    @csrf
                    <input type="submit" value="More Infomation" class="mt-4 w-full p-4 bg-teal-500 text-white border-none rounded-5 text-base hover:bg-teal-700 mx-auto mb-4">
                </form>
            </div>
        @endforeach
    </div>
</div>
@endsection