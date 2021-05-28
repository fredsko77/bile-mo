# API Bile-Mo

Installation du projet 

1. Clôner le projet
```
git clone https://github.com/fredsko77/bile-mo.git <répertoire>
```

2. Installer les dépendances 
```
composer install
``` 

3. Configurer votre accès à la base de données en mofiant la ligue ci-dessous dans le fichier .env
```
DATABASE_URL=
```

4. Créer la base de données 
``` 
php bin/console doctrine:database:create
```

5. Générer les fichiers de migrations 
```
php bin/console make:migration
``` 
En cas d'erreur, executer la commande **`mkdir migrations`** (ou créer un repertoire **migrations** à la racine du projet) puis relancer la commande **`php bin/console make:migration`**

6. Executer les fichiers de migrations 
``` 
php bin/console doctrine:migrations:migrate
```

7. Executer les fixtures (jeu de données initiales)
``` 
php bin/console doctrine:fixtures:load
```

8. Avant de compléter configuration de lexik-jwt, assurez vous que l'extension **openssl** soit bien installé sur votre poste en ouvrant une invite de commande et en tapant **openssl**
  
Créer un répertoire jwt dans le dossier config **`mkdir -p cnfig/jwt`**
  
Générer une clé privée et une clé publique avec openssl  
```
openssl genrsa -out config/jwt/private.pem -aes256 4096
```  

Récupérer la pass phrase dans le fichier .env pour décrypter la clé privée puis générer une clé pulique.   
**`JWT_PASSPHRASE=sf4jwt_bile_mo_00`**  
```
openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
```
```
chmod -R 775 config/ 
```
