 
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$ProductModel = null;
if (isset($dataProviderItems)) {
    $ProductModel = $dataProviderItems->getModels();
}
$dataCityModel = null;
if (isset($dataCity)) {
    $dataCityModel = $dataCity->getModels();
}
?>

<!-- catalogue block1 -->
<div class="container-fluid ctg-block1-fluid">
    <div class="container ctg-block1">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-3 ctg-bottom">

                <div class="panel-to-change-location visible-xs">
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Store</a></li>
                        <li class="active">Catalogue</li>
                    </ol>

                    <ul class="list-inline">
                        <li><strong>Overview:</strong></li>
                        <li>Gifts in List: <span> 310</span></li>
                        <li>Fulfilled Gifts: <span> 25</span></li>
                        <li>Invitees: <span> 200</span></li>
                        <li>Reward Points: <span> 1200</span></li>
                        <li><a href="#">More Details</a></li>
                    </ul>

                    <div class="forms-div"> 
                        <?php
$ManuallyAddInviteeForm = ActiveForm::begin([

            'id' => 'SearchForm',
        'method' => 'post',
        'enableAjaxValidation' => true,
//    'enableClientScript' => false,
//        'options' => ['data-pjax' => true ]
//        'validationUrl' => ['budget/validate'],
        ]);
?>  
                        
                        <?= Html::dropDownList('Location', '', yii\helpers\ArrayHelper::map($dataCityModel, 'CITY_ID', 'CITY_TRANSLATION'), ['text' => 'All', 'class' => 'form-control w180', 'id' => 'LocationID', 'prompt' => 'All']) ?> 
                      
                        <input type="text" placeholder="Search by product or supplier..." class="form-control w270" id="searchterms">
                        

                        <input type="number" class="form-control w94" name="min-price" id="min-price" placeholder="Min Price">
                         
                        <input type="number" class="form-control w94" placeholder="Max Price" name="max-price" id="max-price">
                        
                        <select class="form-control w200">
                            <option disabled selected>Ask for Quotation for</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                        </select>

                        <a href="#" class="cst-btn cst-btn-ref-srch">Refine Search</a>
                         <?php
                            ActiveForm::end();
                            ?>  
                    </div>

                    <hr class="ctg-hr" /> 
                </div>


                <div class="ctg-aside-wrap"> 
                    <div class="ctg-avatar">
                        <div class="ctg-avatar-img">
                            <img src="<?=Yii::getAlias('@web').'/img/catalogue/ctg-avatar1.png'?>" class="img-responsive">
                            <div class="ctg-avatar-days">
                                <div class="ctg-avatar-days-text">
                                    <p class="text-center">40</p>
                                    <p class="text-center">days</p>

                                </div>
                            </div>
                        </div>
                        <h3 class="text-center ctg-ava-name">Alex & Kate</h3>
                        <p class="text-center ctg-ava-date-bon">Date: <span>08.02.17</span></p>
                        <p class="text-center ctg-ava-date-bon">Bonuses: <span>200</span></p>
                    </div>

                    <div class="m-u-w">
                        <p class="text-center"> +12 Months until Wedding </p>
                    </div>

                    <h3 class="">Category of Services:</h3>
                    <div class="ctg-filt-a-i a-i-toggled" data-a-i-toggl="0" id="importance">
                        <div class="circle-a-i">
                            <div class="circle-a-i-2"></div>
                        </div>
                        Importance
                    </div>
                    <div class="ctg-filt-a-i " data-a-i-toggl="1" id="Alphabetical">
                        <div class="circle-a-i">
                            <div class="circle-a-i-2"></div>
                        </div>
                        Alphabetical
                    </div>

                   

                    <div class="wrap-list-with-cats" id="SubCategoriesList">

                       
                        
                        
                        

                    </div>
                    <?php
                                $this->registerJs(<<<JS
                                        
                                        $('#importance').click(function(){
                                            $('#SubCategoriesList').load('sub-categories?cr=i'); 
                                        })
                                        $('#Alphabetical').click(function(){
                                            $('#SubCategoriesList').load('sub-categories?cr=a'); 
                                        })
   $(document).ready(function(){
        
   
    $('#SubCategoriesList').load('sub-categories');
    }); 
    
        
        
JS
                                );
                                ?>

                </div>
            </div>
            <div class="col-xs-12 col-sm-8 col-md-9">
                <div class="panel-to-change-location hidden-xs">
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Store</a></li>
                        <li class="active">Catalogue</li>
                    </ol>

                    <ul class="list-inline">
                        <li><strong>Overview:</strong></li>
                        <li>Gifts in List: <span> 310</span></li>
                        <li>Fulfilled Gifts: <span> 25</span></li>
                        <li>Invitees: <span> 200</span></li>
                        <li>Reward Points: <span> 1200</span></li>
                        <li><a href="#">More Details</a></li>
                    </ul>

                    <div class="forms-div"> 
                      <?php
