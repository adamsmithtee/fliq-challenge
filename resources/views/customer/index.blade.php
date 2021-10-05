@extends('layouts.app')

@section('page-title', __('Customer'))
@section('page-heading', __('Customer'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
       Customer
    </li>
@stop

@section('content')

    @include('partials.messages')

    <div class="card">
        <div class="card-body">

            <form action="" method="GET" id="customers_form" class="pb-2 mb-3 border-bottom-light">
                <div class="row my-3 flex-md-row flex-column-reverse">
                    <div class="col-md-3 mt-2 mt-md-0">
                        {!!
                            Form::select(
                                'type',
                                $customer_type,
                                Request::get('type'),
                                ['id' => 'type', 'class' => 'form-control input-solid']
                            )
                        !!}
                    </div>
                    <!-- date -->
                    <div class="col-md-6 mt-2 mt-md-0">
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
                    <div class="col-md-3 mt-2 mt-md-0">
                        <a href="#" class="btn btn-primary btn-rounded float-right" data-target="#customerModal" data-toggle="modal">
                            <i class="fas fa-plus mr-2"></i>
                                Add Customer
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
                                   placeholder="@lang('Search for customers...')">

                            <span class="input-group-append">
                                @if (Request::has('search') && Request::get('search') != '')
                                    <a href="{{ route('customer') }}"
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
                        <th> Total transaction amount</th>
                        <th>Total transaction number</th>
                        <th>Total successful transaction</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($customers))
                        @php $i = 0 @endphp
                        @foreach ($customers as $customer)
                            <tr>
                                <td>{{++$i}}</td>
                                <td>{{ $customer['name'] }}</td>
                                <td>{{ number_format($customer['amount'] ,2) ?: '0.00'}}</td>
                                <td>{{$customer['count']}}</td>
                                <td>{{ number_format($customer['success']) ?: '0.00'}}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5"><em>@lang('No records found.')</em></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
{{--    {!! $customers->render() !!}--}}
    @include('customer.add')
@stop

@section('scripts')
    <script>
        $("#status").change(function () {
            $("#users-form").submit();
        });
    </script>
@stop
