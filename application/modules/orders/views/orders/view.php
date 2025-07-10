<p><b><?php echo "Chain Name : ".ucfirst($record['chain_name']); ?></b></p>
  <div class="row">
    <?php load_field('hidden', array('field' => 'chain_name', 'value' => $record['chain_name']));
    load_field('dropdown', array('field' => 'lot_purity',
                                'label' => 'Purity',
                                'disabled' => 'disabled',
                                'option' => $melting_lots_lot_purity));
    if(!empty($orders)){
      foreach ($orders as $key => $value) {
        if((!empty($value)) && ($key == 'category_1_label')) {
          load_field('text', array('field' => 'category_1_label',
                                   'readonly' => 'readonly',
                                   'label' => ucfirst($selected_labels['category_1_label']),
                                   'value' => $value));
        }elseif((!empty($value)) && ($key == 'category_2_label')) {
          load_field('text', array('field' => 'category_2_label',
                                   'readonly' => 'readonly',
                                   'label' => ucfirst($selected_labels['category_2_label']),
                                   'value' => $value));
        }elseif((!empty($value)) && ($key == 'category_3_label')) {
          load_field('text', array('field' => 'category_3_label',
                                   'readonly' => 'readonly',
                                   'label' => ucfirst($selected_labels['category_3_label']),
                                   'value' => $value));
        }elseif((!empty($value)) && ($key == 'category_4_label')) {
          load_field('text', array('field' => 'category_4_label',
                                   'readonly' => 'readonly',
                                   'label' => ucfirst($selected_labels['category_4_label']),
                                   'value' => $value));
        }elseif((!empty($value)) && ($key == 'category_5_label')) {
          load_field('text', array('field' => 'category_5_label',
                                   'readonly' => 'readonly',
                                   'label' => ucfirst($selected_labels['category_5_label']),
                                   'value' => $value));
        }
      }
    }
    ?>        
  </div>
  <?php $this->load->view('orders/order_details/subview') ?>
</form>