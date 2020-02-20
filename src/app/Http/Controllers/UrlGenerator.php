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
                    'filter' => 'required',
                    'custom_title' => 'nullable',
                    'custom_artwork' => ['nullable', Rule::dimensions()->ratio('1/1')->minWidth(1400)->minHeight(1400)->maxWidth(3000)->maxHeight(3000)]
                ], [
                    'required' => ':attribute ist ein Pflichtfeld.',
                    'url' => ':attribute enthält keine gültige URL.',
                    'type.in' => 'Bitte wähle entweder Whitelist oder Blacklist aus.'
                ], [
                    'url' => 'Podcast Feed-URL',
                    'type' => 'Filter-Typ',
                    'filter' => 'Filter',
                    'custom_title' => 'Benutzerdefinierter Titel',
                    'custom_artwork' => 'Benutzerdefinierte Grafik'
                ]);
            } catch (ValidationException $e) {
                $errors = '';
                foreach ($e->validator->errors()->messages() as $messages) {
                    foreach ($messages as $message) {
                        $errors .= $message . "<br>";
                    }
                }

                return view('filter')->with('errors', $errors);
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
