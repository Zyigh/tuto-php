# La suite

Bien évidemment on n'a pas vu toutes les bases (il manque au moins les conditions et les boucles). Mais au niveau où on est, il sera peut-être plus intéressant de travailler dans un navigateur avant le nervous breakdown.

## Démarrer son serveur

On lit sur la grande majorités des tutos PHP, la nécessité d'utiliser [MAMP](https://cdn.shopify.com/s/files/1/1061/1924/products/Poop_Emoji_7b204f05-eec6-4496-91b1-351acc03d2c7_large.png?v=1480481059) (ou LAMP, ou XAMP) pour commencer PHP. Il vaut mieux éviter, c'est lourd, et pas très performant. Et l'économie de temps que l'on fait en passant par ce logiciel est vraiment minime par rapport à utiliser chacun des logiciels ((pour) Mac, Apache (serveur), MySQL (base de données), PHP).

**PHP** contient un serveur intégré. Dans votre terminal (plus pour longtemps, promis), si vous entrez 

```bash
php --help
```

on peut lire sur une des lignes :

```bash
-S <addr>:<port>        Run with built-in web server.
```

Nous n'aurons pas besoin d'Apache pour ce cours. Comme adresse disponible, on se contentera de **localhost** ou **127.0.0.1**. Comme port, par convention, on en utilisera un compris entre **8000** et **9000**, mais on peut choisir n'importe quel nombre entre 1024 et 65535. Quand on voudra démarrer un serveur, il suffira d'exécuter dans un terminal :

```bash
php -S localhost:8000
``` 

Un serveur démarrera alors et aura pour racine le répertoire courant. Le flag `-t` permettra de choisir le directory qui sera point d'entrée du serveur.

