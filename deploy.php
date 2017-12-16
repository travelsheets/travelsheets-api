<?php

/* On inclut la recette pour une application Symfony 3.
 * Si vous êtes encore sur Symfony 2, il faut inclure la recette recipe/symfony.php */
require 'recipe/symfony3.php';

/* Dans notre exemple, on a qu'un serveur. On le nomme localhost car on déploie directement sur ce serveur.
 * Ce qui explique l’utilisation de la fonction localServer() sinon il faut utiliser la fonction server().
 * On le met dans la catégorie "prod" car il s'agit d'un serveur de production.
 * On indique le répertoire où doit être déployé le projet. */
localServer('localhost')
    ->stage('prod')
    ->env('deploy_path', '/home/travelsheets/api/');

/* On utilise Git pour récupérer le projet : on indique l'URL du dépôt du projet */
set('repository', 'git+ssh://git@bitbucket.org:qmachard/travelsheets-api.git');

/* A chaque déploiement, l'ancienne version est archivée.
 * Cette variable permet d'indiquer le nombre maximum de version que l'on souhaite conserver. */
set('keep_releases', 5);