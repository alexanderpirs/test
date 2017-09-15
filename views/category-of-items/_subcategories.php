 <?php
                        if ($SubCategory != null && sizeof($SubCategory) > 0) {
                            foreach ($SubCategory as $SubCat) {
                                ?>
                                <?php
                                $this->registerJs(<<<JS
 
    $('#SearchBuPP$SubCat->SUB_CATEGORY_ID').click(function(){
 
    $('#productsView').load('itembyproduct?SubCategoryID=$SubCat->SUB_CATEGORY_ID&Reg=C');
    }); 
        
        
JS
                                );
                                ?>

                                <div class="list-with-cats">
                                    <a href="#/" id="<?= 'SearchBuPP' . $SubCat->SUB_CATEGORY_ID ?>"><?= $SubCat->SUB_CATEGORY_NAME ?></a> 
                                    <img src="<?=Yii::getAlias('@web').'/img/catalogue/ctg-arr-right.svg'?>">
                                </div>
                                <?php
                            }
                        }
                        ?>