## Introduction

Tronscan permet aux Super Représentants de publier leurs informations à l'endroit même où les votes ont lieu, sur Tronscan!

Les Super Représentants peuvent utiliser ce modèle pour concevoir une page qui sera visible sur Tronscan. Le lien sera placé sur la page d'aperçu des votes à côté du nom du Super Représentant.

Les Super Représentants peuvent gérer leur propre contenu en éditant des fichiers dans le référentiel Github.

## Directives d'utilisation

**Ce guide suppose que vous avez déjà un compte avec le statut de Super Représentant (candidat).**

### Etape 1: Copier/reprendre le modèle sur GitHub.

* Allez sur https://github.com/tronscan/tronsr-template
* Reprenez le référentiel  
    ![](https://raw.githubusercontent.com/tronscan/docs/master/images/fork-repo.png)

Après avoir repris le référentiel, vous naviguerez dans votre propre version du `tronsr-template` où vous pourrez effectuer des changements.

## Etape 2: Remplissez le modèle

Le modèle peut désormais être modifié en éditant les fichiers sur GitHub.

* Cliquez sur le fichier que vous désirez éditer.  
    ![](https://raw.githubusercontent.com/tronscan/docs/master/images/github-open-file.png)
* Cliquez sur le mode d'édition (edit mode)![](https://raw.githubusercontent.com/tronscan/docs/master/images/github-edit-file.png)
* Ajoutez quelques informations au fichier ![](https://raw.githubusercontent.com/tronscan/docs/master/images/edit-team-intro.png)

Les fichiers sont écrits au format markdown (.md) Une excellente introduction est disponible sur : https://guides.github.com/features/mastering-markdown/

* Mettez à jour le logo (logo.png) ainsi que la bannière (banner.png)  
    ![](https://raw.githubusercontent.com/tronscan/docs/master/images/github-upload-files.png)  
    Cliquez sur "choose your files" pour choisir un fichier, vérifiez que le logo ou la bannière que vous désirez mettre à jour est nommé `logo.png` ou `banner.png` afin de remplacer les images initiales.

Après avoir rempli le modèle, il peut être publié sur https://tronscan.org

## Etape 3: Publier sur Tronscan

* Rendez-vous sur https://tronscan.org
* Connectez-vous à votre compte. Dans cet exemple, la clé privée sert à s'authentifier, cependant n'importe quelle méthode de connexion peut être utilisée.  
    ![](https://raw.githubusercontent.com/tronscan/docs/master/images/login-with-private-key.png)
* Cliquez sur ACCOUNT et prenez soins de vérifier que le statut "Representative" est visible.  
    ![](https://raw.githubusercontent.com/tronscan/docs/master/images/open-account.png)
* Défilez en bas de la page et cliquez sur "Set GitHub Link" ![](https://raw.githubusercontent.com/tronscan/docs/master/images/set-github-link.png)
* Entrez votre nom d'utilisateur GitHub et appuyez sur "Link GitHub"  
    ![](https://raw.githubusercontent.com/tronscan/docs/master/images/input-username.png)
* Cliquez sur "View" pour afficher votre nouvelle page !  
    ![](https://raw.githubusercontent.com/tronscan/docs/master/images/view-page.png)

## Exemple

L'exemple ci-dessous montre la disposition de chaque images. Chaque fois que le fichier GitHub sera modifié, la page sera instantanément mise à jour.

![](https://raw.githubusercontent.com/tronscan/docs/master/images/example-page.png)

## FAQ

* **J'ai modifié un fichier mais les modifications ne sont pas visibles sur tronscan.org?**  
    Les contenus du référentiel sont diffusés à l'aide du CDN Github qui utilise une mise en cache agressive. Par conséquent, quelques minutes peuvent s'écouler avant que les modifications soient répercutées sur tronscan.org.
* **Pourquoi est-ce que les éléments HTML sont visibles sur GitHub mais pas sur tronscan.org?**  
    Tronscan.org supprime toutes les balises HTML pour des raisons de sécurité, seules les balises standards du format markdown sont autorisées.