<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        $title = 'Welcome to Laravel';
        // return view('pages.index', compact('title')); //prima modalitate de a trimite val
        return view('pages.index')->with('title', $title);//a doua modalitate de a trimite val
    }

    public function about() {
        $title = 'About US';
        return view('pages.about', compact('title'));
    }

    public function services() {
        $data = array(
            'title' => 'Services',
            'services' => ['Web Design', 'Programig', 'SEO']
        );
        return view('pages.services')->with($data);
    }
}
