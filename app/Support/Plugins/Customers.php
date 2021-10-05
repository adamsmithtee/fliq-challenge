<?php


namespace Vanguard\Support\Plugins;


use Vanguard\Plugins\Plugin;
use Vanguard\Support\Sidebar\Item;

class Customers extends Plugin
{
    public function sidebar()
    {
        return Item::create(__('Customer'))
            ->route('customer')
            ->icon('fas fa-user')
            ->active("customer*");
    }
}
