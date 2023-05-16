<?php

namespace Esayers\LaughingSpoon\Integrations;

use Esayers\LaughingSpoon\Integration;
use Symfony\Component\DomCrawler\Crawler;

class BudgetBytes extends Integration
{
    function parseTitle(Crawler $crawler): string
    {
        return $crawler->filter('.entry-title')->text();
    }

    function parseAuthor(Crawler $crawler): string
    {
        $author_node = $crawler->filter('.wprm-recipe-author');
        if(count($author_node) == 0) {
            $author_node = $crawler->filter('.entry-header__author');
        }

        if(!$author_node) {
            return "";
        }
        return $author_node->children('a')->text();
    }

    function parseServings(Crawler $crawler): string
    {
        return $crawler->filter('.wprm-recipe-servings')->text();
    }

    function parsePublishedDate(Crawler $crawler): string
    {
            return $crawler->filter('.entry-date__published')->children('time')->text();
    }

    function parsePrepTime(Crawler $crawler): string
    {
        return $crawler->filter('.wprm-recipe-prep_time-minutes')->text();
    }

    function parseCookTime(Crawler $crawler): string
    {
        return $crawler->filter('.wprm-recipe-time')->text();
    }

    function parseTotalTime(Crawler $crawler): string
    {
        return $crawler->filter('.wprm-recipe-total_time')->text();
    }

    function parseIngredients(Crawler $crawler): array
    {
        $ingredients = [];
        $ingredient_groups = $crawler->filter('.wprm-recipe-ingredients');
        foreach($ingredient_groups as $group) {
            foreach($group->childNodes as $ingredient) {
                array_push($ingredients, $ingredient->textContent);
            }
        }
        return $ingredients;
    }

    function parseSteps(Crawler $crawler): array
    {
        $steps = [];
        $step_groups = $crawler->filter('.wprm-recipe-instructions');
        foreach($step_groups as $group) {
            foreach($group->childNodes as $step) {
                array_push($steps, $step->textContent);
            }
        }
        return $steps;
    }
}
