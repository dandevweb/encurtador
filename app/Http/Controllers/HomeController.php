<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Models\Translate;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class HomeController extends Controller
{

    public function index()
    {
        $head = $this->seo->render(
            'Página Inicial - ' . env('APP_NAME'),
            env('SITE_DESCRIPTION'),route('home'),
            asset('assets/img/meta.png')
        );



        return view('pages.home', compact(
            'head'
        ));
    }

    public function converter(Request $request)
    {
        $selectCounter = Counter::first();
        $countUrl = $selectCounter->count_url;
        $idCounter = $selectCounter->id;

        $ip = $_SERVER['REMOTE_ADDR'];

        $id = randomString($countUrl);

        $translate = new Translate();

        //verificar se o IP já converteu 10 URLs hoje
        $today = date('Y-m-d');
        $ipAccess = $translate->where(['created_at' => $today, 'ip' => $ip])->count();
        if ($ipAccess >= 10) {
            return back()->with('error', 'Você já encurtou 10 URLs hoje. Tente novamente amanhã!');
        } else {
            $request->validate([
                'url_converter' => 'required'
            ]);

            $old_url = explode('//', $request->url_converter);
            $urlPersonal = str_replace(' ', '-', $request->url_personal);
            if (isset($old_url[1])) {
                $old_url = $old_url[1];
            } else {
                $old_url = $old_url[0];
            }

            if (!empty($urlPersonal)) {
                $id = $urlPersonal;
                $new_url = url('/') . '/' . $id;
                $verify = $translate->urlExists($new_url);
                if ($verify  || $urlPersonal == 'painel' || $urlPersonal == 'url') {
                    return back()->with('error', 'URL não disponível!');
                } else {
                    $translate = new Translate();
                    $translate->link = $old_url;
                    $translate->new_link = $new_url;
                    $translate->ip = $ip;
                    $translate->clicks = 0;
                    $translate->save();
                }
            } else {
                $new_url = url('/') . '/' . $id;
                $verify = $translate->urlExists($new_url);
                $attempt = 0;
                while ($verify) {
                    $attempt++;
                    $id = randomString($countUrl);
                    $new_url = url('/') . '/' . $id;
                    $verify = $translate->urlExists($new_url);
                    if ($attempt >= 1000) {
                        $attempt = 0;
                        $addStringUrl = new Counter();
                        $addStringUrl->id = $idCounter;
                        $addStringUrl->count_url = $countUrl + 1;
                        break;
                    }
                }
                $translate = new Translate();
                $translate->link = $old_url;
                $translate->new_link = $new_url;
                $translate->ip = $ip;
                $translate->clicks = 0;
                $translate->save();
            }
            $insert = true;
            $img = asset('assets/img/dog-puppy.png');
            return back()->with(['insert' => $insert, 'new_url' => $new_url, 'img' => $img]);
        }

    }

    public function clicks()
    {
        $head = $this->seo->render(
            'Contador de Cliques - ' . env('APP_NAME'),
            env('SITE_DESCRIPTION'),route('url.clicks'),
            asset('assets/img/meta.png')
        );

        return view('pages.clicks', compact(
            'head'
        ));
    }

    public function clicksCount(Request $request)
    {
        $url = $request->short_url;
        $selectUrl = Translate::where('new_link', $url)->first();
        if ($selectUrl) {
            return view('pages.clicks', ['data' => $selectUrl]);
        }
        return back()->with('error', 'URL não encontrada.');
    }

    public function clicksReset(Request $request)
    {
        $translate = Translate::find($request->id);
        if ($translate) {
            $translate->clicks = 0;
            $translate->save();
            return back()->with('success', 'Os cliques foram zerados!');
        }

        return back()->with('error', 'Hove um erro, tente novamente.');
    }
}