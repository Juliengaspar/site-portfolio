<?php

namespace controllers;
use JetBrains\PhpStorm\NoReturn;
class ContactForm
{

    /**
     * @param string[] $config
     * @param array $_POST
     */
    //Un tableaux qui contient les information sur les jeton de sécuriter du formulaire (nonce);
    protected array $config;
    //Les données que je reçois de mon formulaire
    protected array $data;
    //L’url de la page précedante (referrer)
    protected string $previousUrl;
    public function __construct(array $config, array $_POST)
    {
    }
}