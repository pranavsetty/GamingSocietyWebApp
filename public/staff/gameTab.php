<?php require_once('../../private/initialize.php');

$subjectSets = find_game_data();
$numberOfGames = getGameRows();
?>



<!DOCTYPE html>
<div class="justify-content-between flex-wrap flex-md-nowrap align-items-center text-center mb-5 mt-5">
    <h1 class="align-left">Games</h1>
    <a class="btn btn-add align-right" href="pages/addGame.php" title="Add Game"><i class="fas fa-plus"></i></a>
    <div class="clear-float"></div>
</div>

<div class="row mt-3">
    <div class="col">
        <div class="card card-purple card-big">
            <div class="card-title title-purple">
                <div class="align-left label">Current Games: </div>
                <div class="align-right"><?php echo $numberOfGames ?> </div>
                <div class="clear-float"></div>
            </div>
            <div class="card-body">
                <div id="content">
                    <table class="list">
                        <thead>
                        <tr>
                            <th>GameID</th>
                            <th>Cost</th>
                            <th>Type</th>
                            <th>AgeLimit</th>
                            <th>Name</th>
                            <th>CurrentlyAvailable</th>
                            <th>ReleaseYear</th>
                            <th>ImageLink</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <?php
                        $gameSet = find_game_data();
                        ?>
                        <?php
                        while ($subject = mysqli_fetch_assoc($gameSet)) { ?>
                            <tr>
                                <td><?php echo($subject['gameID']); ?></td>
                                <td><?php echo($subject['cost']); ?></td>
                                <td><?php echo($subject['type']); ?></td>
                                <td><?php echo($subject['ageLimit']); ?></td>
                                <td><?php echo($subject['name']); ?></td>
                                <td><?php echo($subject['isCurrentlyAvailable']); ?></td>
                                <td><?php echo($subject['releaseYear']); ?></td>
                                <td><?php echo($subject['imageLink']); ?></td>
                                <td><a class="action" href="<?php echo ('/pages/edit.php?id=' . ($subject['gameID'])); ?>">Edit</a></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
    <?php
    mysqli_free_result($gameSet);
    ?>
</div>

</html>