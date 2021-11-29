@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('components.alerts')
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="title w-50">
                        <p class="mb-0 text-bold">
                            Selecione o tipo de conteúdo
                        </p>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.content.selectAction') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Tipo</label>
                            <select name="type" class="form-control">
                                @foreach($items as $type)
                                <option value="{{ $type->id }}">{{ $type->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Adicionar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection