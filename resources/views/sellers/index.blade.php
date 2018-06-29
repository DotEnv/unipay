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
                <h3 class="box-title">Vendedores</h3>
                <div class="pull-right">
                    <a href="{{ url(config('unipay.route.seller', 'sellers'), 'create') }}" class="btn btn-sm btn-success">Criar novo</a>
                </div>
            </div>
            
            <div class="box-body">

                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Account Type</th>
                            <th style="width: 15%">Action</th>
                        </tr>
                        <tr>
                            @foreach ($sellers as $seller)
                                <td>{{ $seller->id }}</td>
                                <td>{{ $seller->first_name . ' ' . $seller->last_name }}</td>
                                <td>{{ $seller->email }}</td>
                                <td>{{ $seller->gateway->name }}</td>
                                <td>
                                    <a href="{{ url(config('unipay.routes.seller', 'sellers') . '/'. $seller->id . '/edit') }}" class="btn btn-primary">
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