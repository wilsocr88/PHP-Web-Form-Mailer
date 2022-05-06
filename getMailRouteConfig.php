<?php

    /**
     * Get mail route array based on value of 'route' field
     */
    function getMailRouteConfig($configString) {
        return $GLOBALS['config']['mailRoutes'][ $_POST['route'] ][$configString];
    }

?>