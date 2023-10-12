<!DOCTYPE html>
<html>
<head>
    <title>Currency Converter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h1 {
            color: #333366;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            width: 300px;
        }
        label {
            display: block;
            margin-bottom: 10px;
            color: #555;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
            border-radius: 5px;
            width: 100%;
        }
        button:hover {
            background-color: white;
            color: black;
            border: 1px solid #4CAF50;
        }
        h2 {
            color: #4CAF50;
        }
    </style>
</head>
<body>
@auth
    <a href="{{ route('admin.exchange-rates') }}" class="btn">Admin Exchange Rates</a>
@else
    <a href="{{ route('login') }}" class="btn">Login</a>
@endauth

<h1>Currency Converter</h1>
<form method="POST" action="{{ route('convert.currency') }}">
    @csrf
    <label>Amount:</label>
    <input type="number" name="amount" required><br>

    <label>From:</label>
    <select name="from_code" required>
        @foreach($currencies as $currency)
            <option value="{{ $currency->code }}">{{ $currency->code }}</option>
        @endforeach
    </select><br>

    <label>To:</label>
    <select name="to_code" required>
        @foreach($currencies as $currency)
            <option value="{{ $currency->code }}">{{ $currency->code }}</option>
        @endforeach
    </select><br>

    <button type="submit">Convert</button>
</form>

@if(session('converted_amount'))
    <h2>Converted Amount: {{ session('converted_amount') }}</h2>
@endif
</body>
</html>
