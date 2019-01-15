# Tuto PHP

**PHP**, ça veut dire **P**HP, **H**ypertext **P**reprocessor. C'est un langage qui s'exécute côté serveur. L'utilisation que l'on va faire de ce langage est très simple, mais essentielle : Lors d'une requête vers un serveur, le serveur va exécuter un script qui va générer le contenu textuel à afficher sur le navigateur, les headers de la requête...  

On partira du principe que vous êtes sur MAC parce que vous êtes des beaux gosses. Si vous êtes sur Linux, ça devra pas être trop dur de traduire. Si vous êtes sur Windows, vous êtes un looser.

## Pré-requis

On va travailler d'abord dans un [terminal (sérieux)](https://www.iterm2.com/) avant de créer des scripts à executer afin de s'assurer des bases solides. Si possible utiliser [ZSH](https://gist.github.com/derhuerst/12a1558a4b408b3b2b6e) comme shell, plus pratique pour plein de raisons :smile:

### Installation PHP

D'abord vérifier de quelle version de PHP est équipée. Dans un [terminal](https://www.iterm2.com/), éxécuter la commande
```bash
php -v
```
qui devrait renvoyer quelque chose comme
```
PHP 7.2.2 (cli) (built: Oct  6 2017 01:07:48) ( NTS )
Copyright (c) 1997-2017 The PHP Group
Zend Engine v3.1.0, Copyright (c) 1998-2017 Zend Technologies
```
La version 7.1 de **PHP** nous permettra de pouvoir *"typer"* (autant que faire se peut...), ce qui sera un énorme gain de temps au niveau de la *documentation* et du *debugging*. Elle offre la possibilité du type **nullable**, type optionnel vachement stylé !

La version 7.0 pourrait suffir, mais risque de causer quelques bugs quand on typera un retour de fonction comme **nullable**.

**Si vous n'avez pas PHP 7.1** :

La [documentation de ZSH](https://gist.github.com/derhuerst/12a1558a4b408b3b2b6e) vous explique comment installer ZSH avec [Homebrew](https://brew.sh/index_fr.html). [Plus d'infos ici !](https://developerjack.com/blog/2016/installing-php71-with-homebrew/)

**NOTE : On peut prendre la 7.2.3 tant qu'on y est**  
**NOTE : installer coreutils !!! `brew install coreutils`**

## Les bases

Pour commencer, on va découvrir les bases de PHP directement [shell interactif](http://php.net/manual/fr/features.commandline.interactive.php). Pour cela, dans un [terminal](https://www.iterm2.com/), on va executer la commande :
```bash
php -a
```
Notre terminal ne comprend désormais plus que le **PHP**.

**TOUTES LES INSTRUCTIONS SE TERMINENT MAINTENANT PAR UN POINT-VIRGULE (;)**

### Les types

* String

    La chaîne de caractère. Elle s'écrit entre **double quote** (") ou **simple quote** ('). Essayez la commande :
    ```php
    echo gettype("Ceci est une string");
    // affiche String
    ```
    
* Integer (ou Int)

    Les nombres entiers signés. Cela inclus aussi les entiers négatifs :
    ```php
    echo gettype(1);
    // affiche Integer
    echo gettype(-1);
    // affiche Integer
    echo gettype("1");
    // affiche String
    ```

* Float, Double

    Les nombres à virgule flottante. Les nombres à virgule (la virgule étant toujours un point (.) en PHP) :
    ```php
    echo gettype(1.234);
    // affiche Double
    ```

* Boolean

    Vrai ou Faux : **true** ou **false**. Permet d'évaluer une condition. **Attention**, en **PHP**, les Integer peuvent être interprétés comme des Booléens : 0 vaut **false**, tous les autres int valent **true**
    ```php
    echo gettype(true);
    // affiche Boolean
    ```  

* Array

    Les Array (ou tableaux) permettent de structurer les données. C'est très pratique pour stocker un ensemble de données qui vont ensemble. Par exemple, pour un ensemble de notes, au lieu de stocker chaque note dans une variable différente, on pourra les stocker dans un tableau. On déclare les tableaux avec des crochets ( [] ), et on écrit chaque valeur séparée par une virgule.
    ```php
    echo gettype([1,2,3,4]);
    // affiche Array
    ```

* Object, Callable, Iterable

    On verra ça plus tard, par soucis de cohérence.

### Les variables

Évidemment, toutes ces données brutes sont inutiles. On aura intérêt à les stocker pour pouvoir les utiliser et les modifier. Pour cela on a les **variables**. Une varibale se *déclare* (on lui donne un nom) avec une chaine de caractère sans accent précédé d'un `$`. On l'assigne en mettant un `=` après, séparé d'un espace, puis la valeur qu'on souhaite lui attribuer. On *l'appelle* par son nom. Appeler une variable telle quelle ne sert à rien si on n'en fait rien.
```php
$name;
$name = "BOOOOOUUUUUUUM !!!!";
$name;
// N'affiche rien
``` 
**PAR CONTRE**
```php
$name;
$name = "BOOOOOUUUUUUUM !!!!";
echo $name;
// Affiche BOOOOOUUUUUUUM !!!!
``` 

Cela marche pour tout type de variable
```php
$string = "La réponse à la grande question de l'univers, de la vie et de tout ce qui est.";
$int = 42;
$bool = true;
$float = 42.08;
```

### Actions de base

* echo

    LA commande de base qui sert à afficher des **Strings**. Si on demande d'afficher un **Int**, il sera casté en chaîne de caractère. Si on demande d'afficher un **Boolean**, il affichera *1* pour *true* et *0* pour *false*. **echo** est l'instruction qu'on utilise depuis le début pour afficher.
    
* var_dump()

    LA commande créée pour sauver la vie. Permet d'afficher n'importe quel type de variable de manière brute, en précisant son type. Très pratique pour le debugging, elle permet par exemple de vérifier le contenu 
    
* Concaténer

    Concaténer, c'est mettre bout à bout deux chaînes de caractères. Si on fait (sur la même ligne) :
    ```php
    echo "Ceci ressemble "; echo "à une concaténation"; echo ", mais c'est bien pourri !";
    // Résultat : Ceci ressemble à une concaténation, mais c'est bien pourri !
    ```
    Effectivement, dans le terminal, on execute les trois instructions avant d'afficher le résultat. Mais on exécute quand même trois fois l'instruction pour afficher (`echo`). Concaténer ça serait rassembler plusieurs chaînes de caractères en une pour exécuter une seule instruction d'affichage. Il y a plusieurs moyens de faire cela.
    * echo, séparé par une virgule :
    
        ```php
        echo "Ceci est ", "une concaténation", ", mais c'est pas ouf";
        // Résultat : Ceci est une concaténation, mais c'est pas ouf
         
        ```
        Dans le cas où on devrait concaténer des variables on pourrait faire :
        ```php
        $a = "Concaténer ";
        $b = "ses kewl ! lol";
        echo $a,$b;
        // Résultat : Concaténer ses kewl ! lol
        ```
        Le problème de cette méthode, c'est qu'il est impossible de stocker le résultat de cette concaténation. On va donc éliminer d'office cette manière de faire.
        
    * Binder les variables dans les chaîne des caractères : 
        
        **À condition d'utiliser des double quotes**, on peut directement binder le contenu d'une variable dans une chaîne de caractère. C'est pas super propre, même carrément sale.
    
        ```php
        $a = "concaténation";
        echo "Ceci est une $a mais c'est vraiment pas propre";
        // Résultat : Ceci est une concaténation mais c'est vraiment pas propre
        ``` 
        Une manière un poil moins sale mais bien puante consiste à mettre en valeur les variables injectées de cette façon en les entourrant de brackets ( {} ). Ça reste globalement très crado et pas du tout recommandé.
        
        ```php
        $a = concaténation;
        echo "Ceci est toujours une {$a} qui craint sa mère";
        // Résultat : Ceci est toujours une concaténation qui craint sa mère
        ```
        Attention, cela ne marche pas quand on utilise des simple quotes
        ```php
        $a = "trolololo";
        echo 'Ceci n\'est pas une concaténation ! {$a}';
        // Résultat : Ceci n'est pas une concaténation ! {$a}
        ```
    
    * . :
    
        Une manière de concaténer plus propre consiste à joindre les deux chaînes de caractère en mettant un **.** entre les deux.
        ```php
        echo "Ma première concaténation "."n'est pas trop dégueu";
        // Résultat : Ma première concaténation n'est pas trop dégueu
        ```
        Présenté comme ça, ça ressemble énormément au coup de la virgule. La différence ? On peut stocker le résultat :
        ```php
        $a = "Ceci est une concaténation ","mais bon c'est chelou";
        // Résultat : Parse error
        $a = "Ceci est une concaténation "."et c'est propre";
        echo $a;
        // Résultat : Ceci est une concaténation et c'est propre
        $a = "La concaténation marche ";
        $b = "même entre variables.";
        $c = " OF COURSE !";
        echo $a . $b . $c;
        // Résultat : La concaténation marche même entre variables. OF COURSE !
        ```
    
    * printf / sprintf
    
        À mon goût la méthode la plus propre.  
        D'abord un petit aperçu de `print`. C'est une commande à peu près équivalente à echo, elle permet d'afficher du texte. `echo` est le standard, et si vous voulez des benchmarks de la différence entre `echo` et `print`, je vous laisse chercher par vous même ([On peut commencer ici déjà...](http://www.google/com/search?q=print+vs+echo+php)).
        
        La **fonction `printf`**, ça veut dire *"print format"*. Elle prend en argument (entre les parenthèses qui suivent) une chaine de caractère, suivies de tous les arguments à binder dedans.  
        Dans la chaîne de caractère, on va représenter les variables par un **symbole** pour représenter le type de la variable à injecter. Les valeurs des variables qui suivent seront mises dans l'ordre à la place des symboles. 
        **Si le type n'est pas respecté, une valeur wtf s'affiche.**  
        Les **symboles** sont une suite de deux caractères, un **%** suivi d'une lettre qui permettra d'identifier le type attendu. Dans le cas d'un arguement non chaîne de caractère, printf bind la chaîne de caractère avec une image de l'argument de type String. [La liste des lettres est disponible sur la doc de PHP](http://php.net/manual/fr/function.sprintf.php). Cette doc présente aussi ces fonctions (`printf` et `sprintf`) de manière beaucoup plus fine (gérer l'ordre d'apparition des arguments dans le format, ).
        Pour faire simple, pour concaténer deux chaînes de caractères, on utilise **%s**, pour un entier, on utilise **%d**.
         
        *Quelques exemples :*
        ```php
        printf("aaa");
        // Résultat : aaa;
        printf("%s", "aaa");
        // Résultat : aaa;
        $a = "aaa";
        printf("%s", $a);
        // Résultat aaa
        $a = "aaa";
        $b = "bbb";
        printf("aaa%s", $b);
        // Résultat : aaabbb
        $a = "aaa";
        $b = "bbb";
        printf("%s%s", $a, $b);
        // Résultat aaabbb
        $a = "aaa";
        $b = "bbb";
        printf("%2$s %1$s", $a, $b);
        // Résultat erreur => les $ étant entre double quotes, php cherche la variable $s
        printf("%2\$s %1\$s", $a, $b);
        //OU
        printf('%2$s %1$s', $a, $b);
        // Résultat bbb aaa
        ```
        
        Cependant, `printf` ne permet pas de stocker la nouvelle chaine de charactères issue de la concaténation de plusieurs autres. À la place, elle renvoie la longueur de la chaîne de charactères générée.
        
        ```php
        $a = printf('%s', 'aaa');
        // Résultat : aaa
        echo $a;
        // Résultat : 3
        ```
    
        Pour stocker la valeur, on utilisera `sprintf` (*silent print format*).
        
        ```php
        $a = sprintf('%s%s', "aaa","bbb');
        echo $a;
        // Résultat : aaabbb
        ```
    
    * print_r
    
        Dans certains cas, on est amenés à vouloir afficher un tableau PHP de manière brute. En effet, `echo` retourne une erreur si on essaye de lui faire afficher un tableau. Pour cela, on utilise la fonction `print_r`.
        
        ```php
        $array = ["a","b","c","d","e"];
        echo $array;
        // Resultat : erreur de type (Array to String convertion)
        print_r($array);
        // Résultat : 
        // Array 
        // (
        //    [0] => "a"
        //    [1] => "b"   
        //    [2] => "c"   
        //    [3] => "d"   
        //    [4] => "e"   
        // )
        ```
    
### Conclusions

Si ces bases sont bien intégrées, on va pouvoir passer à la suite. C'est à dire lancer un serveur, et lui faire exécuter du code PHP pour afficher un contenu sur une page web. [Ça se passe ici !!!](./before-action)
    