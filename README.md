# OwnWork - Minimal framework for an MVC Project
---

![Commits](https://flat.badgen.net/github/commits/Sanatani-Dhruv/ownwork)
![Last Commit](https://flat.badgen.net/github/last-commit/Sanatani-Dhruv/ownwork)

- Don't go into major dependencies rabbit hole.
- Build your MVC app with PHP.
- Simple Routing.
- Easier View Creation.
- Build a Large Web App with minimal but useful base.

### Dependencies
1. php (version: 8.2 or greater).
2. composer (version: 2.9 or greater).

### Structure

```bash
ownwork
   ├── app
   │   ├── Controller
   │   │   └── UserController.php
   │   ├── Helper
   │   │   ├── Environment.php
   │   │   └── Views
   │   │       ├── general-notfound-error.php
   │   │       ├── styles
   │   │       │   └── index.css
   │   │       └── view-notfound-error.php
   │   ├── Router
   │   │   └── Route.php
   │   └── Viewer
   │       └── View.php
   ├── bundle
   │   ├── Bundler.php
   │   ├── HelperFunction.php
   │   └── Routes.php
   ├── composer.json
   ├── composer.lock
   ├── public
   │   ├── index.php
   │   └── styles
   │       └── index.css
   ├── README.md
   ├── resources
   │   └── views
   │       ├── main.php
   │       └── welcome.php
   └── vendor
```


### Installation

1. Clone this repo.

```bash
git clone https://github.com/Sanatani-Dhruv/ownwork.git
```

2. cd to `ownwork` directory and Run `composer setup` command.
```bash
cd ownwork/
composer run setup
```

3. Edit .env file.
```bash
APP_NAME=Ownwork

DB_NAME=mysql
DB_HOST='127.0.0.1'
DB_USER=root
DB_PASS=
```

> That's it, your ownwork application is ready to run it's Hello World Program.

### Usage

1. Go to `/public` folder.

```bash
cd public/
```

2. Run PHP's development server in that directory.

```bash
php -S localhost:8000
```

3. Now open your preferred Browser and go to URL `http://localhost:8000/`.
