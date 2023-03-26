<?php 

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PartialController extends BaseController
{
    /**
     * @Route("/trending")
     */
    public function trendingQuotes($isMac) {
        
        return $this->render('article/trending_quotes.html.twig', [
            'quotes' => $this->getTrendingQuotes(),
            'isMac' => $isMac,
        ]);
    }

    
    private function getTrendingQuotes()
    {
        return [
            [
                'author' => 'Wernher von Braun, Rocket Engineer',
                'link' => 'https://en.wikipedia.org/wiki/Wernher_von_Braun',
                'quote' => 'Our two greatest problems are gravity and paperwork. We can lick gravity, but sometimes the paperwork is overwhelming.',
            ],
            [
                'author' => 'Aaron Cohen, NASA Administrator',
                'link' => 'https://en.wikipedia.org/wiki/Aaron_Cohen_(Deputy_NASA_administrator)',
                'quote' => 'Let\'s face it, space is a risky business. I always considered every launch a barely controlled explosion.',
            ],
            [
                'author' => 'Christa McAuliffe, Challenger Astronaut',
                'link' => 'https://en.wikipedia.org/wiki/Christa_McAuliffe',
                'quote' => 'If offered a seat on a rocket ship, don\'t ask what seat. Just get on.',
            ],
        ];
    }


}