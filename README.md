<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Basic Project Template</h1>
    <br>
</p>

Yii 2 Basic Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
rapidly creating small projects.

The template contains the basic features including user login/logout and a contact page.
It includes all commonly used configurations that would allow you to focus on adding new
features to your application.

[![Latest Stable Version](https://img.shields.io/packagist/v/yiisoft/yii2-app-basic.svg)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![Total Downloads](https://img.shields.io/packagist/dt/yiisoft/yii2-app-basic.svg)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![Build Status](https://travis-ci.com/yiisoft/yii2-app-basic.svg?branch=master)](https://travis-ci.com/yiisoft/yii2-app-basic)

# CompuClinicRecord
Yii Projet

# Sauvegarde et Historique

## Sauvegarde

> Elle est assurée par défaut par la classe [ActiveRecord]() présente dans [Yii]()

> Cette classe nous permet de faire toutes les opérations comme :
>* Insert (Inserer)
>* Delete (Supprimer)
>* Update (Mise à Jour)

Sauf que dans notre cas, nous avons besoin que toutes les opérations précedentes entraîne un ajout d'un certain nombre de lignes dans la table historique

## Historique

> Elle étant la classe [ActiveRecord]() puisque nous ne faisons pas l'historique de l'historique
>### Table Historique (`SQL` de création)
>> DROP TABLE IF EXISTS `historique`;
>>
>>CREATE TABLE IF NOT EXISTS `historique` (
>>>`id` int(11) NOT NULL AUTO_INCREMENT,
>>>
>>>`nomTable` varchar(50) DEFAULT NULL,
>>>
>>>`valeurAv` text DEFAULT NULL,
>>>
>>>`valeurAp` text DEFAULT NULL,
>>>
>>>`isInsert` tinyint(1) DEFAULT NULL,
>>>
>>>`dateModification` datetime DEFAULT current_timestamp(),
>>>
>>>`typeDonnee` varchar(11) DEFAULT NULL,
>>>
>>>`nomColonne` varchar(50) DEFAULT NULL,
>>>
>>>PRIMARY KEY (`id`)
>>>
>>) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

>### CompuClinicRecord
>> Cette classe étant la classe [ActiveRecord](), dans cette classe, nous écoutons les évènements comme :
>>* `AfterSave` : Méthode appelée juste après une insertion ou la mise à jour a été faite avec un comme paramètre
>>
>>>>>### $`insert` :
>>Permet de savoir si c'est une insertion ou une mise à jour
>>   
>>>>>### $`changedAttributes` : 
>>Qui est [Array]() contenant la liste des colonnes modifiées avec leurs valeurs (valeurs avant la modification)
>>
>>>>>### `getOldAttributes`
>> C'et cette méthode qui nous permet d'avoir les attributs et valeurs de la table étandant *CompuClinicRecord*
>>
>>* `AfterDelete` : Méthode appelée juste après une suppression de données dans la bd
>>>>> Dans cette partie nous recupérons les attributs présentes dans la base de données juste avant la suppréssion et nous les ajoutons à la table historique

# Utilité de faire l'historique

Dans cette partie nous vous donnerons quelques utilités de faire des sauvegrades des modifications de la base
* Historique nous permet de faire des `statistiques` sur les données modifiées: pouvant faciliter plus tard
* Informer l'administrateur sur la modification des données sensibles: envoie d'un mail par exemple
* Faire un backupde toutes les données modifiées depuis une certaine période

# Service de mails (`Ajout volontaire`)

Comme nous avons soulevé plus haut, l'historique pourrait nous être utile si nous souhaitons notifier l'administrateur pour la modification des données sensibles

> La classe `CompuCliniRecord` contient *sendMail* qui lit les différents paramètres (paramètres [*gmail*]()) de l'administrateur

# Reporting
Placer chaque dossier fourni ici comme les différents dossiers lors de la création d'un projet Yii
> Exemple : models doit être placé dans models. 

## Sauvegarde

- La sauvegarde est assurée par le model CompuClinicRecord contenu dans le dossier models
- L'inserer au même endroit que les models de Yii après création de votre projet.
- Le fichier Readme.md disponible sur notre dépôt de code en ligne [github.com]('https://github.com/KameniAlexNea/CompuClinicRecord.git')

## Visualisation des statistiques et l'historique

- Déposer le dossier reports à la racine du projet, contenant la vue des statistiques et Historique (HistoriqueReport.view), la classe de génération (LoadReport) et celle gérant les connections avec la base de  données et formattant les données pour l'affichage (HistoriqueReport).
- Ajouter dans le dossier views/site les fichiers  report.php et historique.php (qu'on pourra personnalisé selon ses besoins).

- Ajouter dans le fichier controllers/SiteController les deux actions 
public function actionReport(){
    return $this->render('report');
}

public function actionHistorique()
{
    return $this->render('historique');
}

public function actionParametrages()
{
    return $this->render('parametrages');
}

- Ainsi, la visualisation de l'historique et des statistiques pourra se faire respectivement à travers les liens.
* http://localhost:8080/index.php?r=site/historique
* http://localhost:8080/index.php?r=site/report

NB : Prévoir une connexion internet, car Koolreport en necessite.

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.


INSTALLATION
------------

### Install via Composer

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install this project template using the following command:

~~~
composer create-project --prefer-dist yiisoft/yii2-app-basic basic
~~~

Now you should be able to access the application through the following URL, assuming `basic` is the directory
directly under the Web root.

~~~
http://localhost/basic/web/
~~~

### Install from an Archive File

Extract the archive file downloaded from [yiiframework.com](http://www.yiiframework.com/download/) to
a directory named `basic` that is directly under the Web root.

Set cookie validation key in `config/web.php` file to some random secret string:

```php
'request' => [
    // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
    'cookieValidationKey' => '<secret random string goes here>',
],
```

You can then access the application through the following URL:

~~~
http://localhost/basic/web/
~~~


### Install with Docker

Update your vendor packages

    docker-compose run --rm php composer update --prefer-dist
    
Run the installation triggers (creating cookie validation code)

    docker-compose run --rm php composer install    
    
Start the container

    docker-compose up -d
    
You can then access the application through the following URL:

    http://127.0.0.1:8000

**NOTES:** 
- Minimum required Docker engine version `17.04` for development (see [Performance tuning for volume mounts](https://docs.docker.com/docker-for-mac/osxfs-caching/))
- The default configuration uses a host-volume in your home directory `.docker-composer` for composer caches


CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

**NOTES:**
- Yii won't create the database for you, this has to be done manually before you can access it.
- Check and edit the other files in the `config/` directory to customize your application as required.
- Refer to the README in the `tests` directory for information specific to basic application tests.


TESTING
-------

Tests are located in `tests` directory. They are developed with [Codeception PHP Testing Framework](http://codeception.com/).
By default there are 3 test suites:

- `unit`
- `functional`
- `acceptance`

Tests can be executed by running

```
vendor/bin/codecept run
```

The command above will execute unit and functional tests. Unit tests are testing the system components, while functional
tests are for testing user interaction. Acceptance tests are disabled by default as they require additional setup since
they perform testing in real browser. 


### Running  acceptance tests

To execute acceptance tests do the following:  

1. Rename `tests/acceptance.suite.yml.example` to `tests/acceptance.suite.yml` to enable suite configuration

2. Replace `codeception/base` package in `composer.json` with `codeception/codeception` to install full featured
   version of Codeception

3. Update dependencies with Composer 

    ```
    composer update  
    ```

4. Download [Selenium Server](http://www.seleniumhq.org/download/) and launch it:

    ```
    java -jar ~/selenium-server-standalone-x.xx.x.jar
    ```

    In case of using Selenium Server 3.0 with Firefox browser since v48 or Google Chrome since v53 you must download [GeckoDriver](https://github.com/mozilla/geckodriver/releases) or [ChromeDriver](https://sites.google.com/a/chromium.org/chromedriver/downloads) and launch Selenium with it:

    ```
    # for Firefox
    java -jar -Dwebdriver.gecko.driver=~/geckodriver ~/selenium-server-standalone-3.xx.x.jar
    
    # for Google Chrome
    java -jar -Dwebdriver.chrome.driver=~/chromedriver ~/selenium-server-standalone-3.xx.x.jar
    ``` 
    
    As an alternative way you can use already configured Docker container with older versions of Selenium and Firefox:
    
    ```
    docker run --net=host selenium/standalone-firefox:2.53.0
    ```

5. (Optional) Create `yii2_basic_tests` database and update it by applying migrations if you have them.

   ```
   tests/bin/yii migrate
   ```

   The database configuration can be found at `config/test_db.php`.


6. Start web server:

    ```
    tests/bin/yii serve
    ```

7. Now you can run all available tests

   ```
   # run all available tests
   vendor/bin/codecept run

   # run acceptance tests
   vendor/bin/codecept run acceptance

   # run only unit and functional tests
   vendor/bin/codecept run unit,functional
   ```

### Code coverage support

By default, code coverage is disabled in `codeception.yml` configuration file, you should uncomment needed rows to be able
to collect code coverage. You can run your tests and collect coverage with the following command:

```
#collect coverage for all tests
vendor/bin/codecept run -- --coverage-html --coverage-xml

#collect coverage only for unit tests
vendor/bin/codecept run unit -- --coverage-html --coverage-xml

#collect coverage for unit and functional tests
vendor/bin/codecept run functional,unit -- --coverage-html --coverage-xml
```

You can see code coverage output under the `tests/_output` directory.
