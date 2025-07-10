<a href="<?= @$data['url'];?>" class="white <?=isset($data['aclass'])?$data['aclass']:''?>" modal-size='<?= isset($data['modal-size'])?$data['modal-size']:''?>' data-toggle="<?=isset($data['toggle'])?$data['toggle']:''?>">
  <div class="d-flex no-block">
    <div class="mr-3 align-self-center"><img src="<?= @$data['card_icon'];?>" alt="Icon"></div>
      <div class="align-self-center">
        <h6 class="bold"><?= @$data['card_title'];?></h6>
        <h2 class=""><?= @$data['card_count'];?></h2> 
      </div>
  </div>
  <p class="text-center m-0 bold"><span class="label"></span><?= @$data['card_decription_label'];?> <span class="value"><?= @$data['card_decription_value'];?></span></p>  
  <p class="text-center m-0 bold"><span class="label"></span><?= @$data['card_decription_label_2'];?> <span class="value"><?= @$data['card_decription_value_2'];?></span></p>  
</a>

