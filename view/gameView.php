<?php include_once 'headerView.php'; ?>
    <div class="wrapper">
        <section class="gameSection">
            <h1><?php echo($game['gamesName']) ?></h1>
            <div class="gameItemPicture">
                <div class="gameItemList">
                    <p class="gameItem"><span class="pink">Delease date : </span><?php echo($game['gamesDate']) ?></p>
                    <p class="gameItem"><span class="pink">Download : </span><?php echo($game['gamesDownloads']) ?></p>
                    <p class="gameItem"><span class="pink">Creator : </span><?php echo($game['gamesCreator']) ?></p>
                    
                    <div class="button">
                        <a href="<?php echo("./gameDownload.php?id=" . $_GET['id']); ?>" target="_blank">Download</a>
                    </div>
                </div>
                <div class="gamePicture" style="background-image: url(<?php echo ("/assets/img/upload/game/game" . $game['gamesId'] . ".png"); ?>);"></div>
            </div>
            <p calss="gameDescription"><span class="pink">Description : </span><?php echo($game['gamesDescription']) ?></p>
        </section>
    </div>
<?php include_once 'footerView.php'; ?>
