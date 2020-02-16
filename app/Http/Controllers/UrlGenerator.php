<?php


namespace App\Http\Controllers;


class UrlGenerator extends Controller
{

    public function generateUrl() {
        if (isset($_POST['url'])) {
            $podcastUrl = urlencode($_POST['url']);
            $type = $_POST['type'];
            $filter = $_POST['filter'];

            $baseUrl = 'https://podfilter.tii.one/feed?';

            $query = http_build_query([
                'url' => $podcastUrl,
                $type => explode('\n', $filter)
            ]);

            return view('url')->with('url', $baseUrl . $query);
        }

        return view('filter');
    }

}
