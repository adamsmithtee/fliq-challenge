<?php

namespace Vanguard\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Customer;
use Vanguard\Support\Enum\CustomerType;

class CustomerController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $query = Customer::query();
        $search = $request->search;
        $type = $request->type;
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        if ($type) {
            $query->where('type', $type);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where("name", "like", "%{$search}%");
            });
        }

        if ($start_date && $end_date) {
            $start_date_arr = explode("-",$start_date);
            $end_date_arr = explode("-",$end_date);

            $query->whereBetween('created_at', [Carbon::createFromDate($start_date_arr[0], $start_date_arr[1], $start_date_arr[2]),
                Carbon::createFromDate($end_date_arr[0], $end_date_arr[1], $end_date_arr[2])]);
        }

        $customers = $query->latest()
            ->with('transactions')
            ->get();

        $customers = collect($customers)->map(function ($customer){
            return [
                'name' => $customer->name,
                "amount" => $customer->transactions->sum('amount'),
                "count" => $customer->transactions->count(),
                "success" => $customer->transactions->where('status','Success')->sum('amount')
            ];

        });

        $customer_type = ['' => 'All']+CustomerType::type();
        return view('customer.index', compact('customer_type', 'customers'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $payload = $request->all();
        Validator::make($payload, [
            'name' => ['required'],
            'type' => ['required']
        ])->validate();

        Customer::create([
            'name' => $payload['name'],
            'type' => $payload['type']
        ]);
        return back()->with('success', 'Customer saved successfully');
    }
}
