<?php
    // Redirect page
    function redirect($page) {
        header('location: '. URLROOT. '/'. $page);
    }