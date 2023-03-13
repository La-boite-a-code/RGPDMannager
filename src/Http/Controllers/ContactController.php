<?php

namespace Laboiteacode\RGPDManager\Http\Controllers;

class ContactController extends Controller
{
    public function index()
    {
        return view('rgpdmanager::contact_page');
    }
}