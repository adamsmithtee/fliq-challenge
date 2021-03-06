<?php


namespace Vanguard\Support\Plugins;


use Vanguard\Plugins\Plugin;
use Vanguard\Support\Sidebar\Item;

class Transaction extends Plugin
{
    public function sidebar()
    {
        return Item::create(__('Transaction'))
            ->route('transaction')
            ->icon('fas fa-chart-line')
            ->active("transaction*");
    }
}
