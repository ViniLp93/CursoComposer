<?php

namespace Alura\BuscadorDeCursos;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Buscador{

    private $httpClient;
    private $crawler;

    public function __construct(ClientInterface $httpClient, Crawler $crawler)
    {
        $this->httpClient = $httpClient;
        $this->crawler = $crawler;
    }

    public function buscar($url) : array
    {
        $resposta = $this->httpClient->request("GET", $url);

        $html = $resposta->getBody();

        $this->crawler->addHtmlContent($html);

        $elementosCursos = $this->crawler->filter("[class*=line-name]");
        $cursos = [];
        foreach ($elementosCursos as $elemento) {
            $cursos[] = $elemento->textContent;
        }

        return $cursos;

    }
}