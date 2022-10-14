<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ImageSearch extends Component
{
    public $imgUrl;
    public $title = 'purple flowers';

    public function searchImage()
    {
        $endpoint = 'https://pixabay.com/api/';
        $apiKey = env('PIXABAY_API_KEY');
        $imagesPerPage = 200;
        $jsonUrl = $endpoint . '?key=' . $apiKey . '&q=' . urlencode($this->title) . '&per_page=' . $imagesPerPage;
        $json = json_decode(file_get_contents($jsonUrl));

        $randomMax = 0;
        if ($json->totalHits < $imagesPerPage)
        {
            $randomMax = $json->totalHits - 1;
        } else {
            $randomMax = $imagesPerPage - 1;
        }

        $this->imgUrl = $json->hits[rand(0, $randomMax)]->webformatURL;
    }

    public function render()
    {
        return view('livewire.image-search');
    }
}
