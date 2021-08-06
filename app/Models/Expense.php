<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'description', 'type', 'amount', 'photo', 'expanse_date'];

    protected $dates = ['expanse_date'];

    public function getAmountAttribute($value)
    {
        return $value / 100;
    }

    public function setAmountAttribute($value)
    {
        return $this->attributes['amount'] = $value * 100;
    }

    public function setExpenseDateAttribute($value)
    {
        return $this->attributes['expense_date'] = (\DateTime::createFromFormat('d/m/Y H:i:s', $value))->format('Y-m-d H:i:s');
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
