<?php
require "vendor/autoload.php";

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use Alura\BuscadorDeCursos\Buscador;

$client = new Client(["base_uri" => "https://www.nuuvem.com/"]);

$crawler = new Crawler();

$buscador = new Buscador($client, $crawler);

$cursos = $buscador->buscar("/catalog/price/promo/sort/bestselling/sort-mode/desc");
var_dump(count($cursos));
foreach ($cursos as $curso) {
    echo $curso.PHP_EOL;
}