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
            $exchangeRates = ExchangeRate::with(['fromCurrency', 'toCurrency'])
                ->whereHas('fromCurrency', function($query) use ($search) {
                    $query->where('code', 'like', '%' . $search . '%');
                })
                ->orWhereHas('toCurrency', function($query) use ($search) {
                    $query->where('code', 'like', '%' . $search . '%');
                })
                ->paginate(15);
        } else {
            $exchangeRates = ExchangeRate::with(['fromCurrency', 'toCurrency'])->paginate(15);
        }

        if ($search) {
            $exchangeRates->appends(['search' => $search]);
        }

        return view('admin.exchange-rates', ['exchangeRates' => $exchangeRates]);
    }
}
