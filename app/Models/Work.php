<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Work extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'position',
        'company_name',
        'company_link',
        'resp',
        'stack',
        'start_date',
        'finish_date',
        'active',
        'deleted_at'
    ];

    protected function companyName(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),
            set: fn (string $value) => strtolower($value),
        );
    }


    protected function startDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? \Carbon\Carbon::parse($value)->format('F Y') : null,
            set: fn ($value) => $value ? \Carbon\Carbon::createFromFormat('m-Y', $value)->startOfMonth() : null,
        );
    }


    protected function finishDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? \Carbon\Carbon::parse($value)->format('F Y') : "Present",
            set: fn ($value) => $value ? \Carbon\Carbon::createFromFormat('m-Y', $value)->startOfMonth() : null,
        );
    }


    public function respToUl()
    {
        $arr = explode('.', $this->resp);
        $arr = array_filter($arr);
        $res = [];
        if (count($arr)) {
            foreach ($arr as $el) {
                $res[] = trim($el);
            }
        }
        return $res;
    }

}
