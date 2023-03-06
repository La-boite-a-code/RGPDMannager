<?php
namespace Laboiteacode\RGPDManager\Http\Controllers;

use Illuminate\Support\Str;
use Laboiteacode\RGPDManager\Models\Term;
use Laboiteacode\RGPDManager\Models\Consent;

class ConsentsController extends Controller
{
    public function index()
    {
        $pages = Term::oldest()->get();
        return view('rgpdmanager::index', compact('pages'));
    }

    public function page($slug)
    {
        $page = Term::whereSlug($slug)->firstOrFail();
        return view('rgpdmanager::page', compact('page'));
    }

    public function contact($slug)
    {
        if( !in_array($slug, config('rgpdmanager.routes.contact')) ) {
            abort(404);
        }

        $key = array_search($slug, config('rgpdmanager.routes.contact'));

        //$page = Term::whereSlug($slug)->firstOrFail();
        return view('rgpdmanager::contact', compact('key'));
    }

    public function consents()
    {
        return view('rgpdmanager::consents');
    }

    public function details($token, $slug)
    {
        $consents = Consent::latest()
            ->where('purpose', $slug)
            ->where('token', $token)
            ->get();

        $consent = new Consent();
        if( count($consents) > 0 ) {
            $consent = $consents[0];
        }


        return view('rgpdmanager::details', compact('consent', 'consents'));
    }
}