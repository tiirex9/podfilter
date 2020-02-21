<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UrlGenerator extends Controller
{

    public function showForm() {
        return view('filter');
    }

    public function generateUrl(Request $request) {
        if (isset($_POST['url'])) {;
            try {
                $input = $this->validate($request, [
                    'url' => 'required|url',
                    'type' => ['required', Rule::in(['whitelist', 'blacklist'])],
                    'filter' => 'required',
                    'custom_title' => '',
                    'custom_artwork' => Rule::dimensions()->ratio('1/1')->minWidth(1400)->minHeight(1400)->maxWidth(3000)->maxHeight(3000)
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

            $query = [];

            // URL
            $query['url'] = urlencode($input['url']);

            // Type
            $type = $input['type'];

            // Filter
            $filterArray = explode("\r\n", $input['filter']);
            $filterArray = array_filter($filterArray, function($item) {
                return !empty(trim($item));
            });
            $query[$type] = $filterArray;

            // Custom Title
            if (!empty($input['custom_title'])) {
                $query['title'] = $input['custom_title'];
            }

            // Custom Artwork
            if (!empty($input['custom_artwork'])) {
                /** @var UploadedFile $artwork */
                $artwork = $input['custom_artwork'];
                $artwork_filename = $artwork->store('artworks');
                $query['artwork'] = basename($artwork_filename);
            }

            // Detect base URL
            $protocol = (isset($_SERVER['HTTPS'])) ? 'https://' : 'http://';
            $host = $_SERVER['HTTP_HOST'];
            $baseUrl =  $protocol . $host . '/feed?';

            $queryString = http_build_query($query);

            return view('url')->with('url', $baseUrl . $queryString);
        }

        return redirect('/');
    }

}
