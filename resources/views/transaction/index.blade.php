@extends('layouts.app')

@section('page-title', __('Transaction'))
@section('page-heading', __('Transaction'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        Transaction
    </li>
@stop

@section('content')

    @include('partials.messages')

    <div class="card">
        <div class="card-body">

            <form action="" method="GET" id="txn_form" class="pb-2 mb-3 border-bottom-light">
                <div class="row my-3 flex-md-row flex-column-reverse">
                    <div class="col-md-3 mt-2 mt-md-0">
                        {!!
                            Form::select(
                                'status',
                                $transaction_status,
                                Request::get('status'),
                                ['id' => 'status', 'class' => 'form-control input-solid']
                            )
                        !!}
                    </div>
                    <!-- date -->
                    <div class="col-md-6">
                        <div class="inp d-flex input-daterange">
                            <input type="text" name="start_date"
                                   value="{{ Request::get('start_date') }}"
                                   class="form-control justify-content-around"
                                   placeholder="start date"
                                   id="start" />
                            <input type="text" name="end_date"
                                   value="{{ Request::get('end_date') }}"
                                   class="form-control"
                                   placeholder="end date"
                                   id="end" />
                            <button type="submit" class="btn btn-primary" style="border-radius: 0"> filter</button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <a href="#" class="btn btn-primary btn-rounded float-right" data-target="#transactionModal" data-toggle="modal">
                            <i class="fas fa-plus mr-2"></i>
                            Add Transaction
                        </a>
                    </div>
                </div>
                <div class="row my-3 mt-4 flex-md-row flex-column-reverse">
                    <div class="col-md-8"></div>
                    <!-- Search -->
                    <div class="col-md-4 mt-md-0 mt-2">
                        <div class="input-group custom-search-form">
                            <input type="text"
                                   class="form-control input-solid"
                                   name="search"
                                   value="{{ Request::get('search') }}"
                                   placeholder="@lang('Search...')">

                            <span class="input-group-append">
                                @if (Request::has('search') && Request::get('search') != '')
                                    <a href="{{ route('transaction') }}"
                                       class="btn btn-light d-flex align-items-center text-muted"
                                       role="button">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                                <button class="btn btn-light" type="submit" id="search-users-btn">
                                    <i class="fas fa-search text-muted"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </form>

            <div class="table-responsive" id="users-table-wrapper">
                <table class="table table-borderless table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Customer Name</th>
                        <th> Amount</th>
                        <th>Destination Currency</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if (count($transactions))
                            @php $i = 0 @endphp
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $transaction->customer->name}}</td>
                                    <td>{{ number_format($transaction->amount ,2) }}</td>
                                    <td>{{ $transaction->destination_currency }}</td>
                                    <td>{{ $transaction->status }}</td>
                                    <td>{{ $transaction->created_at->format(config('app.date_format')) }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7"><em>@lang('No records found.')</em></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        {!! $transactions->render() !!}

    @include('transaction.add')
@stop
