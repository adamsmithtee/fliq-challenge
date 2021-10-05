<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby=""
     aria-hidden="true">
    <div class="modal-dialog modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(array('method' => 'post', 'route' => 'customer.store', 'class' => 'form', 'id'=>'')) !!}
            {{ csrf_field() }}
            <div class="modal-body p-4">
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Customer Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Type</label>
                    {!! Form::select('type',$customer_type, '',['id' => 'type', 'class' => 'form-control input-solid']) !!}
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
