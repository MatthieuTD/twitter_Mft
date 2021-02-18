# Projet Twitter MFT 

``git clone https://github.com/MatthieuTD/twitter_Mft.git``

## Lancer le projet

 1- ````composer install````
 
 2- Mettre vos identifiants de Bdd dans le fichier .env
  
 3- Créer votre BDD : ``php bin/console d:s:u --force``
 
 4- Load le jeu de données``php bin/console doctrine:fixtures:load
`` 
 
 - Comptes de test = simon@test.fr, mdp: simon
                    fabricio@test.fr, mdp: fabricio

 5- ``symfony server:start
 ``

## pages

- /login 
- /account
- /feed
- /register


## Fonctionnalitées

- Follow/unfolow
- Ajout/suppresion de Twette
- Affichage des tweet et retweet
- Système de retweet
- Login
- Register 


