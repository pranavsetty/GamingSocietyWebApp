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


                <div class="align-right"><?php echo countGames(); ?></div>

                <div class="clear-float"></div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="no-border" scope="col">Game Title</th>
                        <th class="no-border" scope="col">Type</th>
                        <th class="no-border" scope="col">Platform</th>
                        <th class="no-border" scope="col">Age restriction</th>
                        <th class="no-border" scope="col">Released</th>
                        <th class="no-border" scope="col">Value</th>
                        <th class="no-border" scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $gameSet = find_game_data();
                    while ($game = mysqli_fetch_assoc($gameSet)) { ?>
                            <tr>
                                <td><?php echo($game['name']); ?></td>
                                <td><?php echo($game['type']); ?></td>
                                <td><?php echo($game['platform']); ?></td>
                                <td><?php echo($game['ageLimit']); ?></td>
                                <td><?php echo($game['releaseYear']); ?></td>
                                <td><?php echo($game['cost'] . "£"); ?></td>
                                <td><a href="<?php echo ('pages/editGame.php?id=' . ($game['gameID'])); ?>"><i class="fas fa-edit"></i></a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
    mysqli_free_result($gameSet);
    ?>
</div>
