<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AssetsController extends Controller
{
    public function index(Request $request)
    {
        $folder = $request->folder ?? '/';
        $files = Storage::files($folder);
        $directories = Storage::directories($folder);

        $breadcrumbs = $folder !== '/' ? explode('/', $folder) : [];

        return view('admin.asset.index', compact('directories', 'files', 'folder', 'breadcrumbs'));
    }

    public function newFolder(Request $request)
    {
        $parent = $request->parentFolder ?? '';
        Storage::makeDirectory($parent . '/' . $request->folder);

        $route = route('assets') . '?' . http_build_query(['folder' => $parent . '/' . $request->folder]);

        return redirect($route)->with('success', 'Pasta criada com sucesso');
    }

    public function deleteFolder($folder)
    {
        Storage::deleteDirectory($folder);

        return redirect()->route('assets')->with('success', 'Pasta removida com sucesso');
    }

    public function newFile(Request $request)
    {
        $file = $request->file;

        $destinationPath = $request->folder;
        $name = $file->getClientOriginalName();

        $upload = $file->storeAs($destinationPath, $name);

        if (!$upload) return redirect()->back()->with('error', 'Falha ao fazer upload de arquivo');

        $route = route('assets') . '?' . http_build_query(['folder' => $destinationPath]);

        return redirect($route)->with('success', 'Arquivo enviado com sucesso');
    }

    public function deleteFile(Request $request)
    {
        $file = $request->file;
        Storage::delete($file);

        return redirect()->route('assets')->with('success', 'Arquivo removido com sucesso');;
    }
}
