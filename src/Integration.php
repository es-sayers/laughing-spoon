<?php

namespace Esayers\LaughingSpoon;

use Esayers\LaughingSpoon\Scraper;
use Symfony\Component\DomCrawler\Crawler;

abstract class Integration implements IntegrationParse
{

    private $scraper;

    function __construct()
    {
        $this->scraper = new Scraper();
    }

    /**
     * Retrieves a recipe webpage and consolidates the information
     * 
     * @param string $url URL of the recipe to scrape
     * @return array Associative array of recipe information
     */
    function scrapeRecipe(string $url): array
    {
        $page_string = $this->scraper->getPage($url);
        $crawler = new Crawler($page_string);
        return
            [
                "source" => $url,
                "title" => $this->parseTitle($crawler),
                "author" => $this->parseAuthor($crawler),
                "servings" => $this->parseServings($crawler),
                "publishedAt" => $this->parsePublishedDate($crawler),
                "prepTime" => $this->parsePrepTime($crawler),
                "cookTime" => $this->parseCookTime($crawler),
                "totalTime" => $this->parseTotalTime($crawler),
                "ingredients" => $this->parseIngredients($crawler),
                "steps" => $this->parseSteps($crawler),
            ];
    }
}
