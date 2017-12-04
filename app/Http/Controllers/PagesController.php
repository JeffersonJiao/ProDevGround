<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function getIndex(){
        return view('pages.index');
    }


    public function getTeamPage(){
        return view('pages.projects');
    }

    public function getAboutPage(){
        return view('pages.about');
    }

    public function getContactPage(){
        return view('pages.contact');
    }

    public function showErrorPage(){
        return "error";
    }
}
