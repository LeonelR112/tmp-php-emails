<?php
    //Autocargador de clases, hace require de la clase que se instancie y busca en los directorios que se le seteen.
    $loader = new Nette\Loaders\RobotLoader;
    //directorias para autocargas
    $loader->addDirectory(__DIR__ . '/../app/');
    $loader->addDirectory(__DIR__ . '/../libs');

    $loader->setTempDirectory(__DIR__ . '/../cache/loader');
    $loader->register();
?>