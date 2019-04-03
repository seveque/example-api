# Example-api
Une application toute simple avec api-platform, servant de base pour nos sessions d'apprentissage.


### Prerequisites
A github personal access token 

## How to install with docker

```
git clone git@github.com:seveque/example-api.git
```
```
cp .env .env.local
```
```
docker-compose build --build-arg GITHUB_TOKEN=your_token
```

```
docker-compose up
```

## Etapes

Le projet avance au grès de nos apprentissages et questions, et peut de ce fait ne pas être très ordonné !
Cependant les sessions seront tagguées et si possible repertoriées ici.

#### step-0
Installation projet symfony avec api-platform

#### step-1
Ajout des entités / ressources

#### step-2
Ajout de la collection de tests postman

#### step-3
Ajout d'un type uuid à la place d'un integer pour l'id

#### step-4
Ajout docker et upgrade version api-platform

#### step-5
Ajout grumphp et php-cs-fixer et quelques autres outils de qualité





