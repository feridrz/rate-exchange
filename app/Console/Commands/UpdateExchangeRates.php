<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Currency;
use App\Models\ExchangeRate;
use Illuminate\Support\Facades\Log;

class UpdateExchangeRates extends Command
{
    protected $signature = 'update:exchange-rates';
    protected $description = 'Update exchange rates from Fixer.io';

    public function handle()
    {
        $apiKey = env('FIXER_IO_API_KEY');
        $endpoint = "http://data.fixer.io/api/latest?access_key=$apiKey";

        $response = Http::get($endpoint);

        if ($response->successful()) {
            $data = $response->json();
            $baseCurrencyCode = $data['base'];
            $rates = $data['rates'];

            $baseCurrency = Currency::firstOrCreate(['code' => $baseCurrencyCode]);

            foreach ($rates as $code => $rate) {
                $currency = Currency::firstOrCreate(['code' => $code]);

                ExchangeRate::updateOrCreate(
                    ['from_currency_id' => $baseCurrency->id, 'to_currency_id' => $currency->id],
                    ['rate' => $rate]
                );
                foreach ($rates as $innerCode => $innerRate) {
                    if ($code !== $innerCode) {
                        $innerCurrency = Currency::firstOrCreate(['code' => $innerCode]);
                        $convertedRate = $innerRate / $rate;



echo $innerCode;
                        if (abs($convertedRate) > 100000) {
                            Log::error("Unrealistic exchange rate: {$convertedRate} for {$code} to {$innerCode}");
                        } else {
                            ExchangeRate::updateOrCreate(
                                ['from_currency_id' => $currency->id, 'to_currency_id' => $innerCurrency->id],
                                ['rate' => $convertedRate]
                            );
                        }
                    }
                }
            }
        } else {
            Log::error("Failed to update exchange rates from Fixer.io: {$response->status()}");
        }
    }

}
