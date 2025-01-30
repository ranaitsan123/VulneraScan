# [VulneraScan - Outil d'Analyse des Vulnérabilités pour Applications Web]( )

![version](https://img.shields.io/badge/version-2.1.0-blue.svg)

![Image Preview](https://github.com/user-attachments/assets/41a9272f-e0bb-4b91-9e7d-b52c60dac72d)

VulneraScan est un outil automatisé permettant d’identifier et d’évaluer les vulnérabilités des applications web. Il intègre **OWASP ZAP** pour scanner les applications à la recherche de failles de sécurité courantes telles que **les injections SQL**, **les failles XSS** et **CSRF**. L'objectif est d'offrir une solution simple, efficace et accessible aux développeurs et entreprises pour sécuriser leurs applications.

This tutorial will guide you through the process of installing and running MedicaReport on your local machine.

## Table of Contents

- [Demo](#demo)
- [Prerequisites](#Prerequisites)
- [Quick Start](#quick-start)
- [Running the Application](#Running-the-Application)
- [File Structure](#file-structure)
- [Fonctionnalités](#Fonctionnalités)
- [Browser Support](#browser-support)
- [Customization](#Customization)
- [Contributing](#Contributing)
- [Resources](#resources)
- [Help Us Fix Bugs!](#Help-Us-Fix-Bugs!)
- [Technical Support or Questions](#technical-support-or-questions)
- [Useful Links](#Resources)
- [Licensing](#licensing)

## Demo

| Dashboard page                                                                                                                                                                                | Login page                                                                                                                                                                                 | Signup page                                                                                                                                                                                |
| --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| ![Dashboard page](https://github.com/user-attachments/assets/eb19ad43-7c93-4896-8a70-ba2997198a17) | ![Login page](https://github.com/user-attachments/assets/87f8b22a-1ba3-43b8-bafc-3cef54b0bbcb) | ![Signup page](https://github.com/user-attachments/assets/759ca996-aa60-49c3-a35d-62ca895ae3ee) |

| Reports page                                                                                                                                                                         | About page                                                                                                                                                                                | Home page                                                                                                                                                                                |
| -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| ![Reports page](https://github.com/user-attachments/assets/e1b710b4-ba85-4893-8e58-6bbb794a3e6b) | [![About page](https://github.com/user-attachments/assets/37ac89ec-d474-46f6-9cfe-6dab80e4450f)](https://github.com/user-attachments/assets/3a8ff9c0-170a-45c8-8bc1-c4786564dc22) | [![Home page](https://github.com/user-attachments/assets/f132341a-bd92-4c1d-ae93-27ea977d823f)](https://medica-report.framer.website/)|

## Prerequisites

Before you start, ensure that you have the following installed on your machine:

- Python 3.7+ (For running the app backend)
- pip (Python package installer)
- Git (To clone the repository)
- A Groq API key (For processing medical data and generating reports)
- A web browser (For accessing the web interface)

You will also need a local environment setup (virtual environment recommended) for running the Python-based web application.

## Download and Installation

**Step 1: Clone the Repository**

Start by cloning the MedicaReport repository to your local machine:

```bash
git clone https://github.com/MarwaneMLE/generate-medical-report.git
cd generate-medical-report
```

**Step 2: Create a Virtual Environment**

To keep your dependencies isolated, it's recommended to create a virtual environment.

- For Windows:

```bash
python -m venv venv
.\venv\Scripts\activate
```

- For macOS/Linux:

```bash
python3 -m venv venv
source venv/bin/activate
```

**Step 3: Install Dependencies**

Install the necessary Python dependencies using ```pip```:

```bash
pip install -r requirements.txt
```

**Step 4: Set Up Environment Variables**

Create a ```.env``` file in the root of the project directory and add the following environment variables:

```bash
GROQ_API_KEY=your_groq_api_key
```

Replace ```your_groq_api_key``` with the API key you get from [Groq API](https://console.groq.com/keys) and ```your_secret_key_for_flask_app``` with a random string used to secure your Flask application.

**Step 5: Set Up the Database (JSON Database)**

The project uses a JSON file as the database for authentication. Make sure to place the user data in users.json inside the project directory.

Example ```users.json``` structure:

```json
[
  {
    "username": "doctor1",
    "password": "password123",
    "email": "email@email.com"
  }
]
```
## Running the Application

**Step 1: Start the Flask Server**

Run the following command to start the Flask server:

```bash
python app.py
```

By default, the app will be accessible at http://localhost:5000.

**Step 2: Access the Web Interface**

Open a web browser and visit http://localhost:5000. You will be presented with a login page.

## File Structure

Within the download you'll find the following directories and files:

```
MedicaReport
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
  ├── templates
  │   ├── dashboard.html
  │   ├── login.html
  │   ├── signup.html
  │   ├── reports.html
  │   └── about.html
  ├── api.py
  ├── report_generator.py
  ├── auth.py
  ├── pdf_generator.py
  ├── human_vital_signs_dataset_2024.csv(data.zip extract)
  └── app.py
```

## Fonctionnalités

**1. Scan des vulnérabilités 🔍**

Détection des failles courantes sur les applications web.

**2. Rapports détaillés 📊**

Génération de rapports en **JSON/PDF**, avec des graphes illustrant les niveaux de risque.

**3. Historique des scans 📜**

Consultation et téléchargement des rapports précédents.

**4. Interface Web intuitive 🌐**

Exécution des scans directement depuis un navigateur.



## Customization

VulneraScan is highly customizable, and you can enhance its functionality with the following features:

<!--- **JWT Authentication:** Implement JSON Web Tokens (JWT) for stateless authentication, improving security and scalability by eliminating the need for server-side session storage.

- **Enhanced PDF Generation with ML:** Use machine learning algorithms like regression to predict patient health trends and generate more insightful, data-driven reports.

- **Report History Page:** Add a History Page to store and quickly access previously generated reports, reducing processing time and resource consumption.

- **DBMS for Authentication:** Switch to a Database Management System (DBMS) like Oracle or PostgreSQL for more secure and scalable user authentication, or integrate OAuth for third-party logins.

- **Cloud Deployment:** Deploy the app on cloud platforms like AWS, Google Cloud, or Heroku for global access, scalability, and better resource management.

These customizations can improve performance, security, and user experience. -->

## Browser Support

At present, we officially aim to support the last two versions of the following browsers:

<img src="https://s3.amazonaws.com/creativetim_bucket/github/browser/chrome.png" width="64" height="64"> <img src="https://s3.amazonaws.com/creativetim_bucket/github/browser/firefox.png" width="64" height="64"> <img src="https://s3.amazonaws.com/creativetim_bucket/github/browser/edge.png" width="64" height="64"> <img src="https://s3.amazonaws.com/creativetim_bucket/github/browser/safari.png" width="64" height="64"> <img src="https://s3.amazonaws.com/creativetim_bucket/github/browser/opera.png" width="64" height="64">

## Technologies Used

VulneraScan is built using a variety of programming languages and libraries. Here's a quick overview of the main technologies used in the project, along with their official documentation:


## Contributing

We welcome contributions to improve MedicaReport. If you'd like to contribute, please follow these steps:

1. Fork the repository.
2. Create a new branch.
3. Make your changes.
4. Commit your changes.
5. pen a pull request.

Please ensure that your code follows the existing style and includes tests if applicable.

## Resources

- Demo Video: < >
- Documentation Boostrap Tempaltes: <https://www.creative-tim.com/learning-lab/bootstrap/overview/argon-dashboard>
- VulneraScan Home Page: <>
- Support: <https://www.linkedin.com/in/aicha-lahnite/>
- Issues: [Github Issues Page](https://github.com/ranaitsan123/VulneraScan/issues)

## Help Us Fix Bugs!

We’re actively working on improving MedicaReport, and we need your help! If you encounter any bugs or issues, we encourage you to contribute by fixing them. Here’s how you can get involved:

1. **Report the Bug:** If you find a bug, please report it in the [Issues](https://github.com/ranaitsan123/VulneraScan/issues) section with clear steps to reproduce the problem.

2. **Fix the Bug:** If you're familiar with the code, feel free to fix the issue. Fork the repository, create a branch, and submit a pull request with your changes.

3. **Contribute Improvements:** Even if you don't find a bug, any improvements, optimizations, or enhancements are always welcome!

Your contributions help make MedicaReport better for everyone — thank you for being part of the journey!

## Licensing

- Copyright &copy; 2025 [Aicha Lahnite](https://www.linkedin.com/in/aicha-lahnite/) & 

## Social Media

Linkedin: [Aicha Lahnite](https://www.linkedin.com/in/aicha-lahnite/) | 

Email: halaicha300@gmail.com | 

Discord: aicha_a1000 <halaicha300@gmail.com>

Github: [Aicha Lahnite](https://github.com/ranaitsan123) | 
