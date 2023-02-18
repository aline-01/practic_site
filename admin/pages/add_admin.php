<?php include("../layouts/header.php"); ?>
<?php include("../../includes/db_config/db_connection.php"); ?>
<?php include("../../includes/functions.php"); ?>
<?php 
$functions->access_to_admin();

$admins = $functions->get_all_users();
?>
<div class="row" style="padding:30px;">
<table class="table table-dark">
  <thead>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Username</th>
          <th scope="col">Email</th>
          <th scope="col">Status</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
      <?php 
      foreach($admins as $adm) {
        if ($adm["id"] == 1) { continue; }
        echo "<tr>";
        echo "<th scope='row'>1</th>";
        echo "<td>{$adm['username']}</td>";
        echo "<td>{$adm['email']}</td>";
        echo "<td>Admin</td>";
        echo "<td>";
        if ($adm["add_access"] == 1) {
          echo "<a href='oprations/admins_manage.php?id={$adm['id']}&remove' class='btn btn-danger'>Delete from admin</a>";
        }else if ($adm["add_access"] == 0) {
          echo "<a href='oprations/admins_manage.php?id={$adm['id']}&add' class='btn btn-warning'>Add to admins</a>";
        } 
          echo "</td>";
        echo "</tr>";
      }
      ?> 
        
      </table></tbody>
</table>
</div>


<?php include("../layouts/footer.php"); ?>