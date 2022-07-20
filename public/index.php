<?php

require_once('../app/components/router.php');

(new Router(include('../config/routes.php')))->run();
