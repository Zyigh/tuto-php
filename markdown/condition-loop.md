# Les conditions et les boucles

Ce qu'il nous manque désormais pour concevoir un programme intéressant, ce sont les **conditions**. En effet, il va vite être nécessaire de pouvoir déterminer si une variable contient telle ou telle chaîne de caractère, quand une requête arrive sur le serveur, si elle correspond à un cas définit, si les arguments d'un CLI ont été définit, et si oui, quelle morceau de code doit être exécuté...

## Les conditions

Les conditions dans la plupart des langages de programmation (il doit exister peut-être une exception) sont définies par le mot clé **`if`**. La syntaxe est très simple : **`if`** annonce qu'il va s'agir d'une condition, on met la condition entre **parenthèses**, sur la même ligne on ouvre une **accolade**. Le **code à exécuter** si la condtion est vrai sera écrit en dessous identé d'une tabulation de plus que la condition, et on saura où s'arrête le code à exécuter grâce à une accolade fermante une ligne plus bas, au même niveau d'indentation que le **`if`**. Plus clair : un exemple

```php
if (condition) {
    // code à exécuter
}
```

On l'a vu au [premier chapitre](/#Les-types), les booléens permettent d'évaluer une condition. C'est à dire que si ma condition vaut **`true`**, le block de code en dessous s'exécutera. Donc mettre un **booléen** comme condition n'a que peux d'intérêt :

```php
if (true) {
    // Ce code s'exécutera obligatoirement
    // La condition n'est pas nécessaire
}
if (false) {
    // Ce code ne s'exécutera jamais
    // On peut le supprimer
}
``` 

On voit bien que ce n'est pas très utile.

### Les opérateurs logiques

Afin d'avoir des conditions utiles, il faut pouvoir évaluer si une expression est vraie ou fausse. Par exemple, ça voir si les contenus deux variables sont identiques ou au contraire différentes.

#### Égalité

`===` permet d'évaluer si les contenus de deux variables sont identiques. 

```php
2 === 2     // Renvoie true
2 === "2"   // Renvoie false

$a = 2;
2 === $a    // Renvoie true

$taylor = "Swift";
$taylor === "swift"     // Renvoie false     
```

**Note :**  
On évitera d'utiliser `==` qui n'est pas assez rigoureux car il ne gère pas les types. C'est à dire que `2 == "2"` renverra `true`. Cela revient à dire qu'une **String** est égale à un **Int**, WTF PHP ? Seriously... What the fuck ?...

#### Différence

