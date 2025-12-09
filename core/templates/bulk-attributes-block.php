<div id="bulk_attributes_block" class="panel woocommerce_options_panel">
    <script>
    ( function( $ ) {
        $("document").ready(function(){
            $("select.dropdown").dropdown();
            $('#attribute-submit')
            .click(function(e) {
                e.preventDefault();
                var data = {
                    'post_id': <?php echo $product->get_id()?>,
                    'product_type': '<?php echo $product->get_type()?>',
                    'action': 'woocommerce_save_attributes',
                    'security': '<?php echo wp_create_nonce('save-attributes');?>'
                };
                data['data'] = new Object();
                data['data']['attribute_names'] = new Object();
                data['data']['attribute_values'] = new Object();
                data['data']['attribute_visibility'] = new Object();
                var values = null;
                var co = 0;
                <?php foreach ($attributes as $a) :?>
                    select = $('#attr-dropdown-<?php echo $a->attribute_id?>');
                    var values = select.parent().dropdown('get value');
                    if(values.length != 0){
                        data['data']['attribute_names'][co] = "<?php echo "pa_".$a->attribute_name ?>";
                        data['data']['attribute_values'][co] = values;
                        data['data']['attribute_visibility'][co] = 1
                        co += 1;
                    }
                <?php endforeach ?>
                var url = "<?php echo admin_url('admin-ajax.php') ?>";
                data['data'] = $.param(data['data']);
                $.ajax({
                    url: url,
                    type: 'post',
                    data: $.param(data),
                    beforeSend: function(){
                        $('#attribute-submit').addClass('loading');
                    },
                    complete:function(data){
    $('#attribute-submit').removeClass('loading');
    location.reload();
}

                });
            });
            <?php foreach ($attributes as $a) :?>
            $("#attr-dropdown-<?php echo $a->attribute_id; ?>").dropdown('set selected', [
                <?php
                $selected_items = get_the_terms($product->get_id(), "pa_".$a->attribute_name);
                if (!empty($selected_items)) {
                    if (!is_wp_error($selected_items)) {
                        $flag = false;
                        foreach ($selected_items as $term) {
                            if ($flag) {
                                echo ", ";
                            }
                            echo "'".$term->name."'";
                            $flag = true;
                        }
                    }
                }
                ?>
            ]);
            <?php endforeach ?>
        });
    }( jQuery3_1_1 ) );
    </script>

    <div class="ui form" style="margin: 1em;">
        <?php foreach ($attributes as $a) :?>
            <div class="field">
                <label><?php echo $a->attribute_label ?></label>
                <select class="ui search dropdown attribute" multiple="" id="<?php echo 'attr-dropdown-'.$a->attribute_id ?>">
                    <?php
                        $choices = get_terms([
                            'taxonomy' => "pa_".$a->attribute_name,
                            'hide_empty' => false
                        ]);
                    ?>
                    <?php foreach ($choices as $choice) :?>
                        <option value="<?php echo $choice->term_id ?>" > <?php echo $choice->name ?> </option>
                    <?php endforeach ?>
                </select>
            </div>
        <?php endforeach ?>
        <button id="attribute-submit" class="ui button" type="button">ذخیره ویژگی‌ها</button>
    </div>
</div>
TESTE AND OK
