<?php
    require_once __DIR__ . '/../db/dbh.php';
    require_once __DIR__ . '/../model/shopModel.php';
    $gameArray = getGames($dbh, "MostPopular");
    require_once __DIR__ . '/../view/shopView.php';
