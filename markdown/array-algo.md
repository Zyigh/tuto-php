# Algorithmes autour des tableaux

## Qu'est-ce qu'un algorithme ?

Un algorithme, c'est un mot super compliqué pour dire "une suite d'action définie". Par exemple mon algorithme de réveil pourrait être décrit : "Éteindre le réveil tant qu'il sonne".

Un ordinateur étant très bête (il ne fait QUE ce qu'on lui dit de faire), il faudra bien sûr plus expliciter. Par exemple, pour faire traverser une route à un robot, il faudra vérifier :  

Qu'il y a une route, qu'il y a un autre côté de la route, que l'on est au bord de la route, qu'il y a un endroit pour traverser, qu'il n'y a pas de voiture qui vient de la droite ou de la gauche, ... C'est un excellent exercice que de décomposer en une somme d'action extrêmement simple n'importe quelle action du quotidien. Comment je fais pour me lever ? Comment je fais pour me servir de l'eau...

## Binary Search

### En théorie

La recherche par dychotomie est un bon exercice pour pratiquer les bases d'un langage. Cet algorithme très intuitif permet de chercher une valeur dans un tableau **trié**. Il est tellement efficace qu'il est parfois plus optimisé de trier un tableau puis de rechercher une valeur dedans plutôt que de rechercher directement la valeur.

Le meilleur exemple pour le représenter, c'est le jeu de "je pense à un nombre entre 1 et 100, je te dis si ce que tu proposes est plus petit ou plus grand". L'approche la plus naïve est d'essayer tous les nombres. Cela ne nous intéresse pas, on ne veut demander que des nombres ayant un intérêt significatif.

On va donc diviser en deux le tableau, autant de fois qu'il sera nécessaire pour trouver la valeur recherchée.

### En pratique

On va prendre un maximum de hauteur pour bien comprendre le fonctionnement. Mettons en pratique. Doc Evil pense à 42, N°2 doit deviner. On peut dire que Doc Evil pense à 42 dans un tableau qui va de 0 à 100 :

```bash
N°2      : 50     // Divise le tableau en 2
Doc Evil : C'est plus petit
// N°2 ne s'occupe plus que de la première partie du tableau
N°2      : 25
Doc Evil : C'est plus grand
// N°2 a encore réduit le tableau de moitié
N°2      : 37
Doc Evil : C'est plus grand
N°2      : 43
Doc Evil : C'est plus petit
N°2      : 40
Doc Evil : C'est plus petit
N°2      : 41
Doc Evil : C'est plus grand
N°2      : 42
Doc Evil : OK !
```

Il aura fallut 7 **itérations** pour trouver un nombre parmi 100. On est donc sur un système beaucoup plus efficace que d'essayer toute les valeurs. Si on décompose :
```bash
N°2 FAIT
    N°2 prend en compte l'ensemble des possibilités en marquant le plus petit possible et le plus grand possible.
    N°2 Propose la moyenne de ces 2 nombres (arrondi à l'entier inférieur)
    Si Doc Evil dit "OK !" : C'est fini
    Sinon
        Si Doc Evil dit que c'est plus grand :
            Le plus petit nombre possible devient le nombre proposé
        Si Doc Evil dit que c'est plus petit :
            Le plus grand nombre possible devient le nombre proposé
TANT QUE Ce n'est pas fini, et que le nombre le plus petit possible n'est pas plus grand que le nombre le plus grand possible
```

### Pratiquer la pratique

```php
$arr = [];
$max = 100000;
for ($i = 0; $i <= $max; $i++) {
    $arr[] = $i;
}
$needle = rand(0, $max);
// Your objective is to find $needle in $arr
```

## Trier un tableau





