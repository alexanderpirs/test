<?php
if($FirstFamilyData!=null && sizeof($FirstFamilyData)>0){
   $FirstFamilyData=$FirstFamilyData[0]; 
?>
<div class="col-xs-12 col-sm-12 col-md-6">
                        <img src="<?= $FirstFamilyData->FAMILY_MEMBER_PIC!=null  ? Yii::getAlias('@web').'/'.$FirstFamilyData->FAMILY_MEMBER_PIC : Yii::getAlias('@web').'/img/about/emptypic.jpg' ?>" class="img-responsive center-block ab-b-25">
                        <div class="row">
                            <div class="col-md-8 ab-b-25">
                                <span><?=$FirstFamilyData->WEDSITE_ABOUT_FAMILY_NAME!=null ?$FirstFamilyData->WEDSITE_ABOUT_FAMILY_NAME :'enter name'?></span>
                            </div>
                            <div class="col-md-4">
                                <span class="edit-link">
                            <a href="#"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                          </span>
                            </div>
                            
                        </div>
                        
<?php    dosamigos\ckeditor\CKEditorInline::begin(['preset' => 'full','id'=>'OurStoryText'.$FirstFamilyData->WEDSITE_ABOUT_FAMILY_ID,'options'=>['class'=>'text-justify ab-b-25','style' =>'']]);?>
                        <?=$FirstFamilyData->WEDSITE_ABOUT_FAMILY_DESCRIPTION!=null ?$FirstFamilyData->WEDSITE_ABOUT_FAMILY_DESCRIPTION : "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."?>
                        <?php  dosamigos\ckeditor\CKEditorInline::end(); ?>
 <?php
$this->registerJs(<<<JS
                 
     CKEDITOR.instances['OurStoryText$FirstFamilyData->WEDSITE_ABOUT_FAMILY_ID'].on( 'blur', function (ev) {

        $.post("add-wedsite-about",
                {
                    OurHistory:CKEDITOR.instances['OurStoryText$FirstFamilyData->WEDSITE_ABOUT_FAMILY_ID'].getData() ,
                },
                function (data, status) {

                }); 
		}); 
JS
);
?>
                      </div>
                      <?php
                      }
?>