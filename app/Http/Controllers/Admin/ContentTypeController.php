<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DB\ContentTypes;
use Illuminate\Http\Request;

class ContentTypeController extends Controller
{
    private $defaultRules = [
        'title' => 'required',
        'template' => 'required',
    ];
    private $fields = [
        'title', 'template', 'fields',
    ];
    private $slugRoutes = 'contenttype';

    public function index()
    {
        $items = ContentTypes::get();
        return view('admin.' . $this->slugRoutes . '.index', compact('items'));
    }
    public function store(Request $request)
    {
        $this->validate($request, $this->defaultRules, $this->messages);
        $data = $request->only($this->fields);
        try {
            if($request->input('single'))
                $data['single'] = true;
            $data['fields'] = json_encode($data['fields']);
            ContentTypes::create($data);
            return redirect()->route('dashboard.' . $this->slugRoutes . '.index')->with('success', 'Item salvo com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao salvar: ' . $e->getMessage());
        }
    }
    public function create()
    {
        return view('admin.' . $this->slugRoutes . '.create');
    }
    public function show($id)
    {
        $item = ContentTypes::find($id);
        return view('admin.' . $this->slugRoutes . '.show', compact('item'));
    }
    public function update($id, Request $request)
    {
        $this->validate($request, $this->defaultRules, $this->messages);
        
        try {
            $item = ContentTypes::find($id);
            $data = $request->only($this->fields);
            $data['single'] = $request->input('single') ? true : false;
            $data['fields'] = json_encode($data['fields']);
            $item->update($data);

            return redirect()->route('dashboard.' . $this->slugRoutes . '.index')->with('success', 'Item salvo com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao salvar: ' . $e->getMessage());
        }
    }
    public function destroy($id)
    {
        try {
            $item = ContentTypes::find($id);
            $item->delete();

            return redirect()->route('dashboard.' . $this->slugRoutes . '.index')->with('success', 'Item excluído com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao excluir: ' . $e->getMessage());
        }
    }
}
