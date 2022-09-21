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
        return view('parsers.agriculture');
    }

    public function ac_parsePage($page_num)
    {
        // dd($page_num);
        // Load the page into memory
        $doc = new HtmlWeb();
        $html = $doc->load('https://www.agriculture.com/news?page=' . $page_num);

        // echo $html->innertext;

        $articles = $html->find('article.views-row');

        foreach ($articles as $key => $article) {
            if (in_array($key, [0,1,2])) {
                continue;
            }
            $title = $article->find('h3 .field-content', 0)->plaintext ?? '';
            if ($title) {
                $description = $article->find('.field-body', 0)->plaintext ?? '';
                $image = $article->find('.lazyload', 0)->getAttribute('data-srcset') ?? '';
                dump($image);
                echo '<img src="'.$image.'">';
            }

        }


        // $response = Http::withBody()->post('https://www.agriculture.com/views/ajax?page=6',[
        //     'view_name' => 'category_content',
        //     'view_display_id' => 'category_recent_content_three',
        //     'view_path' => 'taxonomy/term/69',
        //     'page'
        // ]);

        // $result = $response->json($key = null);

        // dd($result);

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
