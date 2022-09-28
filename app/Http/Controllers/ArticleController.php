<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use simplehtmldom\HtmlWeb;
use Illuminate\Support\Facades\Http;

class ArticleController extends Controller
{

    public function agriculture()
    {

        $parserSessions = Article::selectRaw('started_at, max(page) as page ')->groupBy('started_at')->get();

        // dd($parserSessions);
        return view('parsers.agriculture', [
            'parserSessions' => $parserSessions,
        ]);
    }

    public function ac_parsePage()
    {

        $started_at = request('started_at') ? request('started_at') : date('Y-m-d H:i:s');

        if (request('started_at') && request('page') == 0) {
            $lastParsedPage = Article::where('started_at', $started_at)->orderBy('id', 'desc')->value('page');
            $page_num = $lastParsedPage + 1;
        }elseif (request('started_at') == 0 && request('page') == 0) {
            $page_num = 1;
        }else{
            $page_num = request('page');
        }


        try{
            $doc = new HtmlWeb();
            $html = $doc->load('https://www.agriculture.com/news?page=' . $page_num);



            $articles = $html->find('article.views-row');

            $returnTitle = '';

            foreach ($articles as $key => $article) {
                if (in_array($key, [0,1,2])) {
                    continue;
                }
                $title = $article->find('h3 .field-content', 0)?->plaintext ?? '';
                if ($title) {

                    $articleModel = Article::firstOrNew(['title' => $title]);

                    $articleModel->description = $article->find('.field-body', 0)?->plaintext ?? '';
                    $articleModel->image = $article->find('.lazyload', 0)?->getAttribute('data-srcset') ?? '';
                    $articleModel->page = $page_num;
                    $articleModel->started_at = $started_at;
                    $articleModel->save();
                    $returnTitle = $title;

                }

            }

            if ($returnTitle) {
                return [
                    'status' => 'ok',
                    'title' => $returnTitle,
                    'page' => $page_num,
                    'started_at' => $started_at,
                ];
            }else{
                return [
                    'status' => 'finish',
                ];
            }



        } catch (Exeption $e) {
            return response([
                'status' => 'error',
                'title' => $e->getMessage(),
            ], 400);

        }


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}
