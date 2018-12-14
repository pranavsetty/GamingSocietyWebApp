<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
if ($_POST['newValue'] === "admin") {
    $result = makeAdmin($_POST['staffID'], getAdmin());
    if ($result == true){
      redirect_to(url_for('/staff/dashboard.php?tab=overview'));
    }
}
else if ($_POST['newValue'] === "delete") {
  $result = deleteStaff($_POST['staffID']);
  if ($result === true) {
      echo '<script language = "javascript">';
      echo 'alert ("You have successfully removed this staff ");';
      echo '</script>';
    } else{
      echo '<script language = "javascript">';
      echo 'alert ("Error: The staff member could not be removed.");';
      echo '</script>';
    }

}
else if (isset($_POST['description'], $_POST['newValue']) && $_POST['newValue'] != "None") {
    $result = editRule($_POST['description'], $_POST['newValue']);
    if ($result === true) {
        //$new_id = mysqli_insert_id($db); Not sure what this is for

        echo '<script language = "javascript">';
        echo 'alert ("You have successfully edited a rule");';
        echo '</script>';
      } else{
        echo '<script language = "javascript">';
        echo 'alert ("Error: The rule could not be edited.");';
        echo '</script>';
      }
    }
}
?>

<div class="justify-content-between flex-wrap flex-md-nowrap align-items-center text-center mb-5 mt-5">
    <h1 class="align-left">Staff</h1>
    <a class="btn btn-add align-right" href="pages/addStaff.php" title="Add Staff"><i class="fas fa-plus"></i></a>
    <div class="clear-float"></div>
</div>
<div class="row mt-3">
    <div class="col">
        <div class="card card-blue card-big">
            <div class="card-title title-blue">
                <div class="align-left label">Staff</div>
                <div class="align-right"><?php echo countStaff()-1;?></div>
                <div class="clear-float"></div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="no-border" scope="col">Name</th>
                        <th class="no-border" scope="col">Date of Birth</th>
                        <th class="no-border" scope="col">Phone Number</th>
                        <th class="no-border" scope="col">Email</th>
                        <th class="no-border" scope="col">Home address</th>
                        <th class="no-border" scope="col"></th>
                        <th class="no-border" scope="col"></th>
                        <th class="no-border" scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $staff =  get_staff_data();
                    while($staffMember = mysqli_fetch_assoc($staff)) {
                        if ($staffMember['staffID'] !== getAdmin()){?>
                            <tr>
                                <td><?php echo $staffMember['firstname'] . " " . $staffMember['surname']; ?></td>
                                <td><?php echo $staffMember['DoB']; ?></td>
                                <td><?php echo $staffMember['phoneNo']; ?></td>
                                <td><?php echo $staffMember['email']; ?></td>
                                <td><?php echo $staffMember['homeAddress']; ?></td>
                                <td><?php if (isAdmin($staffMember['email'])) echo 'admin'; else echo 'staff' ?></td>
                                <form action="" method="post">
                                    <td>
                                        <input type = "hidden" name = "newValue" value = "delete">
                                        <input type = "hidden" name = "staffID" value = <?php echo $staffMember['staffID']; ?>>
                                        <button type="submit" name = "delete" class = "btn btn-outline-danger"> Delete staff </button>
                                    </td>
                                </form>
                                <form action="" method="post">
                                    <td>
                                        <input type = "hidden" name = "newValue" value = "admin">
                                        <input type = "hidden" name = "staffID" value = <?php echo $staffMember['staffID']; ?>>
                                        <button type="submit" name = "makeAdmin" class = "btn btn-outline-primary"> Make admin </button>
                                    </td>
                                </form>
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
                <div class="align-left label">Rules</div>
                <div class="align-right"><?php echo countRules();?></div>
                <div class="clear-float"></div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="no-border" scope="col">Description</th>
                        <th class="no-border" scope="col">Value</th>
                        <th class="no-border" scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $rules = get_rules_data();
                    while($rule = mysqli_fetch_assoc($rules)) { ?>
                        <tr>
                            <td><?php echo $rule['description']; ?></td>
                            <td><?php echo $rule['value']; ?></td>
                            <form action="" method="post">
                                <td>
                                    <input type = "hidden" name = "newValue" value = "None">
                                    <input type = "hidden" name = "description" value = <?php echo $rule['description']; ?>>
                                    <button type="submit" name = "submit" class = "btn btn-outline-secondary"> edit </button>
                                </td>
                            </form>
                            <?php } ?>
                        </tr>

                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                         if (isset($_POST['submit'], $_POST['newValue'])) {
                           if ($_POST['newValue'] == "None") { ?>
                           <form action="" method="post">
                             <td>
                           <input type = "hidden" name = "description" value = <?php echo $_POST['description']; ?>>
                           <input type="text" name="newValue" class="form-control mb-2" placeholder="New Value" required autofocus >
                           <button type="submit" class="btn btn-outline-primary"> Update </button>

                           </td>
                         </form>
                       <?php }}}?>



                    </tbody>
                </table>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>
</div>
