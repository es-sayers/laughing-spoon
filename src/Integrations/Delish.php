<?php

namespace Esayers\LaughingSpoon\Integrations;

use Esayers\LaughingSpoon\Integration;
use Symfony\Component\DomCrawler\Crawler;

class Delish extends Integration
{

    function parseTitle(Crawler $crawler): string
    {
        return $crawler->filterXPath('//*[@id="main-content"]/header/div/div/h1')->text();
    }

    function parseAuthor(Crawler $crawler): string
    {
        $author_node = $crawler->filterXPath('//*[@id="main-content"]/header/div/div/div[1]/address/span/a');
        if(count($author_node) != 0) {
            return $author_node->text();
        }
        return "";
    }

    function parseServings(Crawler $crawler): string
    {
        return $crawler->filterXPath('//*[@id="main-content"]/div[2]/div[1]/div[2]/dl/div[1]/dd/span')->text();
    }

    function parsePublishedDate(Crawler $crawler): string
    {
        return $crawler->filterXPath('//*[@id="main-content"]/header/div/div/div[1]/address/time')->text();
    }

    function parsePrepTime(Crawler $crawler): string
    {
        return "";
    }

    function parseCookTime(Crawler $crawler): string
    {
        return "";
    }

    function parseTotalTime(Crawler $crawler): string
    {
        return $crawler->filterXPath('//*[@id="main-content"]/div[2]/div[1]/div[2]/dl/div[2]/dd')->text();
    }

    function parseIngredients(Crawler $crawler): array
    {
        $ingredients = [];
        $ingredient_groups = $crawler->filter('.ingredient-lists > li');
        foreach ($ingredient_groups as $group) {
            array_push($ingredients, $group->textContent);
        }
        return $ingredients;
    }

    function parseSteps(Crawler $crawler): array
    {
        $steps = [];
        $step_groups = $crawler->filterXPath('//*[@id="main-content"]/div[2]/div[1]/div[2]/div[4]/div/ul/li/ol')->filter('li');
        foreach ($step_groups as $group) {
            array_push($steps, trim($group->lastChild->textContent));
        }
        return $steps;
    }
}
