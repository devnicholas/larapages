<?php

namespace App\Http\Controllers;

use App\Models\DB\Contents;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function content($slug)
    {
        try{
            $content = Contents::with('contentType')->where('slug', $slug)->first();
            if(!$content) {
                abort(404);
            }
            $fields = json_decode($content->fields);
            return view($content->contentType->template, compact('content', 'fields'));
        } catch (\Exception $e) {
            abort(406, $e->getMessage());
        }
    }
}
