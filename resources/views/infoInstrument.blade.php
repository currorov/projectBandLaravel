@extends('layouts.template')

@section('content')
<div class=" h-screen">
    <h1 class="text-center text-3xl md:text-4xl lg:text-5xl mb-7 text-teal-500 mt-4">{{ $instrument->family }} {{$instrument->brand}} {{$instrument->model}}</h1>
    @if (!is_null($instrument->image) && file_exists($instrument->image))
        <img src="{{ asset($instrument->image) }}" alt="Instrument image" class="mx-auto w-1/4">
    @else
        <img src="/uploads/instruments/trompet.png" alt="Isntrument image" class="mx-auto w-1/4">
    @endif
    <div class="info ml-10 mt-10 flex justify-between">
        <div>
            <h2 class="inline-block md:text-4xl text-teal-500 mr-40">Serial Number: {{$instrument->serial_number}}</h2>
            <h2 class="inline-block ml-40 md:text-4xl text-teal-500">Acquisition Date: {{$instrument->acquisition_date->format('Y-m-d')}}</h2>
        </div>
        <div class="mr-10">
            <a href="#" class="p-4 md:text-4xl bg-teal-500 text-white border-none rounded-5 text-base hover:bg-teal-700">
                <button type="button" class="btn">Edit</button>
            </a>
            <a href="#" class="p-4 md:text-4xl ml-4 bg-teal-500 text-white border-none rounded-5 text-base hover:bg-teal-700">
                <button type="button" class="btn">Delete</button>
            </a>
        </div>
    </div>
    <div class="mt-10 ml-10">
        <a href="{{ route('loadLoans', ['id' => $instrument->id]) }}" class="p-4 md:text-4xl @if(!session('activeTable') || session('activeTable') == 'loans') bg-teal-700 @else bg-teal-500 @endif text-white border-none rounded-5 text-base hover:bg-teal-700">
            <button type="button" class="btn">Loans</button>
        </a>
        <a href="{{ route('loadRevisions', ['id' => $instrument->id]) }}" class="p-4 md:text-4xl @if(session('activeTable') && session('activeTable') == 'revisions') bg-teal-700 @else bg-teal-500 @endif text-white border-none rounded-5 text-base hover:bg-teal-700">
            <button type="button" class="btn">Revisions</button>
        </a>
    </div>
    @if(!session('activeTable') || session('activeTable') == 'loans')
    <div class="bg-teal-500 h-auto w-5/6 mx-auto my-10 md:h-auto pt-3">
        <h1 class="text-center text-3xl md:text-4xl lg:text-5xl text-white">Loans</h1>
    
        @if(isset($loans))
            <table class="w-5/6 mt-5 bg-white mx-auto">
                <thead class="bg-teal-500 text-white">
                    <tr>
                        <th class="py-2 px-4 text-center">Musician Name</th>
                        <th class="py-2 px-4 text-center">Start Date</th>
                        <th class="py-2 px-4 text-center">End Date</th>
                        <th class="py-2 px-4 text-center">Observations</th>
                        <th class="py-2 px-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($loans as $loan)
                        <tr>
                            <td class="py-2 px-4 text-center">{{ $loan->musician_name }}</td>
                            <td class="py-2 px-4 text-center">{{ $loan->start_date->format('Y-m-d') }}</td>
                            <td class="py-2 px-4 text-center">{{ $loan->end_date->format('Y-m-d') }}</td>
                            <td class="py-2 px-4 text-center">{{ $loan->observations }}</td>
                            <td class="py-2 px-4 text-center">
                                <button class="bg-blue-500 text-white px-2 py-1 ">Edit</button>
                                <button class="bg-red-500 text-white px-2 py-1 ">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        <div class="flex justify-center mt-4 pb-5">
            <a href="#" class="p-4 md:text-4xl bg-white text-teal-500 border-none text-base hover:bg-gray-300">
                <button type="button" class="btn">New Loan</button>
            </a>
        </div>
    </div>
    
    @elseif(session('activeTable') && session('activeTable') == 'revisions')
    <div class="bg-teal-500 h-auto w-5/6 mx-auto my-10 md:h-auto pt-3">
        <h1 class="text-center text-3xl md:text-4xl lg:text-5xl text-white">Revisions</h1>
    
        @if(isset($revisions))
            <table class="w-5/6 mt-5 bg-white mx-auto">
                <thead class="bg-teal-500 text-white">
                    <tr>
                        <th class="py-2 px-4 text-center">Revision Date</th>
                        <th class="py-2 px-4 text-center">Company</th>
                        <th class="py-2 px-4 text-center">Observations</th>
                        <th class="py-2 px-4 text-center">Price</th>
                        <th class="py-2 px-4 text-center">Receipt</th>
                        <th class="py-2 px-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($revisions as $revisions)
                        <tr>
                            <td class="py-2 px-4 text-center">{{ $revisions->revision_date->format('Y-m-d') }}</td>
                            <td class="py-2 px-4 text-center">{{ $revisions->company }}</td>
                            <td class="py-2 px-4 text-center">{{ $revisions->observations }}</td>
                            <td class="py-2 px-4 text-center">{{ $revisions->price }}</td>
                            <td class="py-2 px-4 text-center">{{ $revisions->receipt }}</td>
                            <td class="py-2 px-4 text-center">
                                <button class="bg-blue-500 text-white px-2 py-1 ">Edit</button>
                                <button class="bg-red-500 text-white px-2 py-1 ">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        <div class="flex justify-center mt-4 pb-5">
            <a href="#" class="p-4 md:text-4xl bg-white text-teal-500 border-none text-base hover:bg-gray-300">
                <button type="button" class="btn">New Revision</button>
            </a>
        </div>
    </div>
@endif

</div>
@endsection