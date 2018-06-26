@extends('adminlte::page')

@section('content')

<div class="row">
    <div class="col-lg-12">
        
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Create Payment Gateway</h3>
            </div>
            
            <div class="box-body">

                @if ($errors->count() > 0)
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-ban"></i> Erro!</h4>
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                  </div>
                @endif

                <form method="POST" action="{{ url(config('unipay.route.gateway', 'gateways'), $gateway->id) }}">

                    {!! csrf_field() !!}

                    <input type="hidden" name="_method" value="PUT" />
                
                    <div class="form-group">
                        <label class="control-label">Name</label>
                        <input type="text" name="name" value="{{ $gateway->name }}" class="form-control" placeholder="Define a gateway payment name." />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Description</label>
                        <textarea name="description" rows="5" class="form-control" placeholder="Define a gateway payment description.">{{ $gateway->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Account ID</label>
                        <input type="text" name="account_id" value="{{ $gateway->account_id }}" class="form-control" placeholder="Define a gateway payment account id." />
                    </div>

                    <div class="form-group">
                        <hr>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            
            </div>
        </div>

    </div>
</div>
    
@endsection