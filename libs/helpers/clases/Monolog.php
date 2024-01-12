<?php
    use Monolog\Level;
    use Monolog\Logger;
    use Monolog\Handler\StreamHandler;
    use Monolog\Handler\FirePHPHandler;

    $logger = new Logger('main_logger');
    $logger->pushHandler(new StreamHandler(__DIR__.'/../../logs/log_general.txt', Level::Debug));
    $logger->pushHandler(new FirePHPHandler());
?>