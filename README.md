# Mediatekformation
## Application d'origine
L'application d'origine est consultable en suivant ce lien : https://github.com/CNED-SLAM/mediatekformation <br>
La documentation est disponible dans le readme du dépot ci-dessus.
<br>
## Présentation
Ce site, développé avec Symfony 6.4, permet d'accéder aux vidéos d'auto-formation proposées par une chaîne de médiathèques et qui sont aussi accessibles sur YouTube.<br> 
Actuellement, seule la partie front office a été développée. La partie back-office permet de gérer les formations et playlists proposées une fois connécter avec un login et un mot de passe   Elle contient les fonctionnalités globales suivantes :<br>
![img](https://github.com/BHFTY/mediatekformation/blob/5a1d0e368dc81f5e97da82409ad5dcfde02cc709/BTS.PNG?raw=true)
## Les différentes pages

### Page 1 : l'accueil
Cette page présente le fonctionnement du site et les 2 dernières vidéos mises en ligne.<br>
La partie du haut contient une bannière (logo, nom et phrase présentant le but du site) et le menu permettant d'accéder aux 3 pages principales (Accueil, Formations, Playlists).<br>
Le centre contient un texte de présentation avec, entre autres, les liens pour accéder aux 2 autres pages principales.<br>
La partie basse contient les 2 dernières formations mises en ligne. Cliquer sur une image permet d'accéder à la page 3 de présentation de la formation.<br>
Le bas de page contient un lien pour accéder à la page des CGU : ce lien est présent en bas de chaque page excepté la page des CGU.<br>
![img](https://github.com/BHFTY/test3/blob/master/Accueil.PNG?raw=true)
### Page 2 : les formations
Cette page présente les formations proposées en ligne (accessibles sur YouTube).<br>
La partie haute est identique à la page d'accueil (bannière et menu).<br>
La partie centrale contient un tableau composé de 5 colonnes :<br>
•	La 1ère colonne ("formation") contient le titre de chaque formation.<br>
•	La 2ème colonne ("playlist") contient le nom de la playlist dans laquelle chaque formation se trouve.<br>
•	La 3ème colonne ("catégories") contient la ou les catégories concernées par chaque formation (langage…).<br>
•	La 4ème colonne ("date") contient la date de parution de chaque formation.<br>
•	LA 5ème contient la capture visible sur YouTube, pour chaque formation.<br>
Au niveau des colonnes "formation", "playlist" et "date", 2 boutons permettent de trier les lignes en ordre croissant ("<") ou décroissant (">").<br>
Au niveau des colonnes "formation" et "playlist", il est possible de filtrer les lignes en tapant un texte : seuls les lignes qui contiennent ce texte sont affichées. Si la zone est vide, le fait de cliquer sur "filtrer" permet de retrouver la liste complète.<br> 
Au niveau de la catégorie, la sélection d'une catégorie dans le combo permet d'afficher uniquement les formations qui ont cette catégorie. Le fait de sélectionner la ligne vide du combo permet d'afficher à nouveau toutes les formations.<br>
Par défaut la liste est triée sur la date par ordre décroissant (la formation la plus récente en premier).<br>
Le fait de cliquer sur une miniature permet d'accéder à la troisième page contenant le détail de la formation.<br>
![img](https://github.com/BHFTY/test3/blob/master/Formation.PNG?raw=true)
### Page 3 : détail d'une formation
Cette page n'est pas accessible par le menu mais uniquement en cliquant sur une miniature dans la page "Formations" ou une image dans la page "Accueil".<br>
La partie haute est identique à la page d'accueil (bannière et menu).<br>
La partie centrale est séparée en 2 parties :<br>
•	La partie gauche contient la vidéo qui peut être directement visible dans le site ou sur YouTube.<br>
•	La partie droite contient la date de parution, le titre de la formation, le nom de la playlist, la liste des catégories et sa description détaillée.<br>
![img](https://github.com/BHFTY/test3/blob/master/D%C3%A9tailsFormation1.PNG?raw=true)
### Page 4 : les playlists
Cette page présente les playlists.<br>
La partie haute est identique à la page d'accueil (bannière et menu).<br>
La partie centrale contient un tableau composé de 3 colonnes :<br>
•	La 1ère colonne ("playlist") contient le nom de chaque playlist.<br>
•	La 2ème colonne ("catégories") contient la ou les catégories concernées par chaque playlist (langage…).<br>
•	La 3ème contient un bouton pour accéder à la page de présentation de la playlist.<br>
Au niveau de la colonne "playlist", 2 boutons permettent de trier les lignes en ordre croissant ("<") ou décroissant (">"). Il est aussi possible de filtrer les lignes en tapant un texte : seuls les lignes qui contiennent ce texte sont affichées. Si la zone est vide, le fait de cliquer sur "filtrer" permet de retrouver la liste complète.<br> 
Au niveau de la catégorie, la sélection d'une catégorie dans le combo permet d'afficher uniquement les playlists qui ont cette catégorie. Le fait de sélectionner la ligne vide du combo permet d'afficher à nouveau toutes les playlists.<br>
Par défaut la liste est triée sur le nom de la playlist.<br>
Cliquer sur le bouton "voir détail" d'une playlist permet d'accéder à la page 5 qui présente le détail de la playlist concernée.<br>
![img](https://github.com/BHFTY/test3/blob/master/Playlists.PNG?raw=true)
### Page 5 : détail d'une playlist
Cette page n'est pas accessible par le menu mais uniquement en cliquant sur un bouton "voir détail" dans la page "Playlists".<br>
La partie haute est identique à la page d'accueil (bannière et menu).<br>
La partie centrale est séparée en 2 parties :<br>
•	La partie gauche contient les informations de la playlist (titre, liste des catégories, description).<br>
•	La partie droite contient la liste des formations contenues dans la playlist (miniature et titre) avec possibilité de cliquer sur une formation pour aller dans la page de la formation.<br>
![img](https://github.com/BHFTY/test3/blob/master/DetailsPlaylists.PNG?raw=true)
### Page 6 : Page de connexion 
![img](https://github.com/BHFTY/test3/blob/master/Login.PNG?raw=true)
Cette page offre à l'administrateur la possibilité de s'authentifier dans la section de gestion du site en utilisant ses identifiants (nom d'utilisateur et mot de passe). L'accès à cette page se fait en ajoutant /admin à l'URL du site.
### Page 7 : Page des formations 
![img](https://github.com/BHFTY/test3/blob/master/FormationAdmin.PNG?raw=true)
Cette page est accessible uniquement lorsque l'administrateur est connecté. Elle s'inspire du modèle de la page de gestion des formations du front office. Dans le header, un bouton de déconnexion a été intégré, permettant ainsi de clore la session d'administration du site. Juste en dessous du menu de navigation, le titre de la page est clairement affiché au-dessus du tableau de données. Une colonne dédiée à la gestion inclut deux boutons, offrant la possibilité d'éditer ou de supprimer une formation existante. En haut de la page, un bouton permet d'ajouter une nouvelle formation. Lorsqu'un utilisateur clique sur le bouton de suppression, un pop-up s'affiche pour confirmer l'action de suppression.
### Page 8 :  Ajouter une formation
![img](https://github.com/BHFTY/test3/blob/master/AjoutFormation.PNG?raw=true)
Cette interface est présentée lorsque l'administrateur sélectionne l'option d'ajout d'une nouvelle formation. Elle intègre le même en-tête et le même pied de page que les autres sections du back-office, tout en affichant un titre distinct. Un formulaire vierge est mis à disposition, où le champ destiné à l'identifiant de la vidéo YouTube de la formation se trouve à gauche, tandis que les champs relatifs à la date, au titre, à la playlist, à la catégorie et à la description de la formation sont disposés à droite. Il convient de noter que seuls la description et la catégorie ne sont pas soumis à l'obligation de remplissage. Le champ de la date est présenté sous la forme d'un sélecteur de date et d'heure (DateTimePicker) et doit impérativement indiquer une date antérieure à celle du jour courant. Un bouton de validation, intitulé "enregistrer", permet de soumettre le formulaire pour traitement.
### Page 9 : Modifier une formation
![img](https://github.com/BHFTY/test3/blob/master/D%C3%A9tailsFormation.PNG?raw=true)
Cette interface se présente lorsqu'un administrateur sélectionne l'option d'édition d'une formation. Elle se rapproche de la page dédiée à l'ajout d'une formation, mais le formulaire est déjà pré-rempli avec les données pertinentes de la formation choisie par l'utilisateur.
### Page 10 : Page des Playlists
![img](https://github.com/BHFTY/test3/blob/master/Playlist.PNG?raw=true)
Cette interface se manifeste lorsque l'administrateur sélectionne l'option "Playlists" dans le menu de navigation. Elle présente des similitudes avec la page des playlists accessible en front-office. À l'instar de la section dédiée aux formations dans l'interface d'administration, cette page comporte une colonne de gestion permettant d'ajouter, de modifier ou de supprimer une playlist. De surcroît, l'activation du bouton de suppression engendre l'affichage d'une fenêtre contextuelle sollicitant une confirmation de la suppression. Il convient de noter que la suppression d'une playlist n'est envisageable que si celle-ci est dépourvue de contenu. Dans le cas contraire, un message d'erreur sera affiché en haut de l'écran pour en avertir l'utilisateur.
### Page 11 : Ajout d'une playlist
![img](https://github.com/BHFTY/test3/blob/master/AjoutPlaylist.PNG?raw=true)
Cette interface se présente lorsque l'administrateur sélectionne l'option "ajouter une playlist". Il s'agit d'un formulaire comportant les champs "nom" et "description". Le champ "nom" est le seul requis. Un bouton étiqueté "enregistrer" permet de soumettre le formulaire.
### Page 12 : Modification d'une playlist
![img](https://github.com/BHFTY/test3/blob/master/ModificationPlaylist.PNG?raw=true)
Cette page s'affiche lorsque l'administrateur clique sur "Editer" dans la colonne gestion des playlists. A gauche, on retrouve le même formulaire que celui présent sur la page d'ajout d'une playlist. Il est pré-rempli avec les informations de la playlist.
### Page 13 : Page des carégories
![img](https://github.com/BHFTY/test3/blob/master/GestionCat%C3%A9gorie.PNG?raw=true)
Cette interface se manifeste lorsque l'administrateur sélectionne l'option "catégories" dans le menu de navigation. Elle est dotée d'un en-tête ainsi que d'un formulaire destiné à l'ajout de nouvelles catégories. Il convient de noter qu'une catégorie ne peut être ajoutée que si elle n'existe pas déjà dans la base de données. En outre, un tableau est présenté en dessous, composé de deux colonnes : la première colonne affiche les désignations des catégories, tandis que la seconde colonne est dédiée à la gestion, comportant un bouton permettant de procéder à la suppression de la catégorie correspondante sur la ligne où se trouve le bouton. L'activation de ce bouton de suppression déclenche une fenêtre contextuelle de confirmation.
## La base de données
La base de données exploitée par le site est au format MySQL.
### Schéma conceptuel de données
Voici le schéma correspondant à la BDD.<br>
![img](https://github.com/BHFTY/test3/blob/master/BaseDonn%C3%A9e.PNG?raw=true)
<br>video_id contient le code YouTube de la vidéo, qui permet ensuite de lancer la vidéo à l'adresse suivante :<br>
https://www.youtube.com/embed/<<<video_id>>>
### Relations issues du schéma
<code><strong>formation (id, published_at, title, video_id, description, playlist_id)</strong>
id : clé primaire
playlist_id : clé étrangère en ref. à id de playlist
<strong>playlist (id, name, description)</strong>
id : clé primaire
<strong>categorie (id, name)</strong>
id : clé primaire
<strong>formation_categorie (id_formation, id_categorie)</strong>
id_formation, id_categorie : clé primaire
id_formation : clé étrangère en ref. à id de formation
id_categorie : clé étrangère en ref. à id de categorie</code>

Remarques : 
Les clés primaires des entités sont en auto-incrémentation.<br>
Le chemin des images (des 2 tailles) n'est pas mémorisé dans la BDD car il peut être fabriqué de la façon suivante :<br>
"https://i.ytimg.com/vi/" suivi de, soit "/default.jpg" (pour la miniature), soit "/hqdefault.jpg" (pour l'image plus grande de la page d'accueil).
## Test de l'application en local
- Vérifier que Composer, Git et Wamserver (ou équivalent) sont installés sur l'ordinateur.
- Télécharger le code et le dézipper dans www de Wampserver (ou dossier équivalent) puis renommer le dossier en "mediatekformation".<br>
- Ouvrir une fenêtre de commandes en mode admin, se positionner dans le dossier du projet et taper "composer install" pour reconstituer le dossier vendor.<br>
- Dans phpMyAdmin, se connecter à MySQL en root sans mot de passe et créer la BDD 'mediatekformation'.<br>
- Récupérer le fichier mediatekformation.sql en racine du projet et l'utiliser pour remplir la BDD (si vous voulez mettre un login/pwd d'accès, il faut créer un utilisateur, lui donner les droits sur la BDD et il faut le préciser dans le fichier ".env" en racine du projet).<br>
- De préférence, ouvrir l'application dans un IDE professionnel. L'adresse pour la lancer est : http://localhost/mediatekformation/public/index.php<br>

## Tester l'application en ligne 
L'application est disponible en ligne à l'adresse suivante : https://cohenrivkamediatekformation.go.yj.fr/mediatekformation/public/
Pour accéder à la partie admin il faut rajouter admin à l'adresse : https://cohenrivkamediatekformation.go.yj.fr/mediatekformation/public/admin
