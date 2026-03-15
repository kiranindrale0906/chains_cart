name="<?= $data['name'] ?>"
class="<?= $data['class'] ?>"
value="<?= $data['value'] ?>"  
id="<?= @$data['id'] ?>"  
onchange="<?= $data['onchange'] ?>"

placeholder="<?= $data['placeholder'] ?>"
<?= $data['autofocus'] ?>
<?= $data['readonly'] ?>
<?= $data['disabled'] ?>
<?php if($data['readonlyinput'] == 1){echo 'readonly';}?>
