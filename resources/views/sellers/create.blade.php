@extends('adminlte::page')

@section('content')

<div class="row">
    <div class="col-lg-12">
        
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Novo Vendedor</h3>
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

                <form method="POST" action="{{ url(config('unipay.route.seller', 'sellers')) }}">

                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label class="control-label">Payment Gateway</label>
                        <select name="gateway_id" class="form-control">
                            <option value="">--SELECT--</option>
                            @foreach ($gateways as $gateway)
                                <option value="{{ $gateway->id }}" @if(old('gateway_id')) selected="selected" @endif >{{ $gateway->name }}</option>
                            @endforeach
                        </select>
                    </div>
               
                    <div class="form-group">
                        <label class="control-label">Nome</label>
                        <input type="text" name="person[first_name]" value="{{ old('person.first_name') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Sobrenome</label>
                        <input type="text" name="person[last_name]" value="{{ old('person.last_name') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">E-mail</label>
                        <input type="email" name="person[email]" value="{{ old('person.email') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Telefone</label>
                        <input type="text" name="person[phone]" value="{{ old('person.phone') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Data de Nascimento</label>
                        <input type="date" name="person[birth]" value="{{ old('person.birth') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">CPF</label>
                        <input type="text" name="person[cpf]" value="{{ old('person.cpf') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Estado</label>
                        <input type="text" name="person[state]" value="{{ old('person.state') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Cidade</label>
                        <input type="text" name="person[city]" value="{{ old('person.city') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">CEP</label>
                        <input type="text" name="person[postal]" value="{{ old('person.postal') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Bairro</label>
                        <input type="text" name="person[neighborhood]" value="{{ old('person.neighborhood') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Logradouro</label>
                        <input type="text" name="person[address]" value="{{ old('person.address') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Número</label>
                        <input type="text" name="person[number]" value="{{ old('person.number') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Complemento</label>
                        <input type="text" name="person[complement]" value="{{ old('person.complement') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Referência</label>
                        <input type="text" name="person[reference]" value="{{ old('person.reference') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="row col-lg-12">
                        <h3>Dados Empresa</h3>
                        <hr>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Nome da Empresa</label>
                        <input type="text" name="company[name]" value="{{ old('company.name') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Razão Social</label>
                        <input type="text" name="company[social_name]" value="{{ old('company.social_name') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">CNPJ</label>
                        <input type="text" name="company[cnpj]" value="{{ old('company.cnpj') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Data de Abertura</label>
                        <input type="date" name="company[opened_at]" value="{{ old('company.opened_at') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Telefone</label>
                        <input type="text" name="company[phone]" value="{{ old('company.phone') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Estado</label>
                        <input type="text" name="company[state]" value="{{ old('company.state') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Cidade</label>
                        <input type="text" name="company[city]" value="{{ old('company.city') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">CEP</label>
                        <input type="text" name="company[postal]" value="{{ old('company.postal') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Bairro</label>
                        <input type="text" name="company[neighborhood]" value="{{ old('company.neighborhood') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Logradouro</label>
                        <input type="text" name="company[address]" value="{{ old('company.address') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Número</label>
                        <input type="text" name="company[number]" value="{{ old('company.number') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Complemento</label>
                        <input type="text" name="company[complement]" value="{{ old('company.complement') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Site</label>
                        <input type="text" name="company[site]" value="{{ old('company.site') }}" class="form-control" placeholder="" />
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