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

3. Générer un fichier autoload 
```
composer dump-autoload
```

4. Modifier le fichier de configuration .env
```
DATABASE_URL="mysql://db_user:db_pass@db_host/db_name?serverVersion=mariadb-10.4.11"
```

5. Créer la base de données 
``` 
php bin/console doctrine:database:create
```

6. Générer les fichiers de migrations 
```
php bin/console make:migration
``` 
En cas d'erreur, executer la commande **`mkdir migrations`** puis relancer la commande **`php bin/console make:migration`**

7. Executer les fichiers de migrations 
``` 
php bin/console doctrine:migrations:migrate
```

8. Executer les fixtures (jeu de données initiales)
``` 
php bin/console doctrine:fixtures:load
```

9. Compléter la configuration de lexik-jwt  
  
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
