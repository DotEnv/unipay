@extends('adminlte::page')

@section('content')

<div class="row">
    <div class="col-lg-12">
        
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Editar #{{ $seller->first_name }}</h3>
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

                <form method="POST" action="{{ url(config('unipay.route.seller', 'sellers'), $seller->id) }}">

                    {!! csrf_field() !!}

                    <input type="hidden" name="_method" value="PUT" />

                    <div class="form-group">
                        <label class="control-label">Payment Gateway</label>
                        <select name="gateway_id" class="form-control">
                            <option value="">--SELECT--</option>
                            @foreach ($gateways as $gateway)
                                <option value="{{ $gateway->id }}" @if($seller->gateway_id) selected="selected" @endif >{{ $gateway->name }}</option>
                            @endforeach
                        </select>
                    </div>                    
                
                    <div class="form-group">
                        <label class="control-label">Nome</label>
                        <input type="text" name="person[first_name]" value="{{ $seller->first_name }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Nome</label>
                        <input type="text" name="person[last_name]" value="{{ $seller->last_name }}" class="form-control" placeholder="" />
                    </div>                    

                    <div class="form-group">
                        <label class="control-label">E-mail</label>
                        <input type="email" name="person[email]" value="{{ $seller->email }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Telefone</label>
                        <input type="text" name="person[phone]" value="{{ $seller->seeFields->person->phone }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Data de Nascimento</label>
                        <input type="date" name="person[birth]" value="{{ $seller->seeFields->person->birth }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">CPF</label>
                        <input type="text" name="person[cpf]" value="{{ $seller->seeFields->person->cpf }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Estado</label>
                        <input type="text" name="person[state]" value="{{ $seller->first_name }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Cidade</label>
                        <input type="text" name="person[city]" value="{{ $seller->seeFields->person->city }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">CEP</label>
                        <input type="text" name="person[postal]" value="{{ $seller->seeFields->person->postal }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Bairro</label>
                        <input type="text" name="person[neighborhood]" value="{{ $seller->seeFields->person->neighborhood }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Logradouro</label>
                        <input type="text" name="person[address]" value="{{ $seller->seeFields->person->address }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Número</label>
                        <input type="text" name="person[number]" value="{{ $seller->seeFields->person->number }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Complemento</label>
                        <input type="text" name="person[complement]" value="{{ $seller->seeFields->person->complement }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Referência</label>
                        <input type="text" name="person[reference]" value="{{ $seller->seeFields->person->reference }}" class="form-control" placeholder="" />
                    </div>

                    <div class="row col-lg-12">
                        <h3>Dados Empresa</h3>
                        <hr>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Nome da Empresa</label>
                        <input type="text" name="company[name]" value="{{ $seller->seeFields->company->name }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Razão Social</label>
                        <input type="text" name="company[social_name]" value="{{ $seller->seeFields->company->social_name }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">CNPJ</label>
                        <input type="text" name="company[cnpj]" value="{{ $seller->seeFields->company->cnpj }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Data de Abertura</label>
                        <input type="date" name="company[opened_at]" value="{{ $seller->seeFields->company->opened_at }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Telefone</label>
                        <input type="text" name="company[phone]" value="{{ $seller->seeFields->company->phone }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Estado</label>
                        <input type="text" name="company[state]" value="{{ $seller->seeFields->company->state }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Cidade</label>
                        <input type="text" name="company[city]" value="{{ $seller->seeFields->company->city }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">CEP</label>
                        <input type="text" name="company[postal]" value="{{ $seller->seeFields->company->postal }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Bairro</label>
                        <input type="text" name="company[neighborhood]" value="{{ $seller->seeFields->company->neighborhood }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Logradouro</label>
                        <input type="text" name="company[address]" value="{{ $seller->seeFields->company->address }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Número</label>
                        <input type="text" name="company[number]" value="{{ $seller->seeFields->company->number }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Complemento</label>
                        <input type="text" name="company[complement]" value="{{ $seller->seeFields->company->complement }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Site</label>
                        <input type="text" name="company[site]" value="{{ $seller->seeFields->company->site }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <hr>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            
            </div>
        </div>

    </div>
</div>

@endsection