
<?php

use yii\helpers\Url;

$dataItemModelll = null;
if (isset($dataProviderItems)) {
    $dataItemModelll = $dataProviderItems->getModels();
}
$ItemID = 0;
if (Yii::$app->request != null && Yii::$app->request->get('productID') != null) {
    $ItemID = Yii::$app->request->get('productID');
}
$OptionID=0;
if($dataItemModelll!=null){
$OptionID = $dataItemModelll[0]->itemOptions[0]->OPTION_ID;
                         
}

$WeddingID = 0;
$FirstPartnerName = "";
$FirstPartnerLastName="";
$SecondPartnerName = "";
$SecondPartnerLastName="";
$WeddingType = "";
//sECONDCOUPLEPARTNER weddingTypeTranslation wEDDINGTYPE
$profilePAth="";

//sECONDCOUPLEPARTNER weddingTypeTranslation wEDDINGTYPE
if (Yii::$app->user->identity!=null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
    $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
    $profilePAth = Yii::$app->user->identity->weddings0[0]->COUPLE_IMG;
    $FirstPartnerName = Yii::$app->user->identity->weddings0[0]->fIRSTCOUPLEPARTNER->COUPLE_PARTNER_FIRST_NAME ;
    $FirstPartnerLastName=Yii::$app->user->identity->weddings0[0]->fIRSTCOUPLEPARTNER->COUPLE_PARTNER_LAST_NAME ;
    $SecondPartnerName = (isset(Yii::$app->user->identity->weddings0) &&  Yii::$app->user->identity->weddings0!=null && sizeof(Yii::$app->user->identity->weddings0)>0 && Yii::$app->user->identity->weddings0[0]->sECONDCOUPLEPARTNER!=null ? Yii::$app->user->identity->weddings0[0]->sECONDCOUPLEPARTNER->COUPLE_PARTNER_FIRST_NAME :"") ;
    $SecondPartnerLastName=(isset(Yii::$app->user->identity->weddings0) &&  Yii::$app->user->identity->weddings0!=null && sizeof(Yii::$app->user->identity->weddings0)>0 && Yii::$app->user->identity->weddings0[0]->sECONDCOUPLEPARTNER!=null ? Yii::$app->user->identity->weddings0[0]->sECONDCOUPLEPARTNER->COUPLE_PARTNER_LAST_NAME :"") ;
 $WeddingType = Yii::$app->user->identity->weddings0[0]->wEDDINGTYPE!=null && Yii::$app->user->identity->weddings0[0]->wEDDINGTYPE->weddingTypeTranslation!=null && Yii::$app->user->identity->weddings0[0]->wEDDINGTYPE->weddingTypeTranslation->WEDDING_TYPE_TRANSLATION!=null  ?Yii::$app->user->identity->weddings0[0]->wEDDINGTYPE->weddingTypeTranslation->WEDDING_TYPE_TRANSLATION:0;
} else if (Yii::$app->user->identity!=null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
    $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
    $profilePAth = Yii::$app->user->identity->weddings[0]->COUPLE_IMG;
    $FirstPartnerName = Yii::$app->user->identity->weddings0[0]->fIRSTCOUPLEPARTNER->COUPLE_PARTNER_FIRST_NAME ;
    $FirstPartnerLastName=Yii::$app->user->identity->weddings0[0]->fIRSTCOUPLEPARTNER->COUPLE_PARTNER_LAST_NAME ;
    $SecondPartnerName = (isset(Yii::$app->user->identity->weddings0) &&  Yii::$app->user->identity->weddings0!=null && sizeof(Yii::$app->user->identity->weddings0)>0 && Yii::$app->user->identity->weddings0[0]->sECONDCOUPLEPARTNER!=null ? Yii::$app->user->identity->weddings0[0]->sECONDCOUPLEPARTNER->COUPLE_PARTNER_FIRST_NAME :"") ;
    $SecondPartnerLastName=(isset(Yii::$app->user->identity->weddings0) &&  Yii::$app->user->identity->weddings0!=null && sizeof(Yii::$app->user->identity->weddings0)>0 && Yii::$app->user->identity->weddings0[0]->sECONDCOUPLEPARTNER!=null ? Yii::$app->user->identity->weddings0[0]->sECONDCOUPLEPARTNER->COUPLE_PARTNER_LAST_NAME :"") ;
 $WeddingType = Yii::$app->user->identity->weddings[0]->wEDDINGTYPE!=null && Yii::$app->user->identity->weddings[0]->wEDDINGTYPE->weddingTypeTranslation!=null && Yii::$app->user->identity->weddings[0]->wEDDINGTYPE->weddingTypeTranslation->WEDDING_TYPE_TRANSLATION!=null  ?Yii::$app->user->identity->weddings[0]->wEDDINGTYPE->weddingTypeTranslation->WEDDING_TYPE_TRANSLATION:0;
}
?>
<input type="hidden" id="optionID" value="<?=$OptionID?>">
<!-- block1 -->
<div class="container-fluid product-block1-fluid">
    <div class="container product-block1">
        <div class="row">
            <div class="col-xs-12 col-sm-6">

                <div class="wrapper-for-images">

                    <img class="pr-car-img-to-change img-responsive center-block" src="<?= $dataItemModelll[0]->itemsImgs != null && sizeof($dataItemModelll[0]->itemsImgs) > 0 ? Url::to('@web/' . $dataItemModelll[0]->itemsImgs[0]->IMG_PATH) : Url::to('@web/img/product/product-b1-car1.png') ?>">

                    <div class="owl-carousel owl-carousel3">
                        <?php
                        if ($dataItemModelll[0]->itemsImgs != null && sizeof($dataItemModelll[0]->itemsImgs) > 1) {
                            $t = 0;
                            foreach ($dataItemModelll[0]->itemsImgs as $img) {
                                ?>


                                <div class="just-for-mrg">
                                    <a href="#/">
                                        <img src="<?= ($img->IMG_PATH != null ? Yii::getAlias('@web') . '/' . $img->IMG_PATH : Url::to('@web/img/product/product-b1-car1.png')) ?>" class="img-responsive center-block pr-carousel-img-bl active-pr">
                                    </a>
                                </div>    
                                <?php
                                $t++;
                            }
                        }
                        ?>



                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 ">

                <h3><?= $dataItemModelll[0]->iTEM != null && $dataItemModelll[0]->iTEM->itemsTrans && sizeof($dataItemModelll[0]->iTEM->itemsTrans) > 0 ? $dataItemModelll[0]->iTEM->itemsTrans[0]->ITEM_NAME : "No Name" ?></h3>
                <p class="cts-weight300"><?= $dataItemModelll[0]->iTEM != null && $dataItemModelll[0]->iTEM->itemsTrans && sizeof($dataItemModelll[0]->iTEM->itemsTrans) > 0 ? $dataItemModelll[0]->iTEM->itemsTrans[0]->ITEM_DESC : "No Description" ?></p>
                <p><a href="#" class="my-pr-brand-link"> <?= $dataItemModelll[0]->sUPPLIER != null ? $dataItemModelll[0]->sUPPLIER->SUPPLIER_NAME : "No Name" ?> <img class="pr-brand-image" src="<?= $dataItemModelll[0]->sUPPLIER != null ? Yii::getAlias('@web') . '/' . $dataItemModelll[0]->sUPPLIER->SUPPLIER_LOGO : "" ?>" style="width: 88px;"></a></p>

                <img src="<?= Url::to('@web/img/product/pr-fill-st.svg') ?>" class="stars-evalueted">
                <img src="<?= Url::to('@web/img/product/pr-fill-st.svg') ?>" class="stars-evalueted">
                <img src="<?= Url::to('@web/img/product/pr-fill-st.svg') ?>" class="stars-evalueted">
                <img src="<?= Url::to('@web/img/product/pr-empty-st.svg') ?>" class="stars-evalueted"> 
                <img src="<?= Url::to('@web/img/product/pr-empty-st.svg') ?>" class="stars-evalueted">



                <p>
                    Price: 


                    <?php
                    if ($dataItemModelll[0]->itemOptions != null && sizeof($dataItemModelll[0]->itemOptions) > 0) {
//                                                              
                        ?>	



                    <div class="price-info" id="PriceInfo">

                        <?php if ($dataItemModelll[0]->itemOptions[0]->DISCOUNT != null) { ?>
                            <span class="old-price"><del><?= number_format($dataItemModelll[0]->itemOptions[0]->OPTION_PRICE != null ? $dataItemModelll[0]->itemOptions[0]->OPTION_PRICE : "") ?><?= ' ' . ($dataItemModelll[0]->itemOptions[0]->OPTION_PRICE != null ? $dataItemModelll[0]->itemOptions[0]->cURRENCY->CURRENCY_CODE : "") ?></del></span>
                            <span class="new-price"><?= number_format(($dataItemModelll[0]->itemOptions[0]->OPTION_PRICE - ($dataItemModelll[0]->itemOptions[0]->OPTION_PRICE * $dataItemModelll[0]->itemOptions[0]->DISCOUNT) / 100)) ?><?= ' ' . $dataItemModelll[0]->itemOptions[0]->cURRENCY->CURRENCY_CODE ?></span>
                        <?php } else { ?>

                            <span class="old-price"><?= number_format($dataItemModelll[0]->itemOptions[0]->OPTION_PRICE != null ? $dataItemModelll[0]->itemOptions[0]->OPTION_PRICE : "") ?><?= ' ' . ($dataItemModelll[0]->itemOptions[0]->CURRENCY_ID ? $dataItemModelll[0]->itemOptions[0]->cURRENCY->CURRENCY_CODE : "") ?></span>

                        <?php } ?>
                    </div>
                 
                    <?php
                }
                ?>





                </p>

                <div class="row">


                    <?php
                    $critUsed = array();
                    $CritUsedValue = array();
                    if ($dataItemModelll[0]->itemOptions != null && sizeof($dataItemModelll[0]->itemOptions) > 1) {
                        foreach ($dataItemModelll[0]->itemOptions as $ItOption) {
                            if ($ItOption->CRITERIAS_VALUES != null) {
                                $Critr = explode(",", $ItOption->CRITERIAS_VALUES);
                                foreach ($Critr as $CriteiaValueID) {
                                    $CriteriaData = \app\controllers\ItemViewController::GetCriteriaIDAndValueByCriteriaValueID($CriteiaValueID);
                                    if ($CriteriaData != null && sizeof($CriteriaData) > 0) {
                                        $CriteraID = $CriteriaData[0]->CRITERIA_ID;
                                        $CriteraName = $CriteriaData[0]->cRITERIA->CRITERIA_NAME;
                                    }
                                    if (!in_array($CriteraID, $critUsed)) {
                                        array_push($critUsed, $CriteraID);
                                        array_push($CritUsedValue, $CriteraName);
                                    }
                                }
                            }
                        }
                    }



                    $critValuesUsed = array();
                    if ($critUsed != null && !empty($critUsed)) {
                        ?>


                        <?php
                        $i = 0;
                        $p = 0;
                        foreach ($critUsed as $CritValue) {
                            if ($p == 0) {
                                ?>
                                <div class="col-xs-12 col-sm-12 col-md-6">

                                    <form class="form-horizontal">
                                        <?php
                                    }
                                    ?>


                                    <div class="form-group">
                                        <label for="inputSize" class="col-sm-4 control-label"><?= $CritUsedValue[$i] ?>:</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="SelectedCrite" onchange="SetHiddenValue();">


                                                <?php
                                                if ($dataItemModelll[0]->itemOptions != null && sizeof($dataItemModelll[0]->itemOptions) > 1) {
                                                    foreach ($dataItemModelll[0]->itemOptions as $ItOption) {
                                                        if ($ItOption->CRITERIAS_VALUES != null) {
                                                            $Critr = explode(",", $ItOption->CRITERIAS_VALUES);
                                                            foreach ($Critr as $CriteiaValueID) {
                                                                $CriteriaData = \app\controllers\ItemViewController::GetCriteriaIDAndValueByCriteriaValueID($CriteiaValueID);
                                                                if ($CriteriaData != null && sizeof($CriteriaData) > 0) {
                                                                    if ($CriteriaData[0]->CRITERIA_ID == $CritValue && !in_array($CriteiaValueID, $critValuesUsed)) {
                                                                        array_push($critValuesUsed, $CriteiaValueID);
                                                                        ?>  


                                                                        <option value="<?= $CriteiaValueID ?>"><?= $CriteriaData[0]->CRITERIA_VALUE ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!--la 7al-->
                                    <?php
                                    if ($p == 2) {
                                        $p = 0;
                                        ?>

                                    </form></div>
                                <?php
                            }
                            ?>

                            <?php
                            $p++;
                            $i++;
                        }
                    }
                    ?>


                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <p>Description:</p>
                        <p class="cst-change-color bottom30 text-justify" id="ItemOptionDescription"><?= $dataItemModelll[0]->itemOptions != null && sizeof($dataItemModelll[0]->itemOptions) > 0 && $dataItemModelll[0]->itemOptions[0]->itemOptionTrans != null && sizeof($dataItemModelll[0]->itemOptions[0]->itemOptionTrans) > 0 ? $dataItemModelll[0]->itemOptions[0]->itemOptionTrans[0]->OPTION_DESC : "" ?> </p>
                        <?php ?>

                        <?php if ($Reg == 'C') { ?>
                            <a class="cst-btn cst-brn-pr1" href="#">Buy Now</a>
                            <a class="cst-btn cst-brn-pr2" href="#">Add to Wish List</a>
                        <?php } ?>

                        <?php if ($Reg == 'R') { ?>
                            <!--$OneOptionID-->
                            <a class="cst-btn cst-brn-pr1" href="#">Add to registry</a>
                            <a class="cst-btn cst-brn-pr2" href="#">Add to Wish List</a>

                            <!--<div class="coupon"></div>-->
                        <?php } else { ?>
                            <!--<a href="#/">Generate Voucher</a>-->
                            <?php
                        }
                        $HasCoupon = false;
                        if ($dataItemModelll[0]->coupons != null && sizeof($dataItemModelll[0]->coupons) > 0) {
                            foreach ($dataItemModelll[0]->coupons as $Coupo) {
                                if ($Coupo->WEDDING_ID == $WeddingID) {
                                    $HasCoupon = true;
                                }
                            }
                        }
                        ?>
                        <?php
                        if ($HasCoupon == false) {
                            
                            $this->registerJs("
              $('#HaveCoupon').click(function() {
   

    var OptionID = document.getElementById('optionID').value;

                alert( OptionID);
                $.ajax({
            url: 'generate-coupon',
            type: 'GET',
//           dataType: 'json',
//           contentType: 'application/json; charset=utf-8',
            data: 'ItemID=$ItemID&OptionID='+OptionID,
            success: function (data) {
// 
alert(data);
if(data.success!=null){
alert(data.success);
 $('#HaveCoupon').remove();
  
}
if(data.msg!=null){
alert(data.msg);
}
            },
            error: function () {
                alert('ERROR at PHP side!!');
            },
        });
    });
                                                                            
");
                            ?>  
                            <a class="cst-link-why-not" id="HaveCoupon" href="#/">Have&nbsp;a&nbsp;Coupon?</a>

                        <?php } else { ?>
                            <span>you have coupon generated!</span>
                        <?php } ?>



                        
                    </div>
                </div>
            </div> 
        </div>   
    </div>
</div>





<!-- block2 -->
<div class="container-fluid product-block2-fluid">
    <div class="container product-block2">
        <h3 class="testimonials-head">Customers Reviews (<?= $dataItemModelll[0]->itemRatingComments != null && sizeof($dataItemModelll[0]->itemRatingComments) > 0 ? sizeof($dataItemModelll[0]->itemRatingComments) : "0" ?>) 
            <img src="<?= Url::to('@web/img/prev.svg') ?>">
            <img src='<?= Url::to('@web/img/next.svg') ?>'>
        </h3>
        <div class="owl-carousel owl-carousel4">

            <?php
            if ($dataItemModelll[0]->itemRatingComments != null && sizeof($dataItemModelll[0]->itemRatingComments) > 0) {
                foreach ($dataItemModelll[0]->itemRatingComments as $Comment) {
                    ?>
                    <div class="testi-block">
                        <p><?= $Comment->cOUPLEPARTNER->COUPLE_PARTNER_FIRST_NAME . ' ' . $Comment->cOUPLEPARTNER->COUPLE_PARTNER_LAST_NAME ?></p>
                        <img src="<?= Url::to('@web/img/product/pr-stars.png') ?>">
                        <p class="text-justify"><?= $Comment->ITEM_COMMENT ?></p>
                    </div>
                    <?php
                }
            }
            ?>



        </div>
    </div>



    <!-- block3 -->
    <div class="container-fluid product-block3-fluid">
        <div class="container product-block3">
            <h3 class="text-center">You May Also Like</h3>

            <div class="owl-carousel owl-carousel2">


                <?php
                $Product = null;

                if (isset($dataProviderFeaturedItems) && $dataProviderFeaturedItems != null && sizeof($dataProviderFeaturedItems) > 0) {

                    $Product = $dataProviderFeaturedItems[0]->iTEM->pRODUCT;
                }
                $SupplierID = '';
                ?>

                <?php
                if ($Product != null) {

                    $ProductCounter = 0;
//            echo ';$Reg : ' . $Reg;
                    if ($Product->items != null && sizeof($Product->items) > 0) {

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
                        ?>
                        <?php
                        if ($Product->items != null && sizeof($Product->items) > 0) {

                            foreach ($Product->items as $ProductSupplier) {
                                if ($ProductSupplier->itemsSupplieirs != null && sizeof($ProductSupplier->itemsSupplieirs) > 0) {

                                    foreach ($ProductSupplier->itemsSupplieirs as $ItemSuppliers) {
                                        if ($ItemSuppliers != null && $ItemSuppliers->ITEM_SUPPLIER_ID != $ItemID) {
                                            ?>

                                            <div>
                                                <a href="<?= Url::to(['item-view/index', 'productID' => $ItemSuppliers->ITEM_SUPPLIER_ID]) ?>">
                                                    <img src="<?= $ItemSuppliers->itemsImgs != null && sizeof($ItemSuppliers->itemsImgs) > 0 && $ItemSuppliers->itemsImgs[0]->IMG_PATH != null ? Yii::getAlias('@web') . '/' . $ItemSuppliers->itemsImgs[0]->IMG_PATH : Yii::getAlias('@web') . '/img/EmptyItem.jpg' ?>" class="img-responsive center-block">
                                                    <p class="sli-cat-pr"><?= $ItemSuppliers->iTEM != null && $ItemSuppliers->iTEM->itemsTrans != null && sizeof($ItemSuppliers->iTEM->itemsTrans) > 0 && $ItemSuppliers->iTEM->itemsTrans[0]->ITEM_NAME != null ? $ItemSuppliers->iTEM->itemsTrans[0]->ITEM_NAME : "empty" ?></p>
                                                    <p class="sli-name-pr">
                                                        <?php if ($ItemSuppliers->DISCOUNT != null) { ?>
                                                        <div class="price"><s><?= number_format($ItemSuppliers->PRICE) ?><?= ' ' . $ItemSuppliers->cURRENCY->CURRENCY_CODE ?></s><span class="new-price"></span></div>
                                                        <span class="old-price"><del><?= number_format($ItemSuppliers->PRICE) ?><?= ' ' . $ItemSuppliers->cURRENCY->CURRENCY_CODE ?></del></span>
                                                        <?= number_format(($ItemSuppliers->PRICE - ($ItemSuppliers->PRICE * $ItemSuppliers->DISCOUNT) / 100)) ?><?= ' ' . $ItemSuppliers->cURRENCY->CURRENCY_CODE ?>
                                                    <?php } else { ?>
                                                        <span class="old-price"><?= number_format($ItemSuppliers->PRICE) ?><?= ' ' . $ItemSuppliers->cURRENCY->CURRENCY_CODE ?></span>

                                                    <?php } ?>


                                                    </p>
                                                </a>
                                            </div>
                                            <?php
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                ?>


            </div>
        </div>
    </div>

    <script>
        function SetHiddenValue() {


            var SelectedCriteElement = document.getElementsByName('SelectedCrite');
            var IDs = "";
            if (SelectedCriteElement !== null && SelectedCriteElement.length > 0) {
                for (var i = 0; i < SelectedCriteElement.length; i++) {
                    if (SelectedCriteElement[i].value === "") {
                        IDs = "";
                    } else {
                        if (i === (SelectedCriteElement.length - 1)) {
                            IDs = IDs + SelectedCriteElement[i].value;
                        } else {
                            IDs = IDs + SelectedCriteElement[i].value + ",";
                        }
                    }
                }
            }
//                alert(IDs);
            if (IDs !== "") {

                $.ajax({
                    url: 'option-values',
                    type: 'GET',
//           dataType: 'json',
//           contentType: 'application/json; charset=utf-8',
                    data: 'SelectedCrite=' + IDs + '&ItemID=' +<?= $ItemID ?>,
                    success: function (data) {


                        document.getElementById('optionID').value = data.OptionID;

                        $('#PriceInfo').html(data.PriceForm);
//                'ItemOptionDesc' =>$ItemOptionDesc,
                        $('#ItemOptionDescription').html(data.ItemOptionDesc);
//                alert('test');
//                $.pjax({container: '#'});

//                  alert('test');
                    },
                    error: function () {
                        alert('ERROR at PHP side!!');
                    },
                });
            }
        }
//function WriteReview(){
//var NewReview=document.getElementById('NewReview').value;
//if(NewReview.trim()!==""){
//                              $.ajax({
//            url: '/yiiApp/basic/web/index.php?r=item-view%2Fnew-comment',
//            type: 'GET',
//           dataType: 'json',
//           contentType: 'application/json; charset=utf-8',
//            data: 'NewReview=' + NewReview+'&ItemID=<?= $ItemID ?>',
//            success: function (data) {
////                alert('test');
////                $.pjax({container: '#'});
//                $("#CommentRow").prepend("<div class=\"col-md-12 col-sm-12 col-lg-12 rating-box\">"+
//									"<div>"+
//										"<div class=\"starrr\" id=\"three-stars\"></div>"+
//										
//									"</div>"+
//									"<div class=\"review-info\">"+
//										"<h5><strong>name//ll</strong></h5>"+
//										"<p>"+NewReview+"</p>"+
//									"</div>"+
//                                                                "</div>");
//                                                        document.getElementById('NewReview').value="";
//                                                        
////                  alert('test');
//            },
//            error: function () {
//                alert('ERROR at PHP side!!');
//            },
//        });  
//        }
//}
//    


    </script>
    
   <?php
   
$this->registerJs("
    
//$(document).ready(function(){
//              $('.owl-carousel3').owlCarousel({
//		margin: 30,
//	    loop:false,
//		nav:true,
//		navText: [\"<img src='../img/prev.svg'>","<img src='../img/next.svg'>\"],
//	    responsiveClass:true,
//	    responsive:{
//	        0:{
//	            items:1	            
//	        },
//	        768:{
//	            items:3
//	        },
//	        992:{
//	            items:3
//	        }
//	    },
//	    autoplay: true,
//	    autoplayHoverPause: true,
//	    dots: false,
//	    autoplayTimeout: 5000
//	});
//       });                                                                     
");   
   
   ?> 