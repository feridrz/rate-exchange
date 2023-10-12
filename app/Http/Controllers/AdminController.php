<?php
namespace App\Http\Controllers;

use App\Models\ExchangeRate;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showExchangeRates(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $exchangeRates = ExchangeRate::search($search)->paginate(15);
        } else {
            $exchangeRates = ExchangeRate::with(['fromCurrency', 'toCurrency'])->paginate(15);
        }

        if($search) {
            $exchangeRates->appends(['search' => $search]);
        }

        return view('admin.exchange-rates', ['exchangeRates' => $exchangeRates]);
    }
}
