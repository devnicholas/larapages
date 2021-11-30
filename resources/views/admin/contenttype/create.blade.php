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
                            Criar novo registro
                        </p>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.contenttype.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Título</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Slug</label>
                            <input type="text" name="slug" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Template</label>
                            <input type="text" name="template" class="form-control">
                        </div>
                        <div class="border">
                            <div class="d-flex align-items-center justify-content-between">
                                <label style="margin: 0 5px;">Campos</label>
                                <button type="button" class="btn btn-primary add-field">
                                    Adicionar campo
                                </button>
                            </div>
                            <div class="form-group d-flex mt-2">
                                <input type="text" name="fields[1][name]" placeholder="Título" class="form-control">
                                <input type="text" name="fields[1][slug]" placeholder="Slug" class="form-control">
                                <select name="fields[1][type]" class="form-control">
                                    <option value>Tipo do campo</option>
                                    <option value="text">Texto</option>
                                    <option value="textarea">Textarea</option>
                                    <option value="editor">Editor</option>
                                    <option value="boolean">Booleano</option>
                                    <option value="image">Imagem</option>
                                </select>
                            </div>
                        </div>
                        <div class="custom-control custom-switch mt-2">
                            <input type="checkbox" name="single" class="custom-control-input" id="single">
                            <label class="custom-control-label" for="single">Conteúdo único</label>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script defer>
    $(document).ready(function() {
        var fields = 2;
        $('.add-field').on('click', function() {
            $('.border').append(`
                <div class="form-group d-flex mt-2">
                    <input type="text" name="fields[${fields}][name]" placeholder="Título" class="form-control">
                    <input type="text" name="fields[${fields}][slug]" placeholder="Slug" class="form-control">
                    <select name="fields[${fields}][type]" class="form-control">
                        <option value>Tipo do campo</option>
                        <option value="text">Texto</option>
                        <option value="textarea">Textarea</option>
                        <option value="editor">Editor</option>
                        <option value="boolean">Booleano</option>
                        <option value="image">Imagem</option>
                    </select>
                    <button class="btn badge badge-danger removeField">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `);
            fields++;
        });
        $('.border').on('click', '.removeField', function() {
            $(this).parent().remove();
        });
    });
</script>
@endsection