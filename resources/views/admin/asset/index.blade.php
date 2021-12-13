@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('components.alerts')
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="title">
                        <p class="mb-0 text-bold">
                            Arquivos
                        </p>
                    </div>

                    <div class="actions text-right w-100">
                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#newFolderModal">
                            Criar pasta
                        </button>
                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#newFileModal">
                            Upload de arquivo
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            @php $route = route('assets') . '?folder=' @endphp
                            <li class="breadcrumb-item"><a href="{{ route('assets') }}"><i class="fas fa-home"></i></a></li>
                            @foreach($breadcrumbs as $b)
                            @php $route .= $b.'/' @endphp
                            @if($loop->last)
                            <li class="breadcrumb-item active" aria-current="page">{{ $b }}</li>
                            @else
                            <li class="breadcrumb-item"><a href="{{ $route }}">{{ $b }}</a></li>
                            @endif
                            @endforeach
                        </ol>
                    </nav>

                    <ul class="list-group">
                        @foreach($directories as $directory)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('assets').'?folder='.$directory }}">
                                <i class="fas fa-folder"></i>
                                {{ $directory }}
                            </a>
                            <div class="actions">
                                <form action="{{ route('assets.deleteFolder', $directory) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn badge badge-danger">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                            </div>
                        </li>
                        @endforeach
                        @foreach($files as $file)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ url('storage/'.$file) }}" target="_blank">
                                <i class="fas fa-file mr-1"></i>
                                {{ $file }}
                            </a>
                            <div class="actions">
                                <form action="{{ route('assets.deleteFile') }}" method="post">
                                    <a href="{{ url('storage/'.$file) }}" target="_blank" class="btn badge badge-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="file" value="{{ $file }}">
                                    <button class="btn badge badge-danger">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                            </div>
                        </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="newFolderModal" tabindex="-1" aria-labelledby="newFolderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="{{ route('assets.newFolder') }}">
            @csrf
            <input type="hidden" name="parentFolder" value="{{ $folder }}">
            <div class="modal-header">
                <h5 class="modal-title" id="newFolderModalLabel">Criar nova pasta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" name="folder" id="folderName" placeholder="Nome da pasta">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="newFileModal" tabindex="-1" aria-labelledby="newFileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="{{ route('assets.newFile') }}" enctype='multipart/form-data'>
            @csrf
            <input type="hidden" name="folder" value="{{ $folder }}">
            <div class="modal-header">
                <h5 class="modal-title" id="newFileModalLabel">Upload de arquivo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="file" class="form-control" name="file" id="file">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
</div>
@endsection