
<?php
 require_once('../../private/initialize.php');
?>
<div class="justify-content-between flex-wrap flex-md-nowrap align-items-center text-center mb-5 mt-5">
    <h1 class="align-left">Rentals</h1>
    <a class="btn btn-add align-right" href="pages/addRental.php" title="Record rental"><i class="fas fa-plus"></i></a>
    <div class="clear-float"></div>
</div>
<div class="row mt-3">
    <div class="col">
        <div class="card card-purple card-big">
            <div class="card-title title-purple">
                <div class="align-left label">Current rentals: </div>
                <div class="align-right">4</div>
                <div class="clear-float"></div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="no-border" scope="col">Game Title</th>
                        <th class="no-border" scope="col">Member Name</th>
                        <th class="no-border" scope="col">Until</th>
                        <th class="no-border" scope="col">Extensions</th>
                        <th class="no-border" scope="col"></th>
                        <th class="no-border" scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $rentals =  findRentals();
                          while($rental = mysqli_fetch_assoc($rentals)) {
                          if(isCurrentRental($rental)){ ?>
                    <tr>
                        <td><?php echo $rental['name']; ?></td>
                        <td><?php echo $rental['firstname']; ?></td>
                        <td><?php echo calculateEndDate($rental['startDate'], $rental['period']); ?></td>
                        <td><?php echo $rental['extension']; ?></td>
                        <td><a href="#"><i class="fas fa-info-circle"></i></a></td>
                        <td><a href="#"><i class="fas fa-plus-circle"></i> extend</a></td>
                    </tr>
                    <?php }} ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>
</div>
<div class="row mt-5">
    <div class="col">
        <div class="card card-blue card-big">
            <div class="card-title title-blue">
                <div class="align-left label">Past rentals: </div>
                <div class="align-right">6</div>
                <div class="clear-float"></div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="no-border" scope="col">Game Title</th>
                        <th class="no-border" scope="col">Member Name</th>
                        <th class="no-border" scope="col">Until</th>
                        <th class="no-border" scope="col">Extensions</th>
                        <th class="no-border" scope="col"></th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php $rentals =  findRentals();
                          while($rental = mysqli_fetch_assoc($rentals)) {
                          if(!isCurrentRental($rental)){ ?>
                    <tr>
                        <td><?php echo $rental['name']; ?></td>
                        <td><?php echo $rental['firstname']; ?></td>
                        <td><?php echo calculateEndDate($rental['startDate'], $rental['period']); ?></td>
                        <td><?php echo $rental['extension']; ?></td>
                        <td><a href="#"><i class="fas fa-info-circle"></i></a></td>
                        <td><a href="#"><i class="fas fa-plus-circle"></i> extend</a></td>
                    </tr>
                    <?php }} ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>
</div>
