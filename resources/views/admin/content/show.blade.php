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
                            Editar registro
                        </p>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.content.update', $item->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="content_type_id" value="{{ $item->contentType->id }}">
                        @if(!$item->contentType->single)
                            <div class="form-group">
                                <label>Título</label>
                                <input type="text" name="title" class="form-control" value="{{ $item->title }}">
                            </div>
                            <div class="form-group">
                                <label>Slug</label>
                                <input type="text" name="slug" class="form-control" value="{{ $item->slug }}">
                            </div>
                        @endif
                        <div class="border p-1">
                            @include('components.fields', ['type' => $item->contentType, 'item' => $item])
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