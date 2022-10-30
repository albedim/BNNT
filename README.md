## Flask Initializer
This is a simple cmd file that you can use to initialize
your flask project without creating folders and files
manually

### Let's start
As you can see, you have a folder `resources`, inside of it
you can see three files, 
`config.py` -> it contains a json file with the database params
`rest-service.json` -> it contains a json file with the app informations
`config.bat` -> it's the script that will create the project for you

### Let's create the project
* Put the resources folder in your project directory
* Now, go in the resources folder and open `config.bat`
* ```
   /* WRITE THIS COMMAND: */ create-project
  ```
* Now, write the name of the project
It will create the project in your main directory, like this
    + ProjectDirectory
      + resources
      + project-name
        + configuration
          + `Config.py`
        + controller
        + model
          + entity
          + repository
        + service
      + `app.py`
      + `start.bat`
    
### Let's create some files
Now, i will show you some commands to create files 
 * `create-repo` Creates a repository
 * `create-entity` Creates a entity
 * `create-controller` Creates a controller
 * `create-service` Creates a service
 
### Now, you are ready to use this
