# Assignment 03 - Points **180**

## Instructions

This assignment will introduce more advanced topics with Twig and also require some HTML5 features.

### 00 - HTML5 Validation in Twig

- Change directory to `./templates`.
- Create two new twig templates named `login.html.twig` and `profile.html.twig`.
- The username is an email.  Put HTML5 validation in `login.html.twig` for both the username and password.

### 01 - Login and Profile Actions

- Change directory to `./src/Actions/`.
- Create a new file named `LoginAction.php`.  Use the file `HomeAction.php` for help.
- Create a new file named `ProfileAction.php`.  User processing will occur in this file.

### 02 - Add Routes

- Change directory to `./src/`.
- Add `/login` and `/profile` routes to the `routes.php` file.

### 03 - Make Dependency Modifications

- Add the new actions to the dependency injection container.
