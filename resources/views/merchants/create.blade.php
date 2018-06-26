@extends('adminlte::page')

@section('content')

<div class="row">
    <div class="col-lg-12">
        
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">New Merchant</h3>
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

                <form method="POST" action="{{ url(config('unipay.route.merchant', 'merchants')) }}">

                    {!! csrf_field() !!}
               
                    <div class="form-group">
                        <label class="control-label">Nome</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">E-mail</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Telefone</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Data de Nascimento</label>
                        <input type="date" name="birth" value="{{ old('birth') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">CPF</label>
                        <input type="text" name="cpf" value="{{ old('cpf') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Estado</label>
                        <select id="state_id" name="state_id" class="form-control">
                            <option>--SELECIONE--</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Cidade</label>
                        <input type="text" name="city" value="{{ old('city') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">CEP</label>
                        <input type="text" name="postal" value="{{ old('postal') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Bairro</label>
                        <input type="text" name="neighborhood" value="{{ old('neighborhood') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Logradouro</label>
                        <input type="text" name="address" value="{{ old('address') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Número</label>
                        <input type="text" name="number" value="{{ old('number') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Complemento</label>
                        <input type="text" name="complement" value="{{ old('complement') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Referência</label>
                        <input type="text" name="reference" value="{{ old('reference') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="row col-lg-12">
                        <h3>Dados Empresa</h3>
                        <hr>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Nome da Empresa</label>
                        <input type="text" name="company_name" value="{{ old('company_name') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Razão Social</label>
                        <input type="text" name="social_name" value="{{ old('social_name') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">CNPJ</label>
                        <input type="text" name="cnpj" value="{{ old('cnpj') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Data de Abertura</label>
                        <input type="date" name="opened_at" value="{{ old('opened_at') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Telefone</label>
                        <input type="text" name="company_phone" value="{{ old('company_phone') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Estado</label>
                        <select id="company_state_id" name="company_state_id" class="form-control">
                            <option value="">--SELECIONE--</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Cidade</label>
                        <input type="text" name="company_city" value="{{ old('company_city') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">CEP</label>
                        <input type="text" name="company_postal" value="{{ old('company_postal') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Bairro</label>
                        <input type="text" name="company_neighborhood" value="{{ old('company_neighborhood') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Logradouro</label>
                        <input type="text" name="company_address" value="{{ old('company_address') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Número</label>
                        <input type="text" name="company_number" value="{{ old('company_number') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Complemento</label>
                        <input type="text" name="company_complement" value="{{ old('company_complement') }}" class="form-control" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Site</label>
                        <input type="text" name="site" value="{{ old('site') }}" class="form-control" placeholder="" />
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

@section('js')

<script>

let states = [
    {'text' : 'AC', 'id' : 1},
    {'text' : 'AL', 'id' : 2},
    {'text' : 'AP', 'id' : 3},
    {'text' : 'AM', 'id' : 4},
    {'text' : 'BA', 'id' : 5},
    {'text' : 'CE', 'id' : 6},
    {'text' : 'DF', 'id' : 7},
    {'text' : 'ES', 'id' : 8},
    {'text' : 'GO', 'id' : 9},
    {'text' : 'MA', 'id' : 10},
    {'text' : 'MT', 'id' : 11},
    {'text' : 'MS', 'id' : 12},
    {'text' : 'MG', 'id' : 13},
    {'text' : 'PA', 'id' : 14},
    {'text' : 'PB', 'id' : 15},
    {'text' : 'PR', 'id' : 16},
    {'text' : 'PE', 'id' : 17},
    {'text' : 'PI', 'id' : 18},
    {'text' : 'RJ', 'id' : 19},
    {'text' : 'RN', 'id' : 20},
    {'text' : 'RS', 'id' : 21},
    {'text' : 'RO', 'id' : 22},
    {'text' : 'RR', 'id' : 23},
    {'text' : 'SC', 'id' : 24},
    {'text' : 'SP', 'id' : 25},
    {'text' : 'SE', 'id' : 26},
    {'text' : 'TO', 'id' : 27}
];

$('#state_id').select2({
    data: states
});
$('#company_state_id').select2({
    data: states
});

@if (old('state_id'))
    $('#state_id').val({{ old('state_id') }}).trigger('change');
@endif

@if (old('company_state_id'))
    $('#company_state_id').val({{ old('company_state_id') }}).trigger('change');
@endif
</script>

@stop

@endsection