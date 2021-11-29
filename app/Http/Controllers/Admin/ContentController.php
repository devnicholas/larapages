<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DB\Contents;
use App\Models\DB\ContentTypes;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    private $defaultRules = [];
    private $fields = [
        'title', 'slug', 'content_type_id', 'fields'
    ];
    private $slugRoutes = 'content';

    public function index()
    {
        $items = Contents::get();
        return view('admin.' . $this->slugRoutes . '.index', compact('items'));
    }
    public function select()
    {
        $items = ContentTypes::get();
        return view('admin.' . $this->slugRoutes . '.select', compact('items'));
    }
    public function selectAction(Request $request)
    {
        try {
            $type = ContentTypes::find($request->type);
            return redirect()->route('dashboard.' . $this->slugRoutes . '.create', ['type' => $type->slug]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao processar: ' . $e->getMessage());
        }
    }
    public function store(Request $request)
    {
        $this->validate($request, $this->defaultRules, $this->messages);
        $data = $request->only($this->fields);
        try {
            $type = ContentTypes::find($request->content_type_id);
            if($type->single){
                $data['title'] = $type->title;
                $data['slug'] = $type->slug;
            }
            $data['fields'] = json_encode($data['fields']);
            Contents::create($data);
            return redirect()->route('dashboard.' . $this->slugRoutes . '.index')->with('success', 'Item salvo com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao salvar: ' . $e->getMessage());
        }
    }
    public function create($type)
    {
        $type = ContentTypes::where('slug', $type)->first();
        return view('admin.' . $this->slugRoutes . '.create', compact('type'));
    }
    public function show($id)
    {
        $item = Contents::find($id);
        return view('admin.' . $this->slugRoutes . '.show', compact('item'));
    }
    public function update($id, Request $request)
    {
        $this->validate($request, $this->defaultRules, $this->messages);
        
        try {
            $item = Contents::find($id);
            $data = $request->only($this->fields);
            $item->update($data);

            return redirect()->route('dashboard.' . $this->slugRoutes . '.index')->with('success', 'Item salvo com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao salvar: ' . $e->getMessage());
        }
    }
    public function destroy($id)
    {
        try {
            $item = Contents::find($id);
            $item->delete();

            return redirect()->route('dashboard.' . $this->slugRoutes . '.index')->with('success', 'Item excluído com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao excluir: ' . $e->getMessage());
        }
    }
}
