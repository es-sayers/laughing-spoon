<?php

namespace Esayers\LaughingSpoon;

use Symfony\Component\DomCrawler\Crawler;

interface IntegrationParse
{
    /**
     * Retrieves the recipe title from the webpage.
     * 
     * @param Crawler $crawler Webpage crawler
     * @return string Title of the recipe
     */
    function parseTitle(Crawler $crawler): string;
    /**
     * Retrieves the recipe author from the webpage.
     * 
     * @param Crawler $crawler Webpage crawler
     * @return string Author of the recipe
     */
    function parseAuthor(Crawler $crawler): string;
    /**
     * Retrieves the recipe servings from the webpage.
     * 
     * @param Crawler $crawler Webpage crawler
     * @return string Number of servings
     */
    function parseServings(Crawler $crawler): string;
    /**
     * Retrieves the recipe published date from the webpage.
     * 
     * @param Crawler $crawler Webpage crawler
     * @return string Publishing date of the recipe
     */
    function parsePublishedDate(Crawler $crawler): string;
    /**
     * Retrieves the recipe prep time from the webpage.
     * 
     * @param Crawler $crawler Webpage crawler
     * @return string Prep time of the recipe
     */
    function parsePrepTime(Crawler $crawler): string;
    /**
     * Retrieves the recipe cook time from the webpage.
     * 
     * @param Crawler $crawler Webpage crawler
     * @return string Cook time of the recipe
     */
    function parseCookTime(Crawler $crawler): string;
    /**
     * Retrieves the recipe total time from the webpage.
     * 
     * @param Crawler $crawler Webpage crawler
     * @return string Total time of the recipe
     */
    function parseTotalTime(Crawler $crawler): string;
    /**
     * Retrieves the recipe ingredients from the webpage.
     * 
     * @param Crawler $crawler Webpage crawler
     * @return string Ingredients of the recipe
     */
    function parseIngredients(Crawler $crawler): array;
    /**
     * Retrieves the recipe steps from the webpage.
     * 
     * @param Crawler $crawler Webpage crawler
     * @return string Steps of the recipe
     */
    function parseSteps(Crawler $crawler): array;
}
