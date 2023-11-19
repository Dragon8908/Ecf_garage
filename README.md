Pour installer le projet en local et le lancer sur sa machine:

Télécharger ou cloner le dépôt
Avoir composer installé avec au moins la version 2, php à la version 8 au moins et avoir XAMPP, MAMPP ou WAMPP d'installé
Faire un composer update pour récuperer les dépendances
Dans le fichier .env modifier #DATABASE_URL et #MAILER_DSN si besoin
Créer la base de données avec php bin/console doctrine:database:create et faire les migrations avec php bin/console doctrine:migrations:diff et php bin/console doctrine:migrations:migrate
Ajouter les données avec php bin/console doctrine:fixtures:load
Lancer le serveur avec symfony serve
Pour avoir accès au compte admin: email: admin@mail.fr mot de passe: adminparrot

Pour avoir accès à un compte employé: email: employe@mail.fr mot de passe: employedugarage
