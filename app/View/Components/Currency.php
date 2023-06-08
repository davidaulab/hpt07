<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Currency extends Component
{
    public $amount;
    public $currency;
    /**
     * Create a new component instance.
     */
    public function __construct($amount, $currency)
    {
        //
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $decimales = 2;
        $simboloDespues = true;
        $sepDecimal = ',';
        $sepMiles = '.';
        $simbolo = " €";
        if ($this->currency == 'USD') {
            $simboloDespues= false;
            $sepDecimal = '.';
            $sepMiles = ',';
            $simbolo = '$';
        }
        elseif ($this->currency == 'JPY') {
            $simbolo = 'Y';
        }
        elseif ($this->currency == 'GBP') {
            $simboloDespues= false;
            $sepDecimal = '.';
            $sepMiles = ',';
            $simbolo = 'L';
        }
        elseif ($this->currency == 'GBP') {

            $simbolo = '$';
        }
        else {
            $simbolo = $this->currency;
        }

        $data = number_format($this->amount, $decimales, $sepDecimal, $sepMiles);
        if ($simboloDespues == true) {
            $data .= $simbolo;
        }
        else {
            $data = $simbolo . $data;
        }

        return view('components.currency', compact ('data'));
    }
}
