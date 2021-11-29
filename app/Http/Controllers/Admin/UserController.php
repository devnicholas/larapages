<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $defaultRules = [
        'name' => 'required',
        'email' => 'required',
    ];
    private $fields = [
        'name', 'email', 'admin'
    ];
    private $slugRoutes = 'user';

    public function index()
    {
        $items = User::get();
        return view('admin.' . $this->slugRoutes . '.index', compact('items'));
    }
    public function store(Request $request)
    {
        $this->validate($request, $this->defaultRules, $this->messages);
        $data = $request->only($this->fields);
        try {
            $data['password'] = bcrypt($request->input('password'));
            if($request->input('admin'))
                $data['admin'] = true;
            User::create($data);
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
        $item = User::find($id);
        return view('admin.' . $this->slugRoutes . '.show', compact('item'));
    }
    public function update($id, Request $request)
    {
        $this->validate($request, $this->defaultRules, $this->messages);
        
        try {
            $item = User::find($id);
            $data = $request->only($this->fields);
            if($request->input('password')){
                $data['password'] = bcrypt($request->input('password'));
            }
            if($request->input('admin')){
                $data['admin'] = true;
            }else{
                $data['admin'] = false;
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
            if(Auth::user()->id == $id) return redirect()->back()->with('error', 'Você não possui permissão');

            $item = User::find($id);
            $item->delete();

            return redirect()->route('dashboard.' . $this->slugRoutes . '.index')->with('success', 'Item excluído com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao excluir: ' . $e->getMessage());
        }
    }
}
