<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UrlGenerator extends Controller
{

    public function showForm() {
        return view('filter');
    }

    public function generateUrl(Request $request) {
        if (isset($_POST['url'])) {
            try {
                $input = $this->validate($request, [
                    'url' => 'required|url',
                    'type' => ['required', Rule::in(['whitelist', 'blacklist'])],
                    'filter' => 'required'
                ], [
                    'required' => 'Das Feld :attribute ist ein Pflichtfeld.',
                    'type.in' => 'Bitte wähle entweder Whitelist oder Blacklist aus.'
                ]);
            } catch (ValidationException $e) {
                return response('', 400);
            }

            $podcastUrl = urlencode($input['url']);
            $type = $input['type'];
            $filterArray = explode("\r\n", $input['filter']);

            // Handle empty lines...
            $filterArray = array_filter($filterArray, function($item) {
                return !empty(trim($item));
            });

            $protocol = (isset($_SERVER['HTTPS'])) ? 'https://' : 'http://';
            $host = $_SERVER['HTTP_HOST'];
            $baseUrl =  $protocol . $host . '/feed?';

            $query = http_build_query([
                'url' => $podcastUrl,
                $type => $filterArray
            ]);

            return view('url')->with('url', $baseUrl . $query);
        }

        return redirect('/');
    }

}
