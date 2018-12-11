<?php
$numOfMembers = getMembers();
$numOfBannedMembers = getBanMembers();
?>
<div class="justify-content-between flex-wrap flex-md-nowrap align-items-center text-center mb-5 mt-5">
    <h1 class="align-left">Members</h1>
    <a class="btn btn-add align-right" href="pages/addMember.php" title="Add member"><i class="fas fa-plus"></i></a>
    <div class="clear-float"></div>
</div>
<div class="row mt-3">
    <div class="col">
        <div class="card card-blue card-big">
            <div class="card-title title-blue">
                <div class="align-left label">Active members: </div>
                <div class="align-right"><?php echo $numOfMembers ?></div>
                <div class="clear-float"></div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="no-border" scope="col">Member Name</th>
                        <th class="no-border" scope="col">Date of Birth</th>
                        <th class="no-border" scope="col">Phone Number</th>
                        <th class="no-border" scope="col">Email</th>
                        <th class="no-border" scope="col">Home address</th>
                        <th class="no-border" scope="col">Violations</th>
<!--                        <th class="no-border" scope="col"></th>-->
                    </tr>
                    </thead>
                    <tbody>
                      <?php $members =  get_simple_member_data();
                            while($member = mysqli_fetch_assoc($members)) {
                            if(!isBanned($member['memberID'])){ ?>
                    <tr>
                        <td><?php echo $member['firstname']; ?></td>
                        <td><?php echo $member['DoB']; ?></td>
                        <td><?php echo $member['phoneNo']; ?></td>
                        <td><?php echo $member['email']; ?></td>
                        <td><?php echo $member['homeAddress']; ?></td>
                        <td><?php echo $member['violations']; ?></td>
<!--                        <td><a href="#"><i class="fas fa-info-circle"></i></a></td>-->
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
        <div class="card card-purple card-big">
            <div class="card-title title-purple">
                <div class="align-left label">Banned members: </div>
                <div class="align-right"><?php echo $numOfBannedMembers ?> </div>
                <div class="clear-float"></div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="no-border" scope="col">Member Name</th>
                        <th class="no-border" scope="col">Date of Birth</th>
                        <th class="no-border" scope="col">Phone Number</th>
                        <th class="no-border" scope="col">Email</th>
                        <th class="no-border" scope="col">Home address</th>
                        <th class="no-border" scope="col">Violations</th>
                        <th class="no-border" scope="col"></th>
                        <th class="no-border" scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php $members =  get_simple_member_data();
                            while($member = mysqli_fetch_assoc($members)) {
                            if(isBanned($member['memberID'])){ ?>
                    <tr>
                        <td><?php echo $member['firstname']; ?></td>
                        <td><?php echo $member['DoB']; ?></td>
                        <td><?php echo $member['phoneNo']; ?></td>
                        <td><?php echo $member['email']; ?></td>
                        <td><?php echo $member['homeAddress']; ?></td>
                        <td><?php echo $member['violations']; ?></td>
                        <td><a href="#"><i class="fas fa-info-circle"></i></a></td>
                    </tr>
                    <?php }} ?>
                    <!-- <tr>
                        <td>Adrian Pimento</td>
                        <td>22/02/1980</td>
                        <td>07951938363</td>
                        <td>pima@gmail.com</td>
                        <td>some address</td>
                        <td>10</td>
                        <td><a href="#"><i class="fas fa-info-circle"></i></a></td>
                        <td><a href="#">remove ban</i></a></td>
                    </tr>
                    <tr>
                        <td>Keith Pembroke</td>
                        <td>10/11/1979</td>
                        <td>07951938363</td>
                        <td>keith.pembroke@gmail.com</td>
                        <td>some address</td>
                        <td>2</td>
                        <td><a href="#"><i class="fas fa-info-circle"></i></a></td>
                        <td><a href="#">remove ban</i></a></td>
                    </tr> -->
                    </tbody>
                </table>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>
</div>
