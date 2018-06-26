@extends('adminlte::page')

@section('content')

<div class="row">
    <div class="col-lg-12">
        @if (session()->has('created') || session()->has('updated'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sucesso!</h4>
                {{ session()->has('created') ? session()->get('created') : session()->get('updated') }}
            </div>
        @endif        
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Merchants</h3>
                <div class="pull-right">
                    <a href="{{ url(config('unipay.route.merchant.name', 'merchants'), 'create') }}" class="btn btn-sm btn-success">Create New</a>
                </div>
            </div>
            
            <div class="box-body">

                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Account ID</th>
                            <th style="width: 15%">Action</th>
                        </tr>
                        <tr>
                            @foreach ($merchants as $gateway)
                                <td>{{ $gateway->id }}</td>
                                <td>{{ $gateway->name }}</td>
                                <td>{{ $gateway->description }}</td>
                                <td>{{ $gateway->account_id }}</td>
                                <td>
                                    <a href="{{ url(config('unipay.routes.gateway.name', 'merchants'), $gateway->id . '/edit') }}" class="btn btn-primary">
                                        <i class="fa fa-search"></i>
                                    </a>
                                    
                                </td>
                            @endforeach
                            
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>

    </div>
</div>
    
@endsection