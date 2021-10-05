<div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-labelledby=""
     aria-hidden="true">
    <div class="modal-dialog modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(array('method' => 'post', 'route' => 'transaction.store', 'class' => 'form', 'id'=>'')) !!}
            {{ csrf_field() }}
            <div class="modal-body p-4">
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Customer</label>
                    {!! Form::select('customer_id', $customers, '',['id' => 'type', 'class' => 'form-control input-solid']) !!}
                </div>

                <div class="form-group">
                    <label for="amount" class="col-form-label">Amount</label>
                    <input type="number" class="form-control" id="amount" name="amount" required>
                </div>

                <div class="form-group">
                    <label for="currency" class="col-form-label">Destination Currency</label>
                    <input type="text" class="form-control" id="currency" name="destination_currency" required>
                </div>

                <div class="form-group">
                    <label for="status" class="col-form-label">Status</label>
                    {!! Form::select('status', $transaction_status, '',['id' => 'status', 'class' => 'form-control input-solid']) !!}
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