L'opérateur `!==` permet d'évaluer si deux propositions sont différentes. C'est l'inverse de **[l'égalité](#égalité)**. 

```php
2 !== 2     // Renvoie false
2 !== "2"   // Renvoie true

$a = 2;
2 !== $a    // Renvoie false

$taylor = "Swift";
$taylor !== "swift"     // Renvoie true     
```

On peut dans de nombreux vouloir évaluer plusieurs expressions, par exemple pour savoir si les deux sont vraies, au moins une est vraie, une seule est vraie. Il existe d'autres opérateurs logiques permettant d'évaluer ces expressions

#### Not

De manière général, c'est le symbole `!` qui représente l'inverse d'une proposition dans énormément de langages. En d'autre termes `$a !== $b` revient à écrire `!($a === $b)`

```php
!true   // Renvoie false 
!false   // Renvoie true
```

**Note :**  
On a utilisé des parenthèses pour retourner l'inverse de l'évaluation `$a === $b`. C'est à dire qu'on a isolé l'évaluation en mettant des parenthèses autour. Si on ne l'avait pas fait, le code aurait été interprété `(!$a) === $b`. Or comme en PHP, tous les **Int** et les **String** sont évaluées comme `true` (sauf 0 et "0"), on aurait eu un résultat différent de ce qu'on voulait faire.

#### And 

Permet d'évaluer si les deux expressions comparées valent `true`. Cela s'écrit `&&` (ou `&` pour comparer les bytes) :

```php
true && true        // Renvoie true
true && false       // Renvoie false

(2 === 2) && 1      // Renvoie true (0 vaut false, mais tous les autres Int valent true en PHP)
(((true && false) && true ) && (true && true)) && true   // Renvoie false
```

**Note :**  
Si on regarde la valeur binaire d'un **Int**, son **byte de poids faible** (celui tout à droite) détermine s'il est pair ou impair. En effet si on regarde dans un tableau pour convertir des nombres binaires en décimal, tous les bits (sauf celui de poids faible) renverront un multiple de 2, et le bit de poids faible pourra ajouter 1, et donc rendre le nombre impair, un exemple sur 4 bits :

| 8 | 4 | 2 | 1 | décimal |
| - | - | - | - | -------:|
| 0 | 1 | 1 | 0 | 6       |
| 1 | 0 | 0 | 1 | 9       |

Ainsi pour savoir si un nombre est impair, il suffit de l'évaluer `&` 1. Ainsi, les bytes seront évalués un par un, et on pourra évaluer le **byte de poids faible** & 1. Si on obtient `true` (1), cela voudra dire que le nombre est impair.

|   | 8 | 4 | 2 | 1 | résultat |
| - | - | - | - | - | --------:|
|   | 1 | 0 | 1 | 1 | (11)     |
| & | 0 | 0 | 0 | 1 |          |  
| = | 0 | 0 | 0 | 1 | vrai     |

|   | 8 | 4 | 2 | 1 | résultat |
| - | - | - | - | - | --------:|
|   | 0 | 1 | 0 | 0 | (4)      |
| & | 0 | 0 | 0 | 1 |          |  
| = | 0 | 0 | 0 | 0 | faux     |

ou en PHP :
```php
echo 12 & 1;        // Résultat false

$a = 19;
if ($a & 1) {
    printf("%d est un nombre impair", $a);
}
```

#### Or

Permet d'évaluer si au moins une des deux expressions comparées vaut `true`. Cela s'écrit `||` (ou `|` pour comparer les bytes) :

```php
true || true        // Renvoie true
true || false       // Renvoie true
(((true || false) && true ) && (true && true)) && true   // Renvoie true
```

#### Xor

Le **Ou Exclusif**. Il permet d'évaluer qu'une seule des deux expressions comparées vaut `true`. Il renvoie false dans tous les autres cas. Il s'écrit `xor` (ou `^` quand on compare les bytes) :

```php
true xor true       // Renvoie false
true xor false      // Renvoie true
```

**Note :**  
Assez naturellement, quand on doit échanger la valeur de deux variables, on utilise une troisième variable :

```php
$a = 8;
$b = 42;

// Pour échanger on fera :
$temporaire = $a;
$a = $b;
$b = $temporaire;

echo $a;    // Affiche 42
echo $b;    // Affiche 8
```

Le **Xor** binaire permet d'échanger le contenu de deux variables sans passer par une variable tierce :

```php
$a = 8;
$b = 42;

$a = $a ^ $b;
$b = $a ^ $b;
$a = $a ^ $b;

echo $a;    // Affiche 42
echo $b;    // Affiche 8
```

Quoi ? Mais comment ça se fait ? Petit zoom sur ce qu'il se passe au niveau des bits :

| déclaration | opération | 32 | 16 | 8 | 4 | 2 | 1 | valeur                            |
| ----------- | :-------- | -- | -- | - | - | - | - | :-------------------------------- |
| $a          | =         | 0  | 0  | 1 | 0 | 0 | 0 | 8                                 |
| $b          | =         | 1  | 0  | 1 | 0 | 1 | 0 | 42                                |
| $a          | = $a ^ $b | 1  | 0  | 0 | 0 | 1 | 0 | 34 (le nombre n'est pas important. Il faut juste noter que $a a une nouvelle valeur) |
| $b          | = $a ^ $b | 0  | 0  | 1 | 0 | 0 | 0 | 8 (la nouvelle valeur de $b !)    |
| $a          | = $a ^ $b | 1  | 0  | 1 | 0 | 1 | 0 | 42 (la nouvelle valeur de $a !!!) |

Voilà ! On a échangé la valeur de deux variables sans passer par une variable tierce. Comme on est un minimum consciencieux, on évitera de faire ce genre d'opération en mélangeant les types, mais ça peut être particulièrement pratique pour trier un tableau sans surcharger la stack.

#### Inférieur, supérieur

On a parfois besoin de comparer deux nombres pour savoir quel est le plus grand. Pour cela on utilisera les symboles :

* **>** pour supérieur à
* **<** pour inférieur à

Si on a besoin de vérifier si un nombre est inférieur ou égal, ou supérieur ou égal, on utilisera :

* **>=** pour supérieur ou égal à
* **<=** pour inférieur ou égal à

```php
8 > 42      // Renvoie false
8 < 42      // Renvoie true
8 > 8       // Renvoie false
8 >= 8      // Renvoie true
8 <= 8      // Renvoie true
```

### Un peu de maths

Voilà une parfaite transition pour parler un peu de mathématiques. Un point essentiel de tout langage de programmation, les opérations de base :

* L'**addition** s'écrit avec le symbole **+**
* La **soustration** s'écrit avec le symbole **-**
* La **multiplication** s'écrit avec le symbole **\***
* La **division** s'écrit avec le symbole **/**
* Le **modulo**, reste de la division euclidienne (entière), s'écrit avec le symbole **%** (`8 % 3    // Renvera 2. 8/3 = 2, il reste 2`) 
* Pour élever un nombre à une puissance, on écrira **\*\*** (`8 ** 2    // Renverra 64`)
* Pour les racines carrées, il faudra utiliser la fonction **sqrt()** (`sqrt(16)    // Renverra 4`)

#### Quelques raccourcis

On aura très souvent besoin de modifier la valeur d'une variable de type numérique. Pour cela, on évitera d'utiliser des opérations un peu lourde du genre

```php
$a = 42;
$b = 8;
// L'opération un peu lourde :
$a = $a + $b;
```

On préfèrera coller un **=** à l'opréation que l'on veut faire pour éviter de dupliquer le nom de la variable :

```php
$a = 42;
$b = 8;
// Pour l'addition
$a += $b;    // $a vaut 50
// Pour la multiplication en ne comptant pas l'addition du dessus
$a *= $b;   // $a vaut 336
// Pour la division
$a /= $b    // $a vaut 5.25
// etc...
```

**Note :**  
Pour **incrémenter** ou de **décrémenter** une variable de type numérique de **1**, c'est à dire respectivement lui ajouter ou lui enlever **1**, on raccourcira encore la formulation en utilisant **++** ou **--** :

```php
$a = 42;
// Pour incrémenter
$a++;       // $a vaut 43
// Pour décrémenter (sans tenir compte de la ligne du dessus)
$a--;       // $a vaut 41
``` 

On peut écrire le **++** ou le **--** avant la variable. Cela aura pour effet de modifier la valeur de la variable **avant** d'interprêter sa valeur :

```php
$a = 8;
echo $a++;      // Affiche 8
echo $a;        // Affiche 7

$b = 42;
echo --$b;      // Affiche 41
echo $b;      // Affiche 41
```

**Attention**, ce genre d'opération ne marchera pas sur des nombres directement (`echo ++8`). Cela reviendrait à changer la valeur de **8**. Cela n'a aucun sens. 

## Les boucles

Si la partie au dessus est bien assimilée, comprendre le fonctionnement des boucles ne devrait pas poser de problèmes. On a souvent besoin de répéter un morceau de code un certain nombre de fois. Parfois même, le nombre de fois fois ne dépend pas de nous, et on ne peut pas le connaître à l'avance. De toute façon, on va éviter tant que possible de réécrire deux fois le même code autant que possible. Pour cela on a les boucles à dispotions. Elles sont composées systématiquement d'au moins deux éléments :
* Le block de code à répéter
* Une [condition](#les-conditions) pour pouvoir sortir de la boucle. Le block de code ne sera répété que tant que la condition renverra vrai.

### While

L'essentielle. On l'écrit en suivant cette syntaxe :

```php
while (condition) {
    // Code à exécuter
}
``` 

Par exemple si on veut afficher tous les **Int** de 1 à 10, et pour reprendre ce qu'on a vu plus haut, on écrira :

```php
$a = 1;
while ($a <= 10) {
    echo $a++;
}
```
ou
```php
$a = 1;
while ($a++ <= 10) {
   echo $a;
}
```
OU
```php
$a = 0;
while ($a <= 10) {
    echo ++$a;
}
```
OOOUUUUU :
```php
$a = 0;
while (++$a <= 10) {
   echo $a;
}
```

Bien évidemment si la condition vaut false dès le début, la boucle ne sera jamais exécuté :

```php
while (false) {
    // Ce morceau de code ne sera jamais exécuté
}
```

### Do While

On a parfois (rarement) besoin d'exécuter le block de code au moins une fois avant de vérifier la condition. On pourrait être tenté de faire :

```php
// Mon code une première fois
while (//condition) {
    // Copier coller de mon code
}
```

Malheureusement, on déteste tous la répétition qui est fatiguante, illisible, et difficile à maintenir. Pour éviter cela, on tuilisera le **Do... While** qui s'écrira logiquement :

```php
do {
    // Ce code s'exécutera une fois avant d'évaluer la condition
} while (//condition)
```

### For

La boucle **For** est très pratique. Elle permet de définir une variable (en général celle dont on va se servir pour la condition), la condition, et une opération mathématique à faire à chaque tour (comme incrémenter la variable définie juste avant par exemple) sur la même ligne, ce qui permet de gagner énormément en lisibilité. On l'écrire tel que suit :  
`for (paramètre d'initialisation ; condition ; opération)`  
C'est très pratique pour parcourir un tableau dont les index sont des **Int** qui se suivent par exemple :


```php
$arr = [12, 32, 68, 12];
$length = count($arr);

for ($i = 0; $i < $length; $i++) {
    echo $arr[$i];
}
```

Deux choses à dire sur ce petit bout de code... 

Déjà la fonction `count()`, qui prend en paramètre un tableau, et qui renvoie la longueur du tableau (ici, il y a 4 éléments, donc 4). On aurait pu écrire directement en condition `$i < count($arr)` mais cela pose un problème logique. Puisque la condition est évaluée à chaque tour de boucle, on réexécute la fonction `count()` autant de fois qu'on itère sur le tableau. Sur un tableau dont la longueur n'a pas vocation à être modifiée, il n'y a aucun intéret. On aurait pu par contre définir plusieurs paramètres dans la première partie de la définition de la boucle :

```php
$arr = [12, 32, 68, 12];

// Les paramètres d'initialisation sont séparés par une virugle
for ($i = 0, $length = count($arr); $i < $length; $i++) {
    echo $arr[$i];
}
```

Ensuite une petite note, écrire `++$i` à la place `$i++` n'aurait strictement rien changé, puisque cette instruction est exécuté en fin de boucle. Pour l'écrire en utilisant une [boucle while](#while) on aurait du faire :

```php
$arr = [12, 32, 68, 12];
$i = 0;
$length = count($arr);

while ($i < $length) {
    echo $arr[$i];
    $i++
}
```

C'est un peu plus long, donc c'est pas cool !

**Note :**  
En **PHP**, les variables définies dans la boucle **for** n'appartiennent pas au scope de la boucle. C'est à dire qu'elle n'existe pas que dans le block de code à répeter. On peut donc les appeler après l'exécution de la boucle :

```php
for ($i = 0; $i < 4; $i++) {
    printf("Dans la boucle : %d%s", $i, PHP_EOL);
}
printf("Hors de la boucle : %d", $i);

// Affichera :
Dans la boucle : 0
Dans la boucle : 1
Dans la boucle : 2
Dans la boucle : 3
Hors de la boucle : 4
```

Et oui, la partie où a incrémenté `$i` est bien exécuté après le dernier tour de boucle. Si on devait écrire le code que la boucle `for` a remplacé, on aurait :

```php
$i = 0;
if ($i < 4) {
     printf("Dans la boucle : %d%s", $i, PHP_EOL);
     $i++;
}
// $i vaut 1
if ($i < 4) {
     printf("Dans la boucle : %d%s", $i, PHP_EOL);
     $i++;
}
// $i vaut 2
if ($i < 4) {
     printf("Dans la boucle : %d%s", $i, PHP_EOL);
     $i++;
}
// $i vaut 3
if ($i < 4) {
     printf("Dans la boucle : %d%s", $i, PHP_EOL);
     $i++;
}
// $i vaut 4. Celui là n'est pas exécuté
if ($i < 4) {
     printf("Dans la boucle : %d%s", $i, PHP_EOL);
     $i++;
}
printf("Hors de la boucle : %d", $i);
```

### Foreach

La boucle **foreach** permet de parcourir facilement un tableau associatif.

#### Les tableaux associatifs

En **PHP**, tous les tableaux sont associatifs. Cela signifie que les différentes valeurs du tableau ne sont pas stockées en mémoire à la suite, mais que chaque index du tableau correspond à une case mémoire où on trouvera la valeur associée (pour résumer TRÈS TRÈS (trop) brièvement). **PHP** est fait de telle sorte que si l'index n'est pas défini, il vaudra 0, et le prochain index non définit vaudra 1 de plus que le dernier index non définit. L'index peut être un **Int** ou une **String** :

```php
$mon_tableau_associatif = [
    "valeur",
    "clé" => "valeur",
    8 => "valeur",
];

print_r($mon_tableau_associatif);
// Affichera 
Array
(
    [0] => valeur
    [clé] => valeur
    [8] => 42
)
```

#### foreach en action

La boucle **foreach** permet donc de parcourir facilement un tableau associatif. Elle peut renvoyer la valeur de chaque index, mais aussi l'index qui correspond, ce qui peut-être bien pratique très souvent :

```php
$m_t_a = [
    "valeur",
    "clé" => "blop",
    8 => "valeur",
];

foreach ($m_t_a as $value) {
    printf("%s%s", $value, PHP_EOL);
}
// Affichera 
valeur
blop
valeur

foreach ($m_t_a as $key => $value) {
    printf("clé : %s => valeur : %s%s", $key, $value, PHP_EOL);
}
// Affichera 
clé : 0 => valeur : valeur
clé : clé => valeur : blop
clé : 8 => valeur : valeur
```  

## Petite conclusion

### PHP_EOL

Ce petit nouveau qui a fait son apparition n'est pas si folichon que ça. C'est une constante de **PHP**. Il s'agit d'une chaîne de caractère qui représente le retour à la ligne. Cela permet d'avoir plus de lisibilité quand on affiche un résultat dans une boucle.

### Les bases, c'est bon !

Arrivé à ce point, le mieux à faire est peut-être de tout relire depuis le début. En effet, on a fait le tour des bases de **PHP**. Le minimum à savoir parfaitement puisqu'il permet de pouvoir créer n'importe quel programme. Toute la programmation ne se résume qu'à des variables, des conditions et des boucles. C'est le minimum à savoir dans n'importe quel langage.

Afin de mettre toutes ces bases en application, on va pouvoir l'exercice classique qui reprend tout ce qu'on a vu : [trier un tableau](/array-sort).



