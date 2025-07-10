<?php $controller = $this->router->fetch_class();
?>

<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><?= $this->data['add_title'] ?></h4>
      </div>
      <div class="modal-body" id='add-data-modal'>
          <?php $this->load->view($controller.'/form')?>
      </div>
    </div>
  </div>
</div>