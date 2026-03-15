<?php @$data = get_field_data($data, $this->router, $record); ?>
<?php $displayName = (isset($displayName) ? $displayName : 'SAVE');
?>
<?php if ($action != 'index'): ?>
  <hr>
<?php endif; ?>

<?php $is_ajax_request = (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) ? TRUE : FALSE; ?>
<?php $enter_method = (isset($record['id'])) ? '/update/'.$record['id'] : '/store'; ?>

<div class="boxrow">
  <?php if (!isset($show_inline_form)): ?>
    <a href="<?= $is_ajax_request ? "#" : base_url($controller); ?>"
       class="btn btn-sm btn-link float-left">
       Back
    </a>
  <?php endif; ?>
  <button type="submit" 
          class="btn btn-sm btn_green float-right <?= $is_ajax_request ? "ajax_post" : ""; ?>">
    Save
  </button>

</div>
