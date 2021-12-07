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
                            Conteúdos
                        </p>
                    </div>

                    <div class="actions text-right w-50 d-flex">
                        <select class="form-control mr-1" id="single">
                            <option value>Todos os tipos</option>
                            <option value="true" {{ request()->get('single') == 'true' ? 'selected' : '' }}>Páginas</option>
                            <option value="false" {{ request()->get('single') == 'false' ? 'selected' : '' }}>Estrutura</option>
                        </select>
                        <select class="form-control mr-1" id="type">
                            <option value="">Todas as estruturas</option>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}" {{ request()->get('type') == $type->id ? 'selected' : '' }}>{{ $type->title }}</option>
                            @endforeach
                        </select>
                        <a class="btn btn-primary" href="{{ route('dashboard.content.select') }}">
                            Adicionar
                        </a>
                    </div>
                </div>
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Título</th>
                            <th>Tipo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td>#{{ $item->id }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->contentType->title }}</td>
                            <td>
                                <form action="{{ route('dashboard.content.destroy', $item->id) }}" method="post">
                                    <a href="{{ route('dashboard.content.show', $item->id) }}" class="btn badge badge-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn badge badge-danger">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script defer>
    $(document).ready(function() {
        $('#single').change(function() {
            var single = $(this).val();
            if (single) {
                window.location.href = "{{ route('dashboard.content.index') }}" + "?single=" + single;
            } else {
                window.location.href = "{{ route('dashboard.content.index') }}";
            }
        });
        $('#type').change(function() {
            var type = $(this).val();
            if (type) {
                window.location.href = "{{ route('dashboard.content.index') }}" + "?type=" + type;
            } else {
                window.location.href = "{{ route('dashboard.content.index') }}";
            }
        });
    });
</script>
@endsection