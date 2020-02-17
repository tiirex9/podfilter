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

            $baseUrl = env('APP_URL') . '/feed?';

            $query = http_build_query([
                'url' => $podcastUrl,
                $type => explode("\r\n", $filter)
            ]);

            return view('url')->with('url', $baseUrl . $query);
        }

        return $this->showForm();
    }

}
