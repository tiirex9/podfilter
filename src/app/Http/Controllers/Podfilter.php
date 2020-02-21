<?php


namespace App\Http\Controllers;


class Podfilter extends Controller
{

    private $whitelist;
    private $blacklist;

    public function filter() {

        $podcastUrl = $_GET['url'] ?? null;
        $this->whitelist = $_GET['whitelist'] ?? [];
        if (is_string($this->whitelist)) $this->whitelist = [$this->whitelist];
        $this->blacklist = $_GET['blacklist'] ?? [];
        if (is_string($this->blacklist)) $this->blacklist = [$this->blacklist];

        $custom_title = $_GET['title'] ?? null;
        $custom_artwork = $_GET['artwork'] ?? null;

        // Check parameter
        if (!isset($podcastUrl)) {
            return response('Der Parameter "url" muss den RSS Podcast Feed enthalten.', 400);
        }

        if (empty($podcastUrl)) {
            return response('Der Parameter "uri" muss eine gültige URL enthalten.', 400);
        }

        if (empty($this->whitelist) && empty($this->blacklist)) {
            return response('Es muss entweder der Parameter "whitelist" oder der Parameter "blacklist" übergeben werden.', 400);
        }

        if (!empty($this->whitelist) && !empty($this->blacklist)) {
            return response('Es darf nur einer der Parameter "whitelist" oder "blacklist" gesetzt sein.', 400);
        }

        $xml = simplexml_load_file($podcastUrl);
        $items = $xml->xpath('//item');

        foreach ($items as $item) {
            $title = (string) $item->title;
            if ($this->shouldDelete($title)) {
                $dom = dom_import_simplexml($item);
                $dom->parentNode->removeChild($dom);
            }
        }

        // Override title
        if (isset($_GET['title'])) {
            $titleNode = $xml->xpath('//channel/title')[0];
            $titleNode[0] = htmlentities($_GET['title']);

            $itunesTitleNode = $xml->xpath('//channel/itunes:title')[0];
            $itunesTitleNode[0] = htmlentities($_GET['title']);
        }

        // Override artwork
        if (isset($_GET['artwork'])) {
            $artworkNode = $xml->xpath('//channel/itunes:image')[0];
            $artworkNode['href'] = url('/artwork/'. urlencode($_GET['artwork']));
        }


        return response($xml->asXML())
            ->header('Content-Type', 'application/xml; charset=utf-8');
    }

    protected function shouldDelete($title) {
        if (count($this->whitelist) > 0) {
            return $this->shouldDeleteWhitelist($title);
        } else if (count($this->blacklist) > 0) {
            return $this->shouldDeleteBlacklist($title);
        }
    }

    protected function shouldDeleteWhitelist($title) {
        foreach ($this->whitelist as $white) {
            if (strpos($title, $white) !== false) {
                return false;
            }
        }
        return true;
    }

    protected function shouldDeleteBlacklist($title)
    {
        foreach ($this->blacklist as $black) {
            if (strpos($title, $black) !== false) {
                return true;
            }
        }
        return false;
    }

}
