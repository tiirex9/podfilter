<?php


namespace App\Http\Controllers;


class UrlGenerator extends Controller
{

    public function showForm() {
        return view('filter');
    }

    public function generateUrl() {
        if (isset($_POST['url'])) {
            $podcastUrl = urlencode($_POST['url']);
            $type = $_POST['type'];
            $filter = $_POST['filter'];

            if (!in_array($type, ['whitelist', 'blacklist'])) {
                return response('Invalid type.', 400);
            }

            $baseUrl = env('APP_URL') . '/feed?';

            $query = http_build_query([
                'url' => $podcastUrl,
                $type => explode("\r\n", $filter)
            ]);

            return view('url')->with('url', $baseUrl . $query);
        }

        return redirect('/');
    }

}
