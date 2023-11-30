<?php include('header.php');

?>
<div class="container">
    <div class="panel-body">
        <table border="0" cellpadding="0" cellspacing="0" class="table tasks">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Nom</th>
                    <th>E-mail</th>
                    <th>Phone</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($personnes as $personne) : ?>
                    <tr>
                        <td><img src="../assets/images/<?php print htmlentities($personne['img_url'], ENT_QUOTES); ?>"></td>
                        <td><?php print htmlentities($personne['nom'], ENT_QUOTES); ?></td>
                        <td><?php print htmlentities($personne['email']); ?></td>
                        <td><?php print htmlentities($personne['phone']); ?></td>
                        <td>
                            <?php echo "<a href='index.php?op=edit&id=" . $personne['id'] . "'class='btn btn-warning btn-sm' role='button'>" ?>edit</a>
                            <a href="index.php?op=delete&id=<?php echo $personne['id']; ?>" class="btn btn-primary btn-sm" role="button">Delete</a>
                            <a href="index.php?op=view&id=<?php echo $personne['id'];?>" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            View
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<br>
<div class="container">
    <?php
    $pagLink = "<ul class='pagination'>";
    for ($i = 1; $i <= $total; $i++) {
        $pagLink .= "<li class='page-item'><a class='page-link' href='index.php?page=" . $i . "'>" . $i . "</a></li>";
    }
    echo $pagLink . "</ul>";
    ?>
</div>

<br>
<div class="container">
    <div class="panel border-top">
        <div class="panel-heading panel-content">
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<?php 
var_dump($phone);
//</body> </html>