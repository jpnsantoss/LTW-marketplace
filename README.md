# LTW Project - Marketplace

Project of the curricular unit of Web Languages and Technologies (LTW) of 2nd semester, 2nd year of L.EIC@FEUP.
This Project was developed by *João Santos* (<up202205794@up.pt>), *Marta Silva* (<up202208258@up.pt>) and *Sara Cortez* (<up202205636@up.pt>)

## Folder structure

```text
/ltw-project-2024-ltw05g05
    utils/              # utility functions, constants used frequently
    data/               # SQLITE database
    public/             # Accessible files. What final users see
        css/            # Compiled css file
        js/             # Compiled javascript file
        index.php       # Starting point for the entire app
    src/                # Application source code
        app/            # Router class, routes.php
        controllers/    # Controller classes
        models/         # Model classes
        views/          # Views
    vendor/             # Composer files, autoloader !ignored
    .gitignore          # Files/folders to be ignored by version control
    composer.json       # Composer dependency file
```
