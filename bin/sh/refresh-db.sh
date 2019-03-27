 #!/bin/bash
 echo "************************************* Suppression du cache ***************************************************"
 php bin/console ca:cl &&
 echo "******************************** Suppression de la base de données *******************************************"
 php bin/console doctrine:database:drop --force &&
 echo "********************************* Création de la base de données *********************************************"
 php bin/console doctrine:database:create &&
 echo "********************************* Update du schéma de la base de données *********************************************"
 php bin/console doctrine:schema:update --force &&
 echo "******************************************** Terminé *********************************************************"