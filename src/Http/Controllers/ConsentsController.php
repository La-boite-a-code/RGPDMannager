<?php
namespace Laboiteacode\RGPDManager\Http\Controllers;

use Illuminate\Support\Str;
use Laboiteacode\RGPDManager\Models\Term;
use Laboiteacode\RGPDManager\Models\Consent;

class ConsentsController extends Controller
{
    /**
     * RGPDManager Index
     *
     * @return mixed
     */
    public function index()
    {
        $pages = Term::orderBy(config('rgpdmanager.order_terms_field'), config('rgpdmanager.order_terms_direction'))->get();
        return view('rgpdmanager::index', compact('pages'));
    }

    /**
     * Term Page
     *
     * @param $slug
     * @return mixed
     */
    public function page($slug)
    {
        $page = Term::whereSlug($slug)->firstOrFail();
        return view('rgpdmanager::page', compact('page'));
    }

    /**
     * RGPD Manager Contact Page
     *
     * @param $slug
     * @return mixed
     */
    public function contact($slug)
    {
        if( !in_array($slug, config('rgpdmanager.routes.contact')) ) {
            abort(404);
        }

        $key = array_search($slug, config('rgpdmanager.routes.contact'));

        //$page = Term::whereSlug($slug)->firstOrFail();
        return view('rgpdmanager::contact', compact('key'));
    }

    /**
     * RGPD Manager Consents List
     *
     * @return mixed
     */
    public function consents()
    {
        return view('rgpdmanager::consents');
    }

    /**
     * RGPD Manager Consent Details
     *
     * @param $token
     * @param $slug
     * @return mixed
     */
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