```bash
php -S localhost:8888 -t public
# Démarre un serveur dans le directory ./public
```
Quand on ira à cette adresse (http://localhost:8888/), le serveur cherchera `index.php` pour l'exécuter. S'il ne le trouve pas, il cherchera index.html. S'il ne trouve pas, il cherchera à afficher les fichiers et directories à la racine. S'il n'a toujours rien, il afficher une page "The requested resource / was not found on this server." et renverra un **[code http](https://fr.wikipedia.org/wiki/Liste_des_codes_HTTP)** `404`


### Organisation de l'espace de travail

**NOTE :**  

On a créé un nouveau directory dans lequel on va mettre notre projet pour les exercices (appliquer la théorie). On va l'appeler practice parce que c'est un nom rigolo, et que ça veut dire "entraine toi" en américain. Le dossier sera oranisé tel que suit :

```
practice
├── README.md
├── public
│   ├── css
│   │   └── styles.css
│   ├── index.php
│   └── javascript
│       └── script.js
└── scripts
    └── server:start
```

#### README.md

Avec un peu de chance, ce petit projet sera amené à évoluer. Un README peut être l'occasion de prendre des notes, expliquer comment marche l'application (à terme on va faire un vrai site internet hein?), décrire la configuration pour la faire marcher, donner des précisions sur certains morceaux de code pas forcément évidents à comprendre.

#### public

Pourquoi un directory `public` ? Tout simplement par souci de sécurité. On ne rendra publique qu'une partie des informations (CSS, JavaScript). Seul PHP sera à même d'aller chercher des informations en amont du serveur. Le problème d'un code complètement publique, c'est qu'il est accessible à n'importe qui, et certains en feront n'importe quoi.

L'idée donc c'est de rendre inaccessible le code que l'on va exécuter, et s'assurer qu'aucun utilisateur ne puisse exécuter de code dans l'application.

#### scripts

Certaines tâches vont être longues à réaliser et redondantes. On va donc créer des executables, principalement en shell (mais peut-être dans d'autres langages aussi !) pour se simplifier la vie. En plus ça a l'avantage d'apprendre à utiliser shell à partir de petits scripts très pratiques.

## Petite digression sur Shell Unix

Il s'agit d'un interpréteur de commandes qui permet d'accéder aux fonctionnalités de son système d'exploitation ([Wikipedia](https://fr.wikipedia.org/wiki/Shell_Unix)). En gros, le Shell, c'est les commandes qu'on écrit dans le terminal pour écrire un fichier (`pico`, `nano`, `vi`, `vim`, `emacs`), pour se déplacer dans les répertoires (`cd`), déplacer des fichiers (`mv`) (au passage, `mv` sert aussi à renommer un fichier. En fait on le déplace dans le même répertoire en lui donnant un nombre différent), effacer des fichiers (`rm`), copier des fichiers/dossiers (`cp`, `rsync`)...

Le gros avantage, c'est que cela se fait beaucoup plus rapidement sans interface graphique. Le problème c'est que la visibilité de l'arborescence n'est pas forcément aussi évidente.

On ne va pas lister ici toutes les commandes existantes, on va se contenter de les apprendre au fur et à mesure.

### Mon premier script bash ?

Bash, c'est [Bourne-Again SHell](https://fr.wikipedia.org/wiki/Bourne-Again_shell). C'est le Shell par défaut sur les macs. Pourquoi on a téléchargé ZSH si c'est pour faire des scripts pour Bash ? ZSH nous sera utile pour faciliter la communication avec Git (un des prochains chapitres !!!), mais il implémente toutes les fonctionnalités de **bash**. Comme bash est le shell par défaut, on est globalement sûr que **TOUT LE MONDE** (les gens sur Windows n'existe pas sur le même plan astral, ils ne sont pas inclus dans tout le monde) pourra exécuter les scripts.

### Mon premier script bash !

Un script shell, bash ou zsh a pour extension `.sh` par convention. Il peut ne pas en avoir comme avoir n'importe quelle extension. Pour s'entrainer à utiliser la ligne de commande, on va écrire le script (très court...) grâce à l'éditeur de texte `pico`.

À partir du dossier practice, on va donc écrire dans le fichier script/server:start. Pour cela on va exécuter la commande :

```bash
pico script/server:start
```

### SHEBANG !!!

Un nouveau monde s'offre à nous. Un éditeur de texte très simple est ouvert sur une page vierge, il n'y a donc rien d'écrit. [Le shebang, représenté par #!, est un en-tête d'un fichier texte qui indique au système d'exploitation (de type Unix) que ce fichier n'est pas un fichier binaire mais un script (ensemble de commandes) ; sur la même ligne est précisé l'interpréteur permettant d'exécuter ce script.](https://fr.wikipedia.org/wiki/Shebang).

Puisque notre script sera écrit pour être exécuter par bash, on écrira :

```bash
#!/bin/bash
```

On fera ensuite **CTRL**+ O pour enregistrer les modifications.

Bien évidemment, si on voulait faire le script en PHP, le shebang serait (en considérant l'installation avec homebrew) :
```bash
#!/usr/local/bin/php
```

### Let's get serious

Maintenant que voulons nous faire ? Et bien automatiser le lancement du serveur. C'est à dire, dans l'idéal, exécuter `script/server:start`, que cela lance un serveur PHP dans le dossier public, et que notre navigateur s'ouvre à l'adresse du serveur.

On a vu déjà comment [démarrer un serveur **PHP** en ligne de commande](/before-action). Ce qu'il nous manque c'est un peu plus de précision. On sait que les directories **script** et **public** sont au même niveau. Dans un premier temps, ce qu'il nous faudrait, ce serait pouvoir, à partir du script, remonter d'un cran, et démarrer le serveur dans le directory public.

#### CHMOD

Pour déterminer le chemin du fichier, on écrira dans notre script

```bash
echo $0
```

Et oui, les commandes UNIX et les fonctions des langages de programmations se ressemblent beaucoup. On sera souvent amené à se dire "je veux faire ça en tel langage, mais je ne sais le faire que dans tel autre langage". On recherchera sur Google "Telle fonction tel langage" et se rendre compte sur la première page de Stackoverflow qu'il s'agit de la même...

##### Les variables

C'est l'occasion d'expliquer le `$0`. En Shell, on déclare une variable en lui donnant un nom et en lui associant une valeur séparée d'une virgule sans espace. On l'appelle en mettant le signe `$` suivi du nom :
```bash
perfection="Taylor Swift <3"
echo perfection
// Affiche : perfection
echo $perfection
// Affiche : Taylor Swift <3
```

`$0`, c'est une super variable. `$#` (l'écriture générique pour ces super variables, les [Positional Parameters](http://www.gnu.org/software/bash/manual/bashref.html#Positional-Parameters) qui vont de 0 à 9), ça représente dans l'ordre les arguments passé au scripts. Si on imagine un script bash dans le directory courant qui porte le nom original de *monscript.sh*, pour l'appeler on ferait :

```bash
./monscript.sh argument1 argument2 argument3
```
On pourrait imaginer le script correspondant :
```bash
echo $0
// Affiche : ./monscript.sh 
echo $1
// Affiche : argument1 
echo $2
// Affiche : argument2 
echo $3
// Affiche : argument3
echo $4
// Affiche : 

```

*Note :*
```bash
bash ./monscript.sh argument1 argument2 argument3
```
*Produira le même résultat.*

#### CHMOD !!!!

Chouette digression. On va désormais essayer d'executer le script (je pars du principe qu'on est dans le répertoire *practice*). On exécute :
```bash
scripts/server:start
```
Et on obtient le message d'erreur : 
```bash
zsh: permission denied: practice/scripts/server:start
```

Il s'agit donc d'un problème de permission. C'est quoi ça ? Si on exécute la commande :
```bash
l sripts
```
On devrait obtenir quelque chose comme :
```bash
-rw-r--r--  1 Zyigh  staff   130B Feb 11 20:16 practice/scripts/server:start
```

*Note :*
*`l` est un alias sur **zsh** de `ls -lah --color=auto`. C'est à dire `ls`: liste le directory, `-l`: avec un maximum de détail, `-a`: même les dossiers système (ceux qui commencent par un point), `h`: lisible pour les humains, `--color=auto`: avec de la couleur si possible* 

Analysons le premier bloc du résultat. C'est celui là qui détermine les permissions accordées à l'administrateur, au groupe, et à l'utilisateur. On peut le diviser en 4 parties :

* **Le type :**

    * `-` pour un **fichier**
    * `d` pour un **directory**
    * `l` pour un **lien symbolique**
    * `b` pour un **block special file**
    * `c` pour un **character special file**
    * `p` pour un **FIFO**
    * `s` pour un **socket link**
    
* **Les permissions** :

    Elles sont divisées en 3 parties de 3 lettres. Une partie pour l'administrateur, une partie pour le groupe, une partie pour l'utilisateur. Les 3 lettres représentent les actions autorisées pour chacune des parties.

    * r : READ
        
        Possibilité de lire ou de lire la liste des fichiers qui le composent.
        
    * w : WRITE
    
        Possibilité d'écrire, de modifier le contenu d'un fichier, son nom...
        
    * x : EXECUTE
    
        Possibilité d'exécuter le fichier. Il faut faire très attention avec cela, on peut se retrouver à exécuter du code malicieux.
        
Si la permission est accordée, la lettre sera écrite. Sinon, on verra un `-` à la place. Pour un **fichier** pour lequel l'administrateur à tous les droits, et le groupe et l'utilisateur les droits de lectures et d'execution, on verra :
```bash
-rwxr-xr-x
```

**NOTE :**
On est dans un état binaire pour chaque permission : Soit on a la permission, soit non. On peut donc écrire sous la forme suivante :
```bash
-111101101
```
On voit donc qu'on peut donner une valeur décimal qui correspond aux permissions selon le schéma : x = 1, w = 2, r = 4. Et en les additionant on a 8 valeurs qui correspondent aux différentes permissions.

| Permissions | Binary | Become |
|:-----------:|:------:|:------:|
| ---         | 000    | 0      |
| --x         | 001    | 1      |
| -w-         | 010    | 2      |
| -wx         | 011    | 3      |
| r--         | 100    | 4      |
| r-x         | 101    | 5      |
| rw-         | 110    | 6      |
| rwx         | 111    | 7      |

##### Quelques exemples

| Type | Admin | Group | User | Numérique | En Français                                                                                          | 
| ---- | ----- | ----- | ---- | --------- | ---------------------------------------------------------------------------------------------------- |
| -    | rw-   | r--   | r--  | 644       | Un fichier où l'admin a le droit de lecture et d'écriture, user et group ont juste droit de lecture  |
| d    | rwx   | r-x   | r-x  | 755       | Un dossier où l'admin a tous les droits, user et group ont droit de lecture et d'exécution           |
| l    | rwx   | rwx   | rwx  | 777       | Un lien symbolique que tout le monde peut lire, écrire ou exécuter                                   |
| -    | ---   | ---   | ---  | ---       | Un fichier que personne ne peut lire, écrire ou exécuter                                             |

##### Back to business

Il nous faut donc donner les bonnes permissions à notre script. Comme on n'est pas des bourrins, On va donner tous les droits à l'admin, mais seulement les droits de lecture et d'exécution aux autres. Il faudra donc exécuter la commande suivante :
```bash
sudo chmod 755 scripts/server:start
```
On rentre notre mot de passe (qui ne s'affiche pas) et ça y'est, on peut exécuter notre script !
```bash
scripts/server:start
```

### Notre serveur, on en est où ?

Logiquement, il ne contient que 

```bash
echo $0
```

Et maintenant qu'on l'a rendu exécutable, si on l'appelle dans le terminal, on verra s'afficher :

```bash
scripts/server:start
``` 

On cherche à récupérer le nom du répertoire, pour remonter d'un cran, et démarrer un serveur dans le directory `script`.

Un peu de méthode, décomposons la phrase :

* On cherche à récupérer le nom du répertoire :

    En américain, **[get directory name of file](http://www.google.com/search?q=get+directory+name+of+file+bash)**. Premier résultat de la recherche, on cherche la commande `dirname`. Mais cela ne nous convient toujours pas ! On veut récupérer le chemin absolu du fichier, en américain encore, **[get absolute path](http://www.google.com/search?q=get+absolute+path+bash)**. Premier résultat de recherche encore, `realpath`.
    
    On a donc trouvé comment afficher le chemin absolu du directory dans lequel on va démarrer un serveur, on récupèrera donc sa valeur de la même manière qu'on récupère le contenu d'une variable :
    
    ```bash
    $(realpath `dirname $0`)
    ```
    
    À noter que la partie `dirname $0` est écrite entre backquote. Cela permet au script de comprendre qu'il faut d'abord exécuter cette instruction, et que la commande `realpath` traitera le résultat de celle ci.

* Remonter d'un cran :

    `..`, on connaît déjà 
    
* Démarrer un serveur dans un directory :

    ```bash
    php -S localhost:8000 -t [Chemin/Vers/Mon/Repertoire]
    ```

On va y rajouter la commande open pour être directement envoyé dans un navigateur. Pour résumer, notre script devrait ressembler à :

```bash
dirname=$(realpath `dirname $0`)
entrypoint="$dirname"/../public/

open http://localhost:8000/
php -S localhost:8000 -t "$entrypoint"
```

*NOTE :*
*On a écrit la commande `open` avant le démarrage du serveur pour permettre l'ouverture. En effet, si on l'écrit après, le serveur monopolisant la session du terminal en cours, il faudra éteindre le serveur pour que le navigateur s'ouvre.*

*On a aussi appelé les variables entre **"** par souci de lisibilité, mais aussi pour éviter des conflits au niveau des variables et de leur nom. C'est pas parce que notre script est tout petit qu'il ne faut pas mettre en place de bonnes pratiques !*

## Conclusion :

Notre espace de travail est prêt, **[On va pouvoir passer à du code plus sérieux](/condition-loop)**. 