$ManuallyAddInviteeForm = ActiveForm::begin([

            'id' => 'SearchForm',
        'method' => 'post',
        'enableAjaxValidation' => true,
//    'enableClientScript' => false,
//        'options' => ['data-pjax' => true ]
//        'validationUrl' => ['budget/validate'],
        ]);
?>  
                        
                        <?= Html::dropDownList('Location', '', yii\helpers\ArrayHelper::map($dataCityModel, 'CITY_ID', 'CITY_TRANSLATION'), ['text' => 'All', 'class' => 'form-control w180', 'id' => 'LocationID', 'prompt' => 'All']) ?> 
                      
                        <input type="text" placeholder="Search by product or supplier..." class="form-control w270" id="searchterms">
                        

                        <input type="number" class="form-control w94" name="min-price" id="min-price" placeholder="Min Price">
                         
                        <input type="number" class="form-control w94" placeholder="Max Price" name="max-price" id="max-price">
                        
                        <select class="form-control w200">
                            <option disabled selected>Ask for Quotation for</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                        </select>

                        <button  type="submit" id="SearchBu" class="cst-btn cst-btn-ref-srch">Refine Search</button>
                         <?php
                         
                         $this->registerJs(<<<JS

    
                                 $("form").submit(function(e){
    e.preventDefault();
 var v= $(this).serialize();

console.log(v);
    $('#productsView').load('itembyproduct',v);
});
        
    
 
        
        
JS
);
                            ActiveForm::end();
                            
                            
                            ?>  
                        
                        <?php

?>
                    </div>

                    <hr class="ctg-hr" /> 
                </div>

                <div class="carousel-gl-wrap" id="productsView">

                </div>

                <nav aria-label="Page navigation">
                    <ul class="pagination pull-right">
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li>
                            <a href="#" aria-label="Next">
                                <img src="<?=Yii::getAlias('@web').'/img/catalogue/ctg-pag-arr-next.svg'?>">
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>
    </div>
</div>
<script>

    function SortBy(SortBy, ProductID, ProductSortLink, PriceSortByMethod, Container) {


        var Sorting = document.getElementById(PriceSortByMethod).value;
        var Location = document.getElementById('LocationID').value;
//        var SupplierType = document.getElementById('SupplierTypeID').value;
//        var SupplierName = document.getElementById('SupplierID').value;
        var searchterms = document.getElementById('searchterms').value;
//        var SubCategoryID = document.getElementById('SubCategoryID').value;
        var minprice = document.getElementById('min-price').value;
        var maxprice = document.getElementById('max-price').value;

        $('#' + Container).load('itemsorting?sorting=' + Sorting +
                '&productID=' + ProductID +
                '&Location=' + Location +
//                '&SupplierType=' + SupplierType +
//                '&SupplierName=' + SupplierName +
                '&searchterms=' + searchterms +
//                '&SubCategoryID=' + SubCategoryID +
                '&min-price=' + minprice +
                '&max-price=' + maxprice +
                '&sortingby=' + SortBy
                );
        if (Sorting === 'ASC') {
            document.getElementById(PriceSortByMethod).value = 'DESC';
        } else {
            document.getElementById(PriceSortByMethod).value = 'ASC';
        }
    }

</script>
<?php
                                $this->registerJs(<<<JS
   $(document).ready(function(){
        
    var form = $('#SearchForm');
    $('#productsView').load('itembyproduct');
    }); 
    
        
        
JS
                                );
                                ?>