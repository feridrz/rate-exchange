<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class ExchangeRate extends Model
{
    protected $fillable = ['from_currency_id', 'to_currency_id', 'rate'];

    public function fromCurrency()
    {
        return $this->belongsTo(Currency::class, 'from_currency_id');
    }

    public function toCurrency()
    {
        return $this->belongsTo(Currency::class, 'to_currency_id');
    }

    public function toSearchableArray()
    {
        return [
            'from_currency_code' => $this->fromCurrency->code,
            'to_currency_code' => $this->toCurrency->code,
        ];
    }

    public function searchableAs()
    {
        return 'my_custom_index_name';
    }

}
