<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    use \Dimsav\Translatable\Translatable;
    protected $guarded = [];
    public $translatedAttributes = ['title', 'short_description', 'description', 'extra_description'];
    public function discount($total)
    {
        if ($this->type == "amount") {
            if ($total > $this->discount_amount) {
                return $this->discount_amount;
            } else {
                return 0;
            }
        } elseif ($this->type == "percent") {
            //  return ($this->discount_amount * 0.01) * $total;
            //     DD($total, $this->discount_amount, ($this->discount_amount * 0.01) * $total, ($this->discount_amount / 100) * $total);
            return ($this->discount_amount / 100) * $total;
        } else {
            return 0;
        }
    }
    public function subtotal($total)
    {
        return $total - $this->discount($total);
    }
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
