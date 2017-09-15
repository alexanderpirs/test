<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
?>
<!--'number'=>$number,
             'PlaceWithDataProvider'=>$PlaceWithDataProvider,
             'CircleDataProvider'=>$CircleDataProvider,
             'EventArray'=>$EventArray,
$placewith;
    public $Circle;
-->
<?php 
if($number!="0"){
    for($i=0;$i<intval($number);$i++){
     ?>

<div class="form-dynamic-row clearfix wrapperdynamic">
    <?= Html::activeDropDownList($InviteeModel, 'Circle['.$i.']',
      ArrayHelper::map($CircleDataProvider, 'INVITEE_CIRCLE_ID', 'INVITEE_CIRCLE_TRANS'),['class'=>'selectleftside']) ?>
    
					<?=Html::activeTextInput($InviteeModel, 'guestname['.$i.']',['class' =>'centerinput'])?>
                                        
					
					<?= Html::activeDropDownList($InviteeModel, 'placewith['.$i.']',
      ArrayHelper::map($PlaceWithDataProvider, 'INVITEE_PLACE_WITH_ID', 'INVITEE_PALCE_WITH_VALUE'),['class' =>'selectrightside']) ?>
                                        
				</div>
<?=Html::error($InviteeModel,'guestname['.$i.']', ['class' => 'help-block']);?>
<?=Html::error($InviteeModel,'placewith['.$i.']', ['class' => 'help-block']);?>
<?=Html::error($InviteeModel,'Circle['.$i.']', ['class' => 'help-block']);?>

<?php
    }
}
?>

