<?php

namespace docker {
    function adminer_object() {
        require_once('plugins/plugin.php');

        if (!isset($_GET['username'])) {
            $_GET['username'] = 'user';
        }

        if (!isset($_GET['db'])) {
            $_GET['db'] = 'app';
        }

        class Adminer extends \AdminerPlugin {

            function credentials()
            {
                return ['db','user','pass'];
            }

            function login($login, $password)
            {
                return true;
            }

            function loginForm()
            {
                parent::loginForm();
                echo "<script>document.querySelector('.layout').parentNode.submit()</script>";
            }

            function csp()
            {
                return [];
            }

        }

        $plugins = [];
        foreach (glob('plugins-enabled/*.php') as $plugin) {
            $plugins[] = require($plugin);
        }

        return new Adminer($plugins);
    }
}

namespace {
    if (basename($_SERVER['REQUEST_URI']) === 'adminer.css' && is_readable('adminer.css')) {
        header('Content-Type: text/css');
        readfile('adminer.css');
        exit;
    }

    function adminer_object() {
        return \docker\adminer_object();
    }

    require('adminer.php');
}