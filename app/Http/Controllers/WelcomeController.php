<?php
namespace App\Http\Controllers;

class WelcomeController extends Controller{
    public function index() {
        
        $breadcrumb = (object) [
            'title' => 'Selamat Datang ',
            'list' => ['JTI SIMPEN', 'Dashboard']
        ];

        $activeMenu = 'dashboard';

        return view('welcome', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }

    public function landing() {
        return view('landing');
    }
}