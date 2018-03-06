https://www.nouvelobs.com/rue89/notre-epoque/20180221.OBS2557/conflit-de-loyaute-si-je-travaille-bien-a-l-ecole-vais-je-trahir-mes-parents.html?utm_campaign=Echobox&utm_medium=Social&utm_source=Facebook#link_time=1519721291

# Gestion des tweets dans l'algo 

## Module 1 

Pour chaque compte twitter : 
    * On envoie un objet contenant :
        - Une URL
        - Un type
        - Un tableau vide
        - Un nombre d'occurences
    * Quand l'URL est reconnue comme un lien twitter ou si son type est "twitter".
    * On recupère le nombre d'occurences. Si le nombre d'occurences n'est pas défini dans l'objet, on récupèrera 2.
    * On récupère l'URL dans une variable. Si l'URL n'est pas définie dans l'objet, on récupère " ".
    * On récupère l'URI (partie à partir du premier slash dans l'URL). à partir de l'URL.
    * On va stocker dans une variable (**docm**) le résultat de l'opération :
        - On se connecte sur l'API de twitter
        - On demande à la base de données "cache" de récupérer un objet qui a un index "screen_name" dont la valeur est l'URI et on le stocke dans une variable
        - Si la variable n'a pas de valeur :
            + On ajoute en base de données un objet qui a un index "screen_name" et pour valeur l'URI, et une liste vide dans laquelles les tweets seront rattachés
            + On demande à la base de données "cache" de récupérer un objet qui a un index "screen_name" dont la valeur est l'URI et on le stocke dans la variable vide
    * Si le premier tweet à voir est le premier de la feed :
        - On récupère tous les tweets
    * Sinon :
        - On récupère tous les tweets à partir du dernier récupéré (exclus)
    * Pour chaque tweet récupéré, :
        - S'il n'existe pas dans **docm**, on l'ajoute
        - Sinon on autorise le programme à s'arrêter
    * On enregistre **docm** dans la base de données
    * On stocke dans le tableau vide les tweets récupérés
    * Si on a des nouveaux tweets ET qu'on n'a PAS autorisé l'arrêt du programme :
        - On recommence toutes ces opérations en précisant que le tweet le plus vieux est le dernier qu'on a récupéré
    * Sinon :
        - On renvoie tous les tweets
    
## Module 2 

Pour chaque tweet : 
    * On refait tout ce que fait le module 1
    * On stocke dans un tableau : les entreprises suivies, le référent, le texte et l'url
    * On formate les données pour indiquer l'avancement de la tâche

Les résultats sont récupérés après (et à part) pour être envoyé à Watson pour l'analyse.










