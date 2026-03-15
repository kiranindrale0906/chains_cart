<?php if (isset($data['data'])) $data = $data['data']; ?>
name="<?= $data['name'] ?>"
class="<?= $data['class'] ?>"
value="<?= $data['value'] ?>"  
id="<?= @$data['id'] ?>"  
onchange="<?= $data['onchange'] ?>"
onkeyup="<?= @$data['onkeyup'] ?>"
placeholder="<?= $data['placeholder'] ?>"
<?= $data['autocomplete'] ?>
<?= $data['autofocus'] ?>
<?= $data['readonly'] ?>
<?= $data['disabled'] ?>
<?php if($data['readonlyinput'] == 1){echo 'readonly';}?>
