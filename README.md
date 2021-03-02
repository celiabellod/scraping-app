## Description du projet
    Vous allez créer une application multi-utilisateur qui permet d'extraire des données d'un site web (web scraping). L'utilité de cette application va permettre qui a une personne ayant une bonne connaissance en HTML de pouvoir de créer des alertes de prix ou d'informations sur ses thèmes d'intérêt. Votre objectif est de réaliser un outil permettant de :

    * Générer des notifications de mise à jour des données
    * Gérer l'affichage des extractions

## Processus de l'application

    Au départ la personne doit créer un compte utilisateur avec validation du compte par email.
    Quand la personne est connecté elle va ajouter un site web dont elle veut extraire des données
        * Elle définit si c'est un jeu de données ou des données simples
        * Elle définit l'élément racine contenant le jeu de données ou la donnée simple
        * Elle définit les éléments de données à extraire
        * Elle définit type de données des éléments à extraire (Texte, nombre, monétaire..)
        * Elle définit la périodicité de l'extraction
        * Elle définit la catégorie de l'extraction (Information, comparaison, prix...)
    Le serveur exécute les extractions d'après la périodicité et stocke les données dans la base de données.


## Fonctionnalités

    * L'utilisateur peut modifier les informations de son compte
    * l'utilisateur peut modifier son mot de passe avec confirmation par email
    * L'utilisateur peur supprimer son compte
    * L'utilisateur peut créer, modifier, supprimer une demande d'extration
    * L'utilisateur peut lancer manuellement une extraction et afficher en direct le résultat.
    * L'utilisateur peut voir l'historique d'une extraction.
    * L'utilisateur peut aussi aficher ou supprimer un élément de l'historique. 
    * L'utilisateur peut supprimer l'historique complet d'une extraction
    * L'utilisateur peut extraire les données au format excel ave un editeur d'extration pour gérer l'affichage et l'ordre des colonnes ainsi que le tri des données.



Vous avez le droit d'utiliser de bundle ou librairie de scraping web, de générer des fichiers Excel et de templating. Vous devez créer votre propre classe de routeur. Votre projet utilisera l'architecture MVC et sera complétement écrit en programmation orientée objet.


## Objectifs d'apprentissage

    * Concevoir une maquette
    * Concevoir un diagramme de classe
    * Concevoir un MVC
    * Programmer en PHP POO
