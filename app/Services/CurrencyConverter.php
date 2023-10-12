<?php

namespace App\Services;

use App\Models\Currency;
use App\Models\ExchangeRate;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CurrencyConverter
{
    public function convert($amount, $fromCode, $toCode)
    {
        $fromCurrency = Currency::where('code', $fromCode)->firstOrFail();
        $toCurrency = Currency::where('code', $toCode)->firstOrFail();

        $exchangeRate = ExchangeRate::where('from_currency_id', $fromCurrency->id)
            ->where('to_currency_id', $toCurrency->id)
            ->first();

        if (!$exchangeRate) {
            $fromToBaseRate = ExchangeRate::where('to_currency_id', $fromCurrency->id)
                ->where('from_currency_id', 1)
                ->firstOrFail();
            $baseToTargetRate = ExchangeRate::where('from_currency_id', 1)
                ->where('to_currency_id', $toCurrency->id)
                ->firstOrFail();
            $calculatedRate = $fromToBaseRate->rate * $baseToTargetRate->rate;
        } else {
            $calculatedRate = $exchangeRate->rate;
        }

        return $amount * $calculatedRate;
    }

}
