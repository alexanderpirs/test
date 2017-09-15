<?php

use yii\helpers\Url;
$ProductModel = null;
if (isset($dataProviderItems)) {
    $ProductModel = $dataProviderItems->getModels();
}
$FeatureProductModel = null;
if (isset($dataFeaturedProviderItems)) {
    $FeatureProductModel = $dataFeaturedProviderItems->getModels();
}
?>
                    <?php
//                        if ($SupplierModel != null) {
//                            echo 'sizeof($SupplierModel): ' . sizeof($SupplierModel);
//                            if (sizeof($SupplierModel) > 0) {
//                                foreach ($SupplierModel as $Supplier) {

                    if ($FeatureProductModel != null) {

                        if (sizeof($FeatureProductModel) > 0) {
                            $FearuredProductCounter = 0;
                            foreach ($FeatureProductModel as $FeatureProduct) {


//            echo ';$Reg : ' . $Reg;
                                if ($FeatureProduct->items != null && sizeof($FeatureProduct->items) > 0 && $FeatureProduct->sUBCATEGORY->cATEGORYOFITEM->CATEGORY_FLAG == 'C') {

                                    if ($FeatureProduct->items != null && sizeof($FeatureProduct->items) > 0) {
//                    echo ';$Reg : ' . $Reg;
                                        foreach ($FeatureProduct->items as $ProductSupplier) {
//                        echo ';$Reg : ' . $Reg;
                                            if ($ProductSupplier->itemsSupplieirs != null && sizeof($ProductSupplier->itemsSupplieirs) > 0 && $ProductSupplier->itemsSupplieirs) {
                                                foreach ($ProductSupplier->itemsSupplieirs as $ItemSup) {
                                                    if ($ItemSup->FEATURE_FLAG != null && $ItemSup->FEATURE_FLAG == 'F')
                                                        $FearuredProductCounter = $FearuredProductCounter + 1;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    ?>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 ">
                            <h3>Featured</h3>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <form class="form-inline">
                                <div class="form-group ctg-my-gr">
                                    <label for="inputSortBy">Sort by</label>
                                    <input type="hidden" value="DESC" id="SortByMethodFeatured">




                                    <select onclick=" SortBy('inputSortBy', '<?= '-1' ?>', 'ProductSortLink', 'SortByMethodFeatured', 'carouselFeatured')" class="form-control" id="inputSortBy">
                                        <option value="Price">Price</option>
                                        <option value="Name">Supplier</option>
                                        <option value="Date">Posting Date</option>

                                    </select>
                                </div>
                            </form>
                        </div>  
                    </div>

                    <div class="owl-carousel owl-carousel-Fea" id="carouselFeatured">
<?php
if ($FeatureProductModel != null) {

    if (sizeof($FeatureProductModel) > 0) {
        foreach ($FeatureProductModel as $FeatureProduct) {
            if ($FeatureProduct->items != null && sizeof($FeatureProduct->items) > 0) {

                foreach ($FeatureProduct->items as $ProductSupplier) {
                    if ($ProductSupplier->itemsSupplieirs != null && sizeof($ProductSupplier->itemsSupplieirs) > 0) {

                        foreach ($ProductSupplier->itemsSupplieirs as $ItemSuppliers) {
                            if ($ItemSuppliers->FEATURE_FLAG == 'F') {
                                ?>
                                                        <div class=""> 
                                                            <div style="height :200px;">
                                                                <img class="img-responsive center-block" src="<?= ($ItemSuppliers->itemsImgs != null && sizeof($ItemSuppliers->itemsImgs) > 0 && $ItemSuppliers->itemsImgs[0]->IMG_PATH != null ? Yii::getAlias('@web') . "/" . $ItemSuppliers->itemsImgs[0]->IMG_PATH : Yii::getAlias('@web') . "/img/EmptyItem.jpg") ?>">
                                                            </div>
                                                            <p><?= $ItemSuppliers->iTEM != null && $ItemSuppliers->iTEM->itemsTrans != null && sizeof($ItemSuppliers->iTEM->itemsTrans) > 0 && $ItemSuppliers->iTEM->itemsTrans[0]->ITEM_NAME != null ? $ItemSuppliers->iTEM->itemsTrans[0]->ITEM_NAME : "empty" ?></p>
                                <?php if ($ItemSuppliers->itemOptions != null && sizeof($ItemSuppliers->itemOptions) > 0 && $ItemSuppliers->itemOptions[0]->DISCOUNT != null) { ?>
                                                                <p><del><?= number_format($ItemSuppliers->itemOptions[0]->OPTION_PRICE != null ? $ItemSuppliers->itemOptions[0]->OPTION_PRICE : "") ?><?= ' ' . ($ItemSuppliers->itemOptions[0]->OPTION_PRICE != null ? $ItemSuppliers->itemOptions[0]->cURRENCY->CURRENCY_CODE : "") ?></del>
                                                                <?= number_format(($ItemSuppliers->itemOptions[0]->OPTION_PRICE - ($ItemSuppliers->itemOptions[0]->OPTION_PRICE * $ItemSuppliers->itemOptions[0]->DISCOUNT) / 100)) ?><?= ' ' . $ItemSuppliers->itemOptions[0]->cURRENCY->CURRENCY_CODE ?></p>
                                                            <?php } else { ?>

                                                                <p><?= number_format($ItemSuppliers->itemOptions != null && sizeof($ItemSuppliers->itemOptions) > 0 && $ItemSuppliers->itemOptions[0]->OPTION_PRICE != null ? $ItemSuppliers->itemOptions[0]->OPTION_PRICE : "122") ?><?= ' ' . ($ItemSuppliers->itemOptions != null && sizeof($ItemSuppliers->itemOptions) > 0 && $ItemSuppliers->itemOptions[0]->CURRENCY_ID ? $ItemSuppliers->itemOptions[0]->cURRENCY->CURRENCY_CODE : "USD") ?></p>

                                <?php } ?>

                                                            <img src="<?= Yii::getAlias('@web') . '/img/catalogue/pr-stars.png' ?>">
                                                            <p>(<?= $ItemSuppliers->itemRatingComments != null && sizeof($ItemSuppliers->itemRatingComments) > 0 ? sizeof($ItemSuppliers->itemRatingComments) . " reviews" : "0 review" ?>) </p>
                                                            <a class="cst-btn cst-btn-carousel5" href="#">Buy Now</a>
                                                        </div>
                                <?php
                            }
                        }
                    }
                }
            }
        }
    }
}
?>


<?php
$WebPat=Yii::getAlias('@web');
$this->registerJs("
$('.owl-carousel-Fea').owlCarousel({
		margin: 30,
	    loop:false,
		nav:true,
		navText: ['<img src=\"$WebPat/img/prev.svg\">','<img src=\"$WebPat/img/next.svg\">'],
	    responsiveClass:true,
	    responsive:{
	        0:{
	            items:1	            
	        },
	        768:{
	            items:3
	        },
	        992:{
	            items:3
	        }
	    },
	    autoplay: true,
	    autoplayHoverPause: true,
	    dots: false,
	    autoplayTimeout: 5000
	});
");
            
        
?>

                    </div>



<?php
if ($ProductModel != null) {

    if (sizeof($ProductModel) > 0) {

        foreach ($ProductModel as $Product) {

            $ProductCounter = 0;
//            echo ';$Reg : ' . $Reg;
            if ($Product->items != null && sizeof($Product->items) > 0 && $Product->sUBCATEGORY->cATEGORYOFITEM->CATEGORY_FLAG == $Reg) {

                if ($Product->items != null && sizeof($Product->items) > 0) {
//                    echo ';$Reg : ' . $Reg;
                    foreach ($Product->items as $ProductSupplier) {
//                        echo ';$Reg : ' . $Reg;
                        if ($ProductSupplier->itemsSupplieirs != null && sizeof($ProductSupplier->itemsSupplieirs) > 0) {
                            $ProductCounter = sizeof($ProductSupplier->itemsSupplieirs);
//                            echo ';$Reg : ' . $Reg;
//                                                                    echo '$ProductCounter = '.$Product->ITEM_SUPPLIER_ID;
                        }
                    }
                }

           
            }
            ?>  
<br>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 ">
                                        <h3><?= $Product->productsTrans != null && sizeof($Product->productsTrans) > 0 && $Product->productsTrans[0]->PRODUCT_NAME != null ? $Product->productsTrans[0]->PRODUCT_NAME : "empty" ?></h3>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <form class="form-inline">
                                            <div class="form-group ctg-my-gr">
                                                <label for="inputSortBy">Sort by</label>
                                                <input type="hidden" value="DESC" id="SortByMethodFeatured<?= $Product->PRODUCT_ID ?>">




                                                <select onchange=" SortBy('Price', '<?= $Product->PRODUCT_ID ?>', 'ProductSortLink', 'SortByMethodFeatured<?= $Product->PRODUCT_ID ?>', 'carouselFeatured<?= $Product->PRODUCT_ID ?>')" class="form-control" id="inputSortBy<?= $Product->PRODUCT_ID ?>">
                                                    
                                                    <option value="Name">Supplier</option>
                                                    <option value="Price">Price</option>
                                                    <option value="Date">Posting Date</option>

                                                </select>
                                            </div>
                                        </form>
                                    </div>  
                                </div>     





<div id="carouselFeatured<?= $Product->PRODUCT_ID ?>">
                                <div class="owl-carousel owl-carousell<?= $Product->PRODUCT_ID ?>" >
            <?php
            if ($Product->items != null && sizeof($Product->items) > 0) {

                foreach ($Product->items as $ProductSupplier) {
                    if ($ProductSupplier->itemsSupplieirs != null && sizeof($ProductSupplier->itemsSupplieirs) > 0) {

                        foreach ($ProductSupplier->itemsSupplieirs as $ItemSuppliers) {
                            ?>
                                                    <div class=""> 
                                                        <div style="height :200px;">
                                                            <a href="<?= Yii::getAlias('@web').'/item-view/index?productID='. $ItemSuppliers->ITEM_SUPPLIER_ID?>">
                                                            <img class="img-responsive center-block" src="<?= ($ItemSuppliers->itemsImgs != null && sizeof($ItemSuppliers->itemsImgs) > 0 && $ItemSuppliers->itemsImgs[0]->IMG_PATH != null ? Yii::getAlias('@web') . "/" . $ItemSuppliers->itemsImgs[0]->IMG_PATH : Yii::getAlias('@web') . "/img/EmptyItem.jpg") ?>">
                                                          </a>
                                                            </div>
                                                        <p><?= $ItemSuppliers->iTEM != null && $ItemSuppliers->iTEM->itemsTrans != null && sizeof($ItemSuppliers->iTEM->itemsTrans) > 0 && $ItemSuppliers->iTEM->itemsTrans[0]->ITEM_NAME != null ? $ItemSuppliers->iTEM->itemsTrans[0]->ITEM_NAME : "empty" ?></p>
                                                    <?php if ($ItemSuppliers->itemOptions != null && sizeof($ItemSuppliers->itemOptions) > 0 && $ItemSuppliers->itemOptions[0]->DISCOUNT != null) { ?>
                                                            <p><del><?= number_format($ItemSuppliers->itemOptions[0]->OPTION_PRICE != null ? $ItemSuppliers->itemOptions[0]->OPTION_PRICE : "") ?><?= ' ' . ($ItemSuppliers->itemOptions[0]->OPTION_PRICE != null ? $ItemSuppliers->itemOptions[0]->cURRENCY->CURRENCY_CODE : "") ?></del>
                                                        <?= number_format(($ItemSuppliers->itemOptions[0]->OPTION_PRICE - ($ItemSuppliers->itemOptions[0]->OPTION_PRICE * $ItemSuppliers->itemOptions[0]->DISCOUNT) / 100)) ?><?= ' ' . $ItemSuppliers->itemOptions[0]->cURRENCY->CURRENCY_CODE ?></p>
                                                    <?php } else { ?>

                                                            <p><?= number_format($ItemSuppliers->itemOptions != null && sizeof($ItemSuppliers->itemOptions) > 0 && $ItemSuppliers->itemOptions[0]->OPTION_PRICE != null ? $ItemSuppliers->itemOptions[0]->OPTION_PRICE : "122") ?><?= ' ' . ($ItemSuppliers->itemOptions != null && sizeof($ItemSuppliers->itemOptions) > 0 && $ItemSuppliers->itemOptions[0]->CURRENCY_ID ? $ItemSuppliers->itemOptions[0]->cURRENCY->CURRENCY_CODE : "USD") ?></p>

                            <?php } ?>
                                                            
                                                        <img src="<?= Yii::getAlias('@web') . '/img/catalogue/pr-stars.png' ?>">
                                                      
                                                        <p>(<?= $ItemSuppliers->itemRatingComments != null && sizeof($ItemSuppliers->itemRatingComments) > 0 ? sizeof($ItemSuppliers->itemRatingComments) . " reviews" : "0 review" ?>) </p>
                                                        <a class="cst-btn cst-btn-carousel5" href="<?= Yii::getAlias('@web').'/item-view/index?productID='. $ItemSuppliers->ITEM_SUPPLIER_ID?>">Buy Now</a>
                                                    </div>
                                                            <?php
                                                    }
                                                }
                                            }
                                        }?>
                                        </div>
</div>
<?php
                                        $WebPat=Yii::getAlias('@web');
$this->registerJs("
$('.owl-carousell$Product->PRODUCT_ID').owlCarousel({
		margin: 30,
               
	    loop:false,
		nav:true,
		navText: ['<img src=\"$WebPat/img/prev.svg\">','<img src=\"$WebPat/img/next.svg\">'],
	    responsiveClass:true,
	    responsive:{
	        0:{
	            items:1	            
	        },
	        768:{
	            items:3
	        },
	        992:{
	            items:3
	        }
	    },
	    autoplay: true,
	    autoplayHoverPause: true,
	    dots: false,
	    autoplayTimeout: 5000
	});
");
                                        
                                    }
                                }
                            }
                            ?>

<?php

            
        
?>


                    


                    

                   
