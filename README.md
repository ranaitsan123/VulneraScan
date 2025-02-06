# [VulneraScan - Outil d'Analyse des Vulnérabilités pour Applications Web](https://just-cues-876870.framer.app/)

![version](https://img.shields.io/badge/version-2.1.0-blue.svg)

![Image Preview](https://github.com/user-attachments/assets/8768f8d5-ed2c-44e3-9a82-9eb01d684079)

VulneraScan est un outil automatisé permettant d’identifier et d’évaluer les vulnérabilités des applications web. Il intègre **OWASP ZAP** pour scanner les applications à la recherche de failles de sécurité courantes telles que **les injections SQL**, **les failles XSS** et **CSRF**. L'objectif est d'offrir une solution simple, efficace et accessible aux développeurs et entreprises pour sécuriser leurs applications.

This tutorial will guide you through the process of installing and running MedicaReport on your local machine.

## Table of Contents

- [Aperçus](#apercus)
- [Pré-requis](#pré-requis)
- [Installation](#installation)
- [File Structure](#structure-du-fichier)
- [Fonctionnalités](#fonctionnalites)
- [Browser Support](#compatibilite-navigateur)
- [Technologies utilisées](#technologies-utilisees)
- [Customization](#personnalisation)
- [Contributing](#contribuer)
- [Resources](#resources)
- [Help Us Fix Bugs!](#aidez-nous-a-corriger-les-bugs)
- [Technical Support or Questions](#technical-support-or-questions)
- [Useful Links](#resources)
- [Licensing](#license)

## Demo

| Dashboard page                                                                                                                                                                                | Login page                                                                                                                                                                                 | Signup page                                                                                                                                                                                |
| --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| ![Dashboard page](https://github.com/user-attachments/assets/eb19ad43-7c93-4896-8a70-ba2997198a17) | ![Login page](https://github.com/user-attachments/assets/87f8b22a-1ba3-43b8-bafc-3cef54b0bbcb) | ![Signup page](https://github.com/user-attachments/assets/759ca996-aa60-49c3-a35d-62ca895ae3ee) |

| Reports page                                                                                                                                                                         | About page                                                                                                                                                                                | Home page                                                                                                                                                                                |
| -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| ![Reports page](https://github.com/user-attachments/assets/e1b710b4-ba85-4893-8e58-6bbb794a3e6b) | [![About page](https://github.com/user-attachments/assets/37ac89ec-d474-46f6-9cfe-6dab80e4450f)](https://github.com/user-attachments/assets/3a8ff9c0-170a-45c8-8bc1-c4786564dc22) | [![Home page](https://github.com/user-attachments/assets/f132341a-bd92-4c1d-ae93-27ea977d823f)](https://medica-report.framer.website/)|

## Pré-requis

- PHP 7+ et MySQL
- Java 8+ (si utilisation de l'intégration Java)
- OWASP ZAP installé ([Téléchargement](https://www.zaproxy.org/download/))
- XAMPP (serveur Apache + MySQL)
- Ngrok pour l'accès distant

## Installation

**Etape 1: Cloner le projet**

```bash
git clone https://github.com/ranaitsan123/VulneraScan.git
cd VulneraScan
```

**Etape 2: Configuration de la base de données**

- Importer ```scanner.sql``` dans MySQL
- Modifier ```db_conn.php``` pour ajouter les accès à votre base de données

**Etape 3: Lancer l’application**

- Démarrer XAMPP (Apache & MySQL)
- Accéder au projet : ```http://localhost/VulneraScan```

**Etape 4: Exécuter un scan**

- Ouvrir ```ZAP``` et activer l’API
- Se connecter à l'interface et entrer l’URL cible
- Lancer l’analyse et télécharger le rapport

## Structure du fichier

Dans le téléchargement, vous trouverez les répertoires et fichiers suivants :

```
VulneraScan
  ├── assets
  │   ├── css
  │   ├── fonts
  │   ├── img
  │   ├── js
  │   │   ├── core
  │   │   ├── plugins
  │   │   └── argon-dashboard.js
  │   │   └── argon-dashboard.js.map
  │   │   └── argon-dashboard.min.js
  │   └── scss
  │       ├── argon-dashboard
  │       └── argon-dashboard.scss
  ├── pages
  │   ├── contact_us.php
  │   ├── dashboard1.php
  │   ├── db_conn.php
  │   ├── historique.php
  │   ├── index.php
  │   ├── login.php
  │   ├── logout.php
  │   ├── scan.php
  │   ├── signup-check.php
  │   ├── signup.php
  │   ├── telechargement_pdf.php
  │   ├── view_result.php
  │   ├── zap_integActive.php
  │   ├── zap_integSpider.php
  │   └── style.css
  └── scanner.sql
```

## Fonctionnalités

**1. Scan des vulnérabilités 🔍:**
Détection des failles courantes sur les applications web.

**2. Rapports détaillés 📊:**
Génération de rapports en **JSON/PDF**, avec des graphes illustrant les niveaux de risque.

**3. Historique des scans 📜:**
Consultation et téléchargement des rapports précédents.

**4. Interface Web intuitive 🌐:**
Exécution des scans directement depuis un navigateur.

**5. Accès distant sécurisé 📡:**
Déploiement facilité grâce à **ngrok**.

**6. Support multi-langages 🔧:**
Intégration en **Java** et **PHP**.

## Personnalisation

VulneraScan est hautement personnalisable et peut être enrichi avec les fonctionnalités suivantes :

- **🔑 Authentification JWT :**
Mise en place de JSON Web Tokens (JWT) pour une authentification sans état, améliorant la sécurité et l'évolutivité.

- **📊 Amélioration des rapports PDF avec l'IA :**
Intégration d'algorithmes de Machine Learning pour prédire les tendances de sécurité et générer des rapports plus intelligents.

- **🕒 Page d’historique des scans :**
Ajout d'une page dédiée pour consulter rapidement les scans passés et réduire la charge de traitement.

- **🛡 Sécurité avancée :**
Intégration d’un système de gestion des utilisateurs basé sur **Oracle** ou **PostgreSQL** pour une meilleure sécurité des authentifications.

- **☁ Déploiement sur le cloud :**
Hébergement sur **AWS**, **Google Cloud** ou **Heroku** pour une accessibilité mondiale et une meilleure gestion des ressources.

## Compatibilité Navigateur

VulneraScan est compatible avec les deux dernières versions des navigateurs suivants :

<img src="https://s3.amazonaws.com/creativetim_bucket/github/browser/chrome.png" width="64" height="64"> <img src="https://s3.amazonaws.com/creativetim_bucket/github/browser/firefox.png" width="64" height="64"> <img src="https://s3.amazonaws.com/creativetim_bucket/github/browser/edge.png" width="64" height="64"> <img src="https://s3.amazonaws.com/creativetim_bucket/github/browser/safari.png" width="64" height="64"> <img src="https://s3.amazonaws.com/creativetim_bucket/github/browser/opera.png" width="64" height="64">

## Technologies utilisées

- **Back-end :** PHP, Java, MySQL

- **Front-end :** HTML, CSS, Bootstrap, JavaScript, jQuery, Chart.js
  
- **Base de données :** MySQL
  
- **Sécurité & Scan :** OWASP ZAP API
  
- **Déploiement & Tunneling :** Ngrok
  
- **Serveur web :** Apache (XAMPP)
  
- **Rapports :** jsPDF, JSON

## Contribuer 🤝

Nous accueillons toutes les contributions pour améliorer VulneraScan. Si vous souhaitez contribuer, suivez ces étapes :

1. **Forkez** le dépôt.
2. **Créez une nouvelle branche** pour vos modifications.
3. **Effectuez vos changements.**
4. **Committez vos modifications** avec un message clair.
5. **Soumettez une Pull Request.**
   
Assurez-vous que votre code respecte le style existant et inclut des tests si nécessaire.

## Contributeurs

- **[Rana Shafi](https://github.com/RanaShafi04)**
- **Salma Sohbi**
- **Aicha Lahnite**
  
👩‍💻 **Encadré par :** Pr. Laila Fetjah

## Resources

- Demo Video: < >
- Documentation Boostrap Tempaltes: <https://www.creative-tim.com/learning-lab/bootstrap/overview/argon-dashboard>
- VulneraScan Home Page: <https://just-cues-876870.framer.app/>
- Support: <https://www.linkedin.com/in/aicha-lahnite/>
- Issues: [Github Issues Page](https://github.com/ranaitsan123/VulneraScan/issues)

## Aidez-nous à corriger les bugs !

Nous travaillons activement à l'amélioration de VulneraScan et nous avons besoin de votre aide ! Si vous trouvez des bugs ou rencontrez des problèmes, voici comment vous pouvez contribuer :

- **Signalez le bug :** Ouvrez un ticket dans la section Issues en décrivant clairement le problème et les étapes pour le reproduire.
- **Corrigez le bug :** Si vous êtes familier avec le code, vous pouvez directement corriger le problème en forkant le projet, en créant une branche et en soumettant une pull request.
- **Améliorez l’outil :** Même si vous ne trouvez pas de bug, toute amélioration, optimisation ou nouvelle fonctionnalité est la bienvenue !
  
Vos contributions aident à rendre VulneraScan meilleur pour tout le monde — merci de faire partie de cette aventure !

## License

Ce projet est sous licence MIT. Voir [LICENSE]() pour plus de détails.

## Social Media

Linkedin: [Aicha Lahnite](https://www.linkedin.com/in/aicha-lahnite/) | [Rana Shafi](https://www.linkedin.com/in/rana-shafi-74149b2bb/)

Email: halaicha300@gmail.com | 

Discord: aicha_a1000 <halaicha300@gmail.com>

Github: [Aicha Lahnite](https://github.com/ranaitsan123) | [Rana Shafi](https://github.com/RanaShafi04)
