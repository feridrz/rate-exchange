<?php
namespace App\Http\Controllers;

use App\Services\CurrencyConverter;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CurrencyConversionController extends Controller
{
    public function showForm()
    {
        $currencies = Currency::all();
        return view('convert', ['currencies' => $currencies]);
    }

    public function convert(Request $request, CurrencyConverter $converter)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric',
            'from_code' => 'required|string|exists:currencies,code',
            'to_code' => 'required|string|exists:currencies,code',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $convertedAmount = $converter->convert(
                $request->input('amount'),
                $request->input('from_code'),
                $request->input('to_code')
            );

            return redirect()->back()->with('converted_amount', $convertedAmount)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Conversion failed.')->withInput();
        }
    }
}
