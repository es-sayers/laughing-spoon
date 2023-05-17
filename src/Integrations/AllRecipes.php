<?php

namespace Esayers\LaughingSpoon\Integrations;

use Esayers\LaughingSpoon\Integration;
use Symfony\Component\DomCrawler\Crawler;

class AllRecipes extends Integration
{

    function parseTitle(Crawler $crawler): string
    {
        return $crawler->filter('#article-heading_1-0')->text();
    }

    function parseAuthor(Crawler $crawler): string
    {
        return $crawler->filter('#mntl-bylines__item_1-0')->children('a')->text();
    }

    function parseServings(Crawler $crawler): string
    {
        return $crawler->filterXPath('//*[@id="recipe-details_1-0"]/div[1]/div[4]/div[2]')->text();
    }

    function parsePublishedDate(Crawler $crawler): string
    {
        return $crawler->filterXPath('//*[@id="mntl-bylines__group_1-0"]/div[2]')->text();
    }

    function parsePrepTime(Crawler $crawler): string
    {
        return $crawler->filterXPath('//*[@id="recipe-details_1-0"]/div[1]/div[1]/div[2]')->text();
    }

    function parseCookTime(Crawler $crawler): string
    {
        return $crawler->filterXPath('//*[@id="recipe-details_1-0"]/div[1]/div[2]/div[2]')->text();
    }

    function parseTotalTime(Crawler $crawler): string
    {
        return $crawler->filterXPath('//*[@id="recipe-details_1-0"]/div[1]/div[3]/div[2]')->text();
    }

    function parseIngredients(Crawler $crawler): array
    {
        $ingredients = [];
        $ingredient_groups = $crawler->filter('.mntl-structured-ingredients__list > li > p');
        foreach ($ingredient_groups as $group) {
                array_push($ingredients, $group->textContent);
        }
        return $ingredients;
    }

    function parseSteps(Crawler $crawler): array
    {
        $steps = [];
        $step_groups = $crawler->filter('.recipe__steps-content > ol > li > p');
        foreach ($step_groups as $group) {
                array_push($steps, trim($group->textContent));
        }
        return $steps;
    }
}
