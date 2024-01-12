<?php
    date_default_timezone_set($_ENV['REGION_HORARIA']);
    const VIEWS = __DIR__ . '/../app/views/';
    const CACHE_VIEWS = __DIR__ . "/../cache/bladeone";
    const CACHE_SESIONES = __DIR__ . "/../cache/sesiones";
    const TITLE_PAGE = "My App";
    const MAIN_URL = "http://localhost/test-emailTraker/";
    const API_URL_EMAILS = 'https://4383-190-49-19-252.ngrok-free.app/test-emailTraker/api/check';