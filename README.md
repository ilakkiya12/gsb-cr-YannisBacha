# GSB-CR

Application Web GSB de gestion des comptes-rendus de visite.

## Consignes d'installation

* Accepter [l'invitation Classroom for GitHub](https://classroom.github.com/assignment-invitations/222d6a8764c145c279c3f6261d9a4454) pour obtenir le dépôt GitHub `gsb-cr-VotreLogin`.
* Cloner ce dépôt dans le répertoire de travail du serveur Web (exemple : `c:\xampp\htdocs` avec XAMPP pour Windows).
* Configurer Apache et le fichier `hosts` pour définir un hôte virtuel `gsb-cr` (ET NON `gsb-cr-VotreNom`) vers ce répertoire. Exemple avec XAMPP sous Windows :

```
<VirtualHost *:80>
    DocumentRoot "C:\xampp\htdocs\gsb-cr-VotreLogin\web"
    ServerName gsb-cr
    <Directory "C:\xampp\htdocs\gsb-cr-VotreLogin\web">
        AllowOverride all
    </Directory>
</VirtualHost>
```

* Créer la base de données `gsb` à l'aide des scripts fournis, dans cet ordre :
    1. `crt_base.sql`
    2. `crt_tables.sql`
    3. `insert_content.sql`
    4. `crt_constraints.sql`

* Télécharger les composants nécessaires avec la commande `composer install`.
* Tester l'application à l'URL http://gsb-cr.



