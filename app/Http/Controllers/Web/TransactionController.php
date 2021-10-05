<?php

namespace Vanguard\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Vanguard\Customer;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Support\Enum\CustomerType;
use Vanguard\Support\Enum\TransactionStatus;
use Vanguard\Transaction;

class TransactionController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $status = $request->status;
        $search = $request->search;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $query = Transaction::query();

        if ($status) {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where("destination_currency", "like", "%{$search}%");
                $q->orWhereHas('customer', function ($qu) use($search){
                    $qu->where('name', "like", "%{$search}%");
                });
            });
        }

        if ($start_date && $end_date) {
            $start_date_arr = explode("-",$start_date);
            $end_date_arr = explode("-",$end_date);
            $query->whereBetween('created_at', [Carbon::createFromDate($start_date_arr[0], $start_date_arr[1], $start_date_arr[2]),
                Carbon::createFromDate($end_date_arr[0], $end_date_arr[1], $end_date_arr[2])]);
        }

        $transactions = $query->latest()->paginate(20);

        if ($status){
            $transactions->appends(['status' => $status]);
        }

        if ($search){
            $transactions->appends(['search' => $search]);
        }

        if ($start_date) {
            $transactions->appends(['start_date' => $start_date, 'end_date'=>$end_date]);
        }

        $transaction_status = ['' => 'All']+TransactionStatus::status();
        $customers = Customer::pluck('name', '_id')->toArray();
        $customers = ['' => 'All']+$customers;
        return view('transaction.index', compact('transaction_status', 'customers', 'transactions'));
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
            'customer_id' => ['required'],
            'amount' => ['required'],
            'destination_currency' => ['required'],
            'status' => ['required']
        ])->validate();

        Transaction::create([
            'customer_id' => $payload['customer_id'],
            'amount' => $payload['amount'],
            'destination_currency' => $payload['destination_currency'],
            'status' => $payload['status']
        ]);
        return back()->with('success', 'Transaction saved successfully');

    }
}
