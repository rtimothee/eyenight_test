Test technique Eyenight
========================

**Temps :** 20h (2 soirées et la journée du samedi) 

**Stack Technique :**

- Parse (imposé)
- Symfony 3.3
- Sass
- Webpack avec @symfony/webpack-encore

**Compatibilité :** FF, Chrome, Safari

La compatibilité IE11 n'a pas pu être faite par faute de temps et d'accès à un windows. Cependant j'ai utilisé les Flexbox CSS3 qui ont un comportement différent sur IE donc il y a de fortes chances que le placement des div (header, footer, et liste des events) soit incorrect.

Concepts mis en place / bonnes pratiques 
-------

- Git rebase régulier afin de garder un index de commit propre
- Symfony :
    - des interfaces pour les managers afin de pouvoir changer le système de base de donnée de manière simplifiée (Passer de Parse à un autre service par exemple)
    - Listeners afin de faire des verifications sur l'authentification au chargement des pages
- Intégration :
    - Flexbox CSS3
    - Ajax en Javascript natif plutôt qu'en jQuery pour éviter d'alourdir le chargement de la page


A améliorer/ajouter
-------
- Ajouter des Tests unitaires
- Unifier les Managers afin de respecter des standards de récupération de la donnée
- Revoir et rendre plus générique le système de requêtes pour les relations entre les objets
- Améliorer le système de connexion pour utiliser les Rôles Symfony et le SecurityBundle
- Passer tout le Front en SPA (Single Page Application) afin d'obtenir plus de dynamisme et de fluidité
- Liste des événements à trier par distance
