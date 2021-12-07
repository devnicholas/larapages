<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
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

    public function index(Request $request)
    {
        $items = new Contents();
        $type = $request->input('type');
        if($type) {
            $items = $items->where('content_type_id', $type);
        }
        $single = $request->input('single');
        if($single) {
            $single = $single == 'true' ? true : false;
            $items = $items->whereHas('contentType', function($query) use ($single) {
                $query->where('single', $single);
            });
        }
        $items = $items->get();
        $types = ContentTypes::where('single', false)->get();
        return view('admin.' . $this->slugRoutes . '.index', compact('items', 'types'));
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
            if($type->single && Contents::where('content_type_id', $request->type)->count() > 0) {
                return redirect()->back()->with('error', 'Tipo de conteúdo já existe');
            }
            return redirect()->route('dashboard.' . $this->slugRoutes . '.create', ['id' => $type->id]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao processar: ' . $e->getMessage());
        }
    }
    public function store(Request $request)
    {
        $this->validate($request, [...$this->defaultRules, 'slug' => 'unique:contents'], $this->messages);
        $data = $request->only($this->fields);
        try {
            $type = ContentTypes::find($request->content_type_id);
            if($type->single){
                $data['title'] = $type->title;
            }
            if($request->has('uploads')){
                foreach($request->uploads as $field => $file){
                    $name = Helper::uploadFile($file);
                    $data['fields'][$field] = $name;
                }
            }
            $data['fields'] = json_encode($data['fields']);
            Contents::create($data);
            return redirect()->route('dashboard.' . $this->slugRoutes . '.index')->with('success', 'Item salvo com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao salvar: ' . $e->getMessage());
        }
    }
    public function create($id)
    {
        $type = ContentTypes::find($id);
        return view('admin.' . $this->slugRoutes . '.create', compact('type'));
    }
    public function show($id)
    {
        $item = Contents::with('contentType')->find($id);
        return view('admin.' . $this->slugRoutes . '.show', compact('item'));
    }
    public function update($id, Request $request)
    {
        $this->validate($request, $this->defaultRules, $this->messages);
        
        try {
            $item = Contents::with('contentType')->find($id);
            $data = $request->only($this->fields);
            if($item->contentType->single){
                $data['title'] = $item->contentType->title;
            }
            if($request->has('uploads')){
                foreach($request->uploads as $field => $file){
                    $name = Helper::uploadFile($file);
                    $data['fields'][$field] = $name;
                }
            }
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
