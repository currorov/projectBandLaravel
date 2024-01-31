<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #008080;
        }

        .instrument-card {
            background-color: #ffffff;
            border: 2px solid #008080;
            padding: 20px;
            margin-bottom: 20px;
            min-width: 300px;
            max-width: 400px;
            margin: 0 auto;
            text-align: left;
        }

        .instrument-type {
            font-size: 1.5rem;
            color: #008080;
            text-align: center;
            margin-bottom: 10px;
        }

        .instrument-info {
            margin-bottom: 10px;
        }

        .state-label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .text-red {
            color: #ff0000;
        }

        .text-green {
            color: #008000;
        }

        .comment {
            text-align: center;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .instrument-image {
            display: block;
            margin: 0 auto;
            width: 100px;
        }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    @foreach ($instruments as $instrument)
        <div class="instrument-card">
            <h2 class="instrument-type">{{ $instrument->type }}</h2>
            <div class="instrument-info">
                <p>Family: {{ $instrument->family }}</p>
                <p>Brand: {{ $instrument->brand }}</p>
                <p>Model: {{ $instrument->model }}</p>
                @if(!is_null($instrument->serial_number))
                    <p>Serial number: {{ $instrument->serial_number }}</p>
                @endif
                @if(!is_null($instrument->acquisition_date))
                    <p>Acquisition date: {{ $instrument->acquisition_date}}</p>
                @endif
                <div class="state-label">
                    State: <span class="{{ $instrument->state == 'lent' ? 'text-red' : 'text-green' }}">{{ $instrument->state }}</span>
                </div>
                <p class="comment">{{ $instrument->comment }}</p>
            </div>
            @if (!is_null($instrument->image) && file_exists($instrument->image))
                <img src="{{ $instrument->image }}" alt="Instrument image" class="instrument-image">
            @endif
        </div>
    @endforeach
</body>
</html>
