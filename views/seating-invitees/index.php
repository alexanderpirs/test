	<?php
        
    use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use \kartik\select2\Select2;
use kartik\file\FileInput;
use kartik\editable\Editable;
$WeddingID=0;
 if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings0 != null && sizeof(Yii::$app->user->identity->weddings0) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings0[0]->WEDDING_ID;
        } else if (Yii::$app->user->identity != null && Yii::$app->user->identity->weddings != null && sizeof(Yii::$app->user->identity->weddings) > 0) {
            $WeddingID = Yii::$app->user->identity->weddings[0]->WEDDING_ID;
        }
        ?>
		<section class="mainContent dashboard clearfix" style="margin-top:30px;">
		<div class="switcherblock clearfix">
			<div class="container wrapperofswitcher" style="padding:0px;">
				<div class="firstswitcher  switcherobq activeswitcher">
								<p>Invitees List</p>	
							</div>
							<div class="secswitcher switcherobq ">
								<p>Seat Invitees</p>
							</div>
						</div>
			</div>
			<div class="container" style="border:1px solid #c9c9c9;border-top-left-radius:0px;border-top-right-radius:0px;padding-left:0px;padding-right:0px;">
				<div class="row">
					

					<div class="col-lg-12 " style="padding:0px;">
						<!-- LIST PEOPPLE -->
						
						<div class="subpage-content-container">
						
							<div class="subpage-title clearfix closerrr">
                                                            <?php
                        $numberOfInvitees = 0;
                        if (isset($Invitees) && $Invitees != null) {
                            $Inviteess = $Invitees->getModels();
                            if ($Inviteess != null && sizeof($Inviteess) > 0) {
                                $numberOfInvitees = $numberOfInvitees + sizeof($Inviteess);
                                foreach ($Inviteess as $invitee) {

                                    if ($invitee->inviteeGuests != null && sizeof($invitee->inviteeGuests) > 0) {
                                        $numberOfInvitees = $numberOfInvitees + sizeof($invitee->inviteeGuests);
                                    }
                                }
                            }
                        }

                        $EstimatedInvitessNumber = 0;
                        if (isset($GetEstimatedInviteesDataModel) && $GetEstimatedInviteesDataModel != null) {

                            $GetEstimatedInviteesDataModel = $GetEstimatedInviteesDataModel->getModels();
                            if (sizeof($GetEstimatedInviteesDataModel) > 0) {
                                foreach ($GetEstimatedInviteesDataModel as $GetStared) {
                                    $EstimatedInvitessNumber = $GetStared->INVITEE_NUMBER;
                                }
                            }
                        }
                        ?>
								<div class="wrapperinvite">
									<p class="fontsansreg">People To Invite</p>
									<div class="badge badgeLightBlue mybadgeleft mybadgeright fontsanslight">
                                                                            <?= Editable::widget([
    'name'=>'InviteeNumber', 
    'asPopover' => true,
                            'preHeader'=>'',
                            'header'=>null,
                            
     'value' => $EstimatedInvitessNumber,                       
    'format' => Editable::FORMAT_BUTTON,
    'inputType' => Editable::INPUT_TEXT,
//   'templateBefore'=>Editable::INLINE_AFTER_1,    
//     'buttonsTemplate'=>'{submit}',
     'afterInput'=>function($form, $widget) {
        echo '<div class="form-group"><button type="button" class="btn btn-sm btn-primary kv-editable-submit" title="Apply">Save</button><button type="button" class="close" data-dismiss="popover-x" aria-hidden="true">×</button></div>';
    },
            'beforeInput'=>function($form, $widget) {
        echo '<div class="form-group"><div class="kv-editable-loading" style="display: none;">&nbsp;</div></div>';
    },
     'footer'=>'',    
//      'content'=>'{input}{loading}{submit}',                      
     'contentOptions'=>['class'=>' form-group'],                       
    'formOptions'=>['class'=>'kv-editable-form', 'action'=>['invitees/edit-invitee-number']],
    'options' => ['class'=>'form-control kv-editable-input','placeholder'=>'add number'],
    'editableValueOptions'=>['class'=>' badgeLightBlue']
]);

 ?>
                                                                        </div><img src='<?=Yii::getAlias('@web').'/img/icons/pencil.png'?>'  width='16px' alt="">
								</div>
								<div class="wrapperofinfo">
									<h2 class='fontsansreg'>Invitees</h2>
								<div class="badge badgeLightBlue mybadgeright fontsanslight"><?=$numberOfInvitees?></div>
								</div>
                                                              <?php
                        
                        
                       
                        ActiveForm::begin([

                            'id' => 'UploadForm',
                            'method' => 'POST',
                            'options' => ['enctype' => 'multipart/form-data','style'=>'padding-left: 281px;']
                        ]);
                        ?>
								<div class="btn-group">
									
									<button type="button" class="btn bgBlue dropdown-toggle mybutt fontsansreg" style='border-radius:10px;' data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="dropdownAddInvitees">
										Add Invitees  <!-- <img src="assets/img/blackline.png" alt="" style="width:0.9px;"> --><span style='margin-left:20px;Add' class="fa fa-chevron-down"></span>
									</button>
									<ul class="dropdown-menu  menuonsers" id="menudropdown" style="top:85%;" aria-labelledby="dropdownAddInvitees">
										<li>
                                    <?= Html::a('Add manually', '#/', ['value' => Yii::getAlias('@web').'/seating-invitees/new-manual-invitee?InviteeID=0', 'title' => 'Creating New Company', 'class' => 'showModalButton']); ?>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li><a data-toggle="modal" href='#FacebookList'>Invite from Facebook</a></li>
                                <li><a href="#/" id="googleContactsButton">Invite from Google+</a></li>
                                <li><a href="#">Phone contacts</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a id="UploadB" href="#">Upload spreadsheet</a></li>
                                <input type="file" name="UploadFileEx" style="display : none;" id="UploadFileEx">
                                <li><a href="#/" onclick="GetDownload();">Download template</a></li>
									</ul>
								</div>
								 <?php 
                                                                 ActiveForm::end();
                                                                    ?>
							</div>

							<div class="subpage-content closerrr">
								<div class="list-people-content">
									<div class="list-people-statistic clearfix" id="Statics">
                                                                            
                                                                             <?= $this->render('_statistics', [
                                   'Invitees' => $Invitees,
                                    'numberOfInvitees' => $numberOfInvitees,
                                   ]) ?>
<!--										<div class="statistic-circle hidden-xs hidden-sm col-md-9">
											<div class="statistic statistic-danger circle-size-2 fontsanslightS">2</div>
											<div class="statistic statistic-warning circle-size-3 fontsanslightS">3</div>
											<div class="statistic statistic-success circle-size-4 fontsanslightS">4</div>
											<div class="statistic statistic-primary circle-size-1 fontsanslightS">1</div>
										</div>
										<div class="statistic-rectangle pullRight col-sm-4 col-md-3">
											<div class="statistic statistic-warning fontsanslight">
												3 Groom's colugues
											</div>
											<div class="statistic statistic-danger fontsanslight">
												2 Groom's friends
											</div>
											<div class="statistic statistic-primary fontsanslight">
												1 Groom's family
											</div>
											<div class="statistic statistic-success fontsanslight">
												4 Mutual friends
											</div>
										</div>-->
									</div>
									<?php
//                                                                        echo print_r($SendCartByArray,true);
//                                                                        'PlaceWiths'=>$PlaceWiths,
//                    'Circles'=>$Circles,
//                    'SendCartBy'=>$SendCartBy,
//                    'WeddingEvent'=>$WeddingEvent,
                                                                        ?>
									<div class="list-people-wrapper">
										<div class="list-people-choose clearfix">
											<div class="search-box">
												<span class="ws-ws_search"></span>
												<input class="search-input fontsanslight" type="text" placeholder="Search" >
												<div class="group-dropdown-menu-selected group-dropdown-invitation InvitationClass">
													<button type="button" class="btn bgBlue dropdown-toggle btn-dropdown-menu-selected dropclass fontsansreg">
													<!-- 	<span class="ws-ws_email"></span> -->
														<p>Invitation</p>
														<!-- <span class="ws-ws_caret-up iconRotate180"></span> -->
													</button>
													<ul class="dropdown-menu-selected">
                                                                                                            <?php 
                                                                                                            if($SendCartBy!=null && sizeof($SendCartBy)>0){
                                                                                                                foreach($SendCartBy as $SendCart){
                                                                                                                   ?>
                                                                                                            
                                                                                                                <li>
														        <label for="SendCardBy<?=$SendCart->SEND_CART_BY_ID?>">
																<input type="checkbox" class="custom-checkbox" value="<?=$SendCart->SEND_CART_BY_ID?>" id="SendCardBy<?=$SendCart->SEND_CART_BY_ID?>">
																<p><?=$SendCart->SEND_CART_BY_NAME?></p>
																<span class="label-checkbox "></span>
															</label>
														</li>
                                                                                                            <?php
                                                                                                                }
                                                                                                            }
                                                                                                            ?>
														
<!--														<li role="separator" class="divider"></li>
														<li class="circle-add">
															<p>New Circle</p>
															<button>+</button>
														</li>-->
													</ul>
												</div>
												<div class="group-dropdown-menu-selected group-dropdown-place-with PlaceWithClass">
													<button type="button" class="btn bgBlue dropdown-toggle btn-dropdown-menu-selected dropclass fontsansreg">
														<!-- <span class="ws-ws_location"></span> -->
														<p>Place with</p>
														<!-- <span class="ws-ws_caret-up iconRotate180"></span> -->
													</button>
													<ul class="dropdown-menu-selected">
                                                                                                            <?php
                                                                                                            if($PlaceWiths!=null && sizeof($PlaceWiths)>0){
                                                                                                                foreach($PlaceWiths as $PlaceWith){
                                                                                                                   ?>
                                                                                                                <li>
															<label for="PlaceWith<?=$PlaceWith->INVITEE_PLACE_WITH_ID?>">
																<input type="checkbox" class="custom-checkbox" value="<?= $PlaceWith->INVITEE_PLACE_WITH_ID?>" id="PlaceWith<?=$PlaceWith->INVITEE_PLACE_WITH_ID?>">
																<p><?= $PlaceWith->INVITEE_PALCE_WITH_VALUE?></p>
																<span class="label-checkbox "></span>
															</label>
														</li>
                                                                                                            <?php
                                                                                                                }
                                                                                                            }
                                                                                                            ?>
														
														
													</ul>
												</div>
												<div class="group-dropdown-menu-selected CircleClass">
													<button type="button" class="btn bgBlue dropdown-toggle btn-dropdown-menu-selected dropclass fontsansreg">
														<!-- <span class="ws-ws_circles"></span> -->
														<p>Circles</p>
														<!-- <span class="ws-ws_caret-up iconRotate180"></span> -->
													</button>
													<ul class="dropdown-menu-selected">
                                                                                                            <?php
                                                                                                            if($Circles!=null && sizeof($Circles)>0){
                                                                                                                foreach($Circles as $Circle){
                                                                                                                ?>
                                                                                                            <li>
															<label for="Circle<?=$Circle->INVITEE_CIRCLE_ID?>">
																<input type="checkbox" class="custom-checkbox" value="<?=$Circle->INVITEE_CIRCLE_ID?>" id="Circle<?=$Circle->INVITEE_CIRCLE_ID?>">
																<p><?=$Circle->INVITEE_CIRCLE_TRANS?></p>
																<span class="label-checkbox "></span>
															</label>
														</li>
                                                                                                            <?php
                                                                                                                }
                                                                                                            }
                                                                                                            ?>
														
														
													</ul>
												</div>
												<div class="group-dropdown-menu-selected EventsClass">
													<button type="button" class="btn bgBlue dropdown-toggle btn-dropdown-menu-selected dropclass">
														<!-- <span class="ws-ws_calendar"></span> -->
														<p>Events</p>
														<!-- <span class="ws-ws_caret-up iconRotate180"></span> -->
													</button>
													<ul class="dropdown-menu-selected">
                                                                                                            <?php
                                                                                                            
                                                                                                            if ($WeddingEvent != null && sizeof($WeddingEvent) > 0) {
                 $i = 0;
                foreach ($WeddingEvent as $WeddingEven) {

                    if ($WeddingEven->WEDDING_ID != null && $WeddingEven->WEDDING_ID == $WeddingID && $WeddingEven->WEDDING_EVENT_VALUE!=null) {
                        ?>
                                                                                                            
                                                                                                            <li>
															<label for="Events<?=$WeddingEven->WEDDING_EVENT_ID?>">
																<input type="checkbox" class="custom-checkbox" value="<?=$WeddingEven->WEDDING_EVENT_ID?>" id="Events<?=$WeddingEven->WEDDING_EVENT_ID?>">
																<p><?=$WeddingEven->WEDDING_EVENT_VALUE?></p>
																<span class="label-checkbox "></span>
															</label>
														</li>
                                                                                                            <?php
                    }if ($WeddingEven->WEDDING_ID == null) {
                        ?>
                                                                                                                <li>
															<label for="Events<?=$WeddingEven->WEDDING_EVENT_ID?>">
                                                                                                                            <input type="checkbox" class="custom-checkbox" value="<?=$WeddingEven->WEDDING_EVENT_ID?>" id="Events<?=$WeddingEven->WEDDING_EVENT_ID?>">
																<p><?=$WeddingEven->weddingEventTranslations != null && sizeof($WeddingEven->weddingEventTranslations) > 0 && $WeddingEven->weddingEventTranslations[0]->wedding_event_VALUE != null ? $WeddingEven->weddingEventTranslations[0]->wedding_event_VALUE : ""?></p>
																<span class="label-checkbox "></span>
															</label>
														</li>
                                                                                                                <?php
                        
                    }
                    $i++;
                }
            }
                                                                                                            ?>
                                                                                                            
														
<!--														<li role="separator" class="divider"></li>
														<li class="circle-add">
															<p>New Circle</p>
															<button>+</button>
														</li>-->
													</ul>
												</div>
											</div>
										</div>
                                                                            
                                                                            <?php
$Webb = Yii::getAlias('@web');
$this->registerJs(<<<JS
$('.custom-checkbox').click(function (){
        var InvitationClass = $('.InvitationClass').find( "input" );
        var PlaceWithClass = $('.PlaceWithClass').find( "input" );
        var CircleClass = $('.CircleClass').find( "input" );
        var EventsClass = $('.EventsClass').find( "input" );
        var Invitation="";
        if(InvitationClass!=null && InvitationClass.length>0){
           for(var i=0;i<InvitationClass.length;i++){
        if(InvitationClass[i].checked){
            Invitation=Invitation+InvitationClass[i].value +",";
        }
            
            }
        }
        
        var PlaceWith="";
        if(PlaceWithClass!=null && PlaceWithClass.length>0){
           for(var i=0;i<PlaceWithClass.length;i++){
        if(PlaceWithClass[i].checked){
            PlaceWith=PlaceWith+PlaceWithClass[i].value +",";
        }
            
            }
        }
        
        var Circle="";
        if(CircleClass!=null && CircleClass.length>0){
           for(var i=0;i<CircleClass.length;i++){
        if(CircleClass[i].checked){
            Circle=Circle+CircleClass[i].value +",";
        }
            
            }
        }
        
        var Events="";
        if(EventsClass!=null && EventsClass.length>0){
           for(var i=0;i<EventsClass.length;i++){
        if(EventsClass[i].checked){
            Events=Events+EventsClass[i].value +",";
        }
            
            }
        }
   $('#InviteesPjax').load('$Webb/seating-invitees/search',{Invitation:Invitation, PlaceWith:PlaceWith, Circles:Circle,Event : Events});
    });
   
JS
);
?>
                                                                         
                                                                            
                                                                            
                                                                            
										<div class="list-peoples">
                                                                                    	<ul>
                                                                                               <li class="list-people-header clearfix">
													<div class="l-input">
														<label for="list-all">
															<input type="checkbox" class="custom-checkbox " id="list-all">
															<span class="label-checkbox "></span>
														</label>
													</div>
													<div class="l-guests">
														<button class="btnSort fontsansreg">Guests <span class="ws-ws_caret-up iconRotate180"></span></button>
													</div>
													<div class="l-events">
														<button class="btnSort fontsansreg">Events<span class="ws-ws_caret-up iconRotate180"></span></button>
													</div>
													<div class="l-circles">
														<button class="btnSort fontsansreg">Circles<span class="ws-ws_caret-up iconRotate180"></span></button>
													</div>
													<div class="l-place-with">
														<button class="btnSort fontsansreg">Place with<span class="ws-ws_caret-up iconRotate180"></span></button>
													</div>
													<div class="l-invitation">
														<button class="btnSort fontsansreg">Invitation<span class="ws-ws_caret-up iconRotate180"></span></button>
													</div>
													<div class="l-action">
													</div>
												</li>
                                                                                                <div id="InviteesPjax">
                                                                                              <?= $this->render('_search', ['Invitees' => $Invitees]) ?>
                                                                                                 </div>
											</ul>
										</div>
									</div>
								</div>
							</div>
							   <div class="col-md-12 seatingcontent">
              	<div class="white-boxes"  style="margin-bottom:0px;border-radius:20px;">
              		<!-- <div class="row">
              			<div class="col-md-12">
              			    <ol class="breadcrumb breadcrumb-arrow">
              					<li><a href="#">Planning</a></li>
              					<li><a href="#">Invitations</a></li>
              					<li class="active"><span>Seating</span></li>
              				</ol>
              			</div>
              		</div> -->
              		<div class="row">
              			<div class="col-md-12">
              				<div class="wedbox borderless seatingmarg">
              					<div class="wedbox-title">
              						<!-- <h5 class="seatingh5">Seating</h5> -->
              						
              						<div class="wedbox-tools" style="margin-bottom:10px;">
                               
                            <button class="btn btn-primary btn-extra-padded resetbuttonstant mrgnothp">Reset Invitees </button>
                             <div class="actions blockwithbuttns" >
                        <!-- <div class="wrapperofbuttons">
                        <a href="#" class="btn btn-primary btn-extra-padded center-block autoseat">Auto-Arrangement</a>
                        <a href="#" class="formal-link" data-toggle="modal" data-target="#myModal">manually</a>
                        </div> -->
                      <div class="radiobuttonwrap">
                      	<div class="radio1wrapper"><input type="radio" id="radiobutt1" class="autoseat" name='pickerofarrange'><label for="radiobutt1">Auto-arrangement</label></div>
                      	<div class="radio2wrapper"><input type="radio" id="radiobutt2" name='pickerofarrange' class="formal-link" ><label for="radiobutt2">manually</label></div>
                      </div>
                      </div>
                        <div class="checkbox mycheckb">
                              <label>
                                <input type="checkbox" id="include_no_response" value="">
                                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                Include people with no response
                              </label>
                            </div>
              							<!-- Split button -->
                             <button class="tabletypes btn btn-primary btn-extra-padded center-block mrgnothp" style="margin-right:0px;float:right;" data-toggle="modal" data-target="#ShapeofTable">Add table types</button>
              							<div class="btn-group">
              							  <!-- <button type="button" class="btn btn-primary btn-label biggerweddingbut">Wedding</button> -->
              							  <button type="button" class="btn btn-primary dropdown-toggle arrowbuttonblock"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              							 <p>Wedding</p> <span style="margin-left:20px;" class="fa fa-chevron-down"></span>
              							    <!-- <span class="sr-only">Toggle Dropdown</span> -->
              							  </button>
              							  <ul class="dropdown-menu dropdownright" style="position: absolute;">
              							  	<li><a href="#">Engagement</a></li>
              							  	<li role="separator" class="divider"></li>
              							  	<li><a href="#">Bachelor Party</a></li>
              							  	<li><a href="#">Bachelorette</a></li>
              							  	<li role="separator" class="divider"></li>
              							  	<li><a href="#">Wedding</a></li>
              							  </ul>
              							</div>
              
              						</div>
              					</div>
              				</div>
              			</div>
              		</div>
              		<div class="row">
              			<div class="col-md-9 text-center" style="padding-right:0px;">
             
                      <div class="resizablewrapper">
                        <div id="resizablesquare" class="ui-widget-content">
                   
                                <div class="dancingstage wrapperofblock"  id="danceblock">
                                   
                                      <h3>Dancing Stage</h3>
                                    <span class="closestage"></span>
                                </div>
                                <div class="buffettable wrapperofblock"  id="buffet">
                                   
                                      <h3>Buffet Table</h3>
                                      <span class="closestage"></span>
                                </div>
                                <div class="caketable wrapperofblock"  id="cake">
                                   
                                      <h3>Cake Table</h3>
                                      <span class="closestage"></span>
                                </div>
                                <div class="gifttable wrapperofblock"  id="gift">
                                   
                                      <h3>Gift Table</h3>
                                      <span class="closestage"></span>
                                </div>
                                <div class="djtable wrapperofblock"  id="dj">
                                   
                                      <h3>DJ Table</h3>
                                      <span class="closestage"></span>
                                </div>
</div>  
                      </div>
                    
              			
              			</div>
                      <div class="col-sm-3  text-center clearfix" style="border-left: 1px solid #fbc49e">
                      
                      <div class="sidepane-controls">
                        <button class="btn btn-transparent searchicon" id="seachbutt"><i class="fa fa-search"></i></button>
                        <input type="text" class="searchinputsmall">
                        <button class="btn btn-transparent pull-right listicon"><img src="<?=Yii::getAlias('@web').'/img/sort.png'?>" alt="menubutt"></button>
                      </div>
                      <div class="invitation-list">
                        <div class="invitation-group">
                          <a role="button" data-toggle="collapse" href="#guests-accepted" aria-expanded="false" aria-controls="guests-accepted">
                            <span class="fa fa-chevron-down"></span>Accepted <span class="badge badge-count acceptedcount"></span>
                          </a>
                          <div class="collapse guestbox connectedSortable dragTable" id="guests-accepted">

                            <div class="intvitee-box invitee-seating clearfix acceptedguy" value='2'  data-id="Circle1" guest-id="1" guest-status="accepted" additional-guests="2">
                              <div class="avatar pull-left" >
                                <span class="badge badge-circle badge-success">
                                  <i class="fa fa-check"></i>
                                </span>
                                <img src="<?=Yii::getAlias('@web').'/img/invitee-avatar.jpg'?>" alt="" class="img-responsive img-circle center-block img-success" width="40">
                              </div>
                              <div class="information pull-left">
                                <p>Paul Brown <span class="badge badge-count">+2</span></p>
                                <span class="label label-default">Groom's Colleages</span>
                              </div>
                            </div>
                            
              
                            <div class="intvitee-box invitee-seating clearfix acceptedguy" data-id="Circle2" guest-id="2" guest-status="accepted">
                              <div class="avatar pull-left">
                                <span class="badge badge-circle badge-success">
                                  <i class="fa fa-check"></i>
                                </span>
                                <img src="<?=Yii::getAlias('@web').'/img/invitee-avatar.jpg'?>" alt="" class="img-responsive img-circle center-block img-success" width="40">
                              </div>
                              <div class="information pull-left">
                                <p>Paul Brown</p>
                                <span class="label label-default">Groom's Colleages</span>
                              </div>
                            </div>
                            <div class="intvitee-box invitee-seating clearfix acceptedguy" data-id="Circle3" guest-id="3" guest-status="accepted">
                              <div class="avatar pull-left">
                                <span class="badge badge-circle badge-success">
                                  <i class="fa fa-check"></i>
                                </span>
                                <img src="<?=Yii::getAlias('@web').'/img/invitee-avatar.jpg'?>" alt="" class="img-responsive img-circle center-block img-success" width="40">
                              </div>
                              <div class="information pull-left">
                                <p>Paul Brown</p>
                                <span class="label label-default">Groom's Colleages</span>
                              </div>
                            </div>
                            <div class="intvitee-box invitee-seating clearfix acceptedguy" data-id="Circle1" guest-id="4" guest-status="accepted">
                              <div class="avatar pull-left">
                                <span class="badge badge-circle badge-success">
                                  <i class="fa fa-check"></i>
                                </span>
                                <img src="<?=Yii::getAlias('@web').'/img/invitee-avatar.jpg'?>" alt="" class="img-responsive img-circle center-block img-success" width="40">
                              </div>
                              <div class="information pull-left">
                                <p>Paul Brown</p>
                                <span class="label label-default">Groom's Colleages</span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="invitation-group">
                          <a role="button" data-toggle="collapse" href="#guests-no-responded" aria-expanded="false" aria-controls="guests-no-responded">
                            <span class="fa fa-chevron-down"></span>Not Responded <span class="badge badge-count notrespondcont"></span>
                          </a>
                          <div class="collapse guestbox connectedSortable dragTable" id="guests-no-responded">
              
                            <div class="intvitee-box invitee-seating clearfix noresponseguy" data-id="Circle1" guest-id="1" guest-status="no-response">
                              <div class="avatar pull-left">
                                <span class="badge badge-circle badge-default">
                                <i class="fa fa-question"></i>
                                </span>
                                <img src="<?=Yii::getAlias('@web').'/img/invitee-avatar.jpg'?>" alt="" class="img-responsive img-circle center-block img-default" width="40">
                              </div>
                              <div class="information pull-left">
                                <p>Paul Brown</p>
                                <span class="label label-default">Groom's Colleages</span>
                              </div>
                            </div>
                              <div class="intvitee-box invitee-seating clearfix noresponseguy" data-id="Circle2" guest-id="2" guest-status="no-response">
                              <div class="avatar pull-left">
                                <span class="badge badge-circle badge-default">
                                <i class="fa fa-question"></i>
                                </span>
                                <img src="<?=Yii::getAlias('@web').'/img/invitee-avatar.jpg'?>" alt="" class="img-responsive img-circle center-block img-default" width="40">
                              </div>
                              <div class="information pull-left">
                                <p>Paul Brown</p>
                                <span class="label label-default">Groom's Colleages</span>
                              </div>
                            </div>
                            <div class="intvitee-box invitee-seating clearfix noresponseguy" data-id="Circle3" guest-id="3" guest-status="no-response">
                              <div class="avatar pull-left">
                                <span class="badge badge-circle badge-default">
                                <i class="fa fa-question"></i>
                                </span>
                                <img src="<?=Yii::getAlias('@web').'/img/invitee-avatar.jpg'?>" alt="" class="img-responsive img-circle center-block img-default" width="40">
                              </div>
                              <div class="information pull-left">
                                <p>Paul Brown</p>
                                <span class="label label-default">Groom's Colleages</span>
                              </div>
                            </div>
                            
                            <div class="intvitee-box invitee-seating clearfix noresponseguy" data-id="Circle3" guest-id='4' guest-status="no-response">
                              <div class="avatar pull-left">
                                <span class="badge badge-circle badge-default">
                                <i class="fa fa-question"></i>
                                </span>
                                <img src="<?=Yii::getAlias('@web').'/img/invitee-avatar.jpg'?>" alt="" class="img-responsive img-circle center-block img-default" width="40">
                              </div>
                              <div class="information pull-left">
                                <p>Paul Brown</p>
                                <span class="label label-default">Groom's Colleages</span>
                              </div>
                            </div>

                          </div>
                        </div>
                        <div class="invitation-group">
                          <a role="button" data-toggle="collapse" href="#guests-rejected" aria-expanded="false" aria-controls="guests-rejected">
                            <span class="fa fa-chevron-down"></span>Rejected <span class="badge badge-count rejectedcont"></span>
                          </a>
                          <div class="collapse guestbox connectedSortable dragTable" id="guests-rejected">
                            <div class="intvitee-box invitee-seating clearfix nonoguy" guest-id="7" guest-status="rejected">
                              <div class="avatar pull-left">
                                <span class="badge badge-circle badge-danger">
                                  <i class="fa fa-times"></i>
                                </span>
                                <img src="<?=Yii::getAlias('@web').'/img/invitee-avatar.jpg'?>" alt="" class="img-responsive img-circle center-block img-danger" width="40">
                              </div>
                              <div class="information pull-left">
                                <p>Paul Brown</p>
                                <span class="label label-default">Groom's Colleages</span>
                              </div>
                            </div>
                            
                            <div class="intvitee-box invitee-seating clearfix nonoguy" guest-id="8" guest-status="rejected">
                              <div class="avatar pull-left">
                                <span class="badge badge-circle badge-danger">
                                  <i class="fa fa-times"></i>
                                </span>
                                <img src="<?=Yii::getAlias('@web').'/img/invitee-avatar.jpg'?>" alt="" class="img-responsive img-circle center-block img-danger" width="40">
                              </div>
                              <div class="information pull-left">
                                <p>Paul Brown</p>
                                <span class="label label-default">Groom's Colleages</span>
                              </div>
                            </div>
                            
                            <div class="intvitee-box invitee-seating clearfix nonoguy " guest-id="9" guest-status="rejected">
                              <div class="avatar pull-left">
                                <span class="badge badge-circle badge-danger">
                                  <i class="fa fa-times"></i>
                                </span>
                                <img src="<?=Yii::getAlias('@web').'/img/invitee-avatar.jpg'?>" alt="" class="img-responsive img-circle center-block img-danger" width="40">
                              </div>
                              <div class="information pull-left">
                                <p>Paul Brown</p>
                                <span class="label label-default">Groom's Colleages</span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
              
                    </div>
              			
              		</div>
              	</div>
              </div>




						</div>
					</div>
				</div>
			</div>
		</section>

<?php
yii\bootstrap\Modal::begin([


    'id' => 'modal',
//    'size' => 'modal-lg',
    'closeButton' => [],
    
    //keeps from closing modal with esc key or by clicking out of the modal.
    // user must click cancel or  to close
    'options' => ['class' => 'manually-modal','tabindex' => false]
]);
echo "<div id='manuallyModal' tabindex='-1' role='dialog'></div>";
yii\bootstrap\Modal::end();
?>
<?php
$Webb = Yii::getAlias('@web');
$this->registerJs(<<<JS
$(function(){
    //get the click of modal button to create / update item
    //we get the button by class not by ID because you can only have one id on a page and you can
    //have multiple classes therefore you can have multiple open modal buttons on a page all with or without
    //the same link.
//we use on so the dom element can be called again if they are nested, otherwise when we load the content once it kills the dom element and wont let you load anther modal on click without a page refresh
      $(document).on('click', '.showModalButton', function(){
          
          
         //check if the modal is open. if it's open just reload content not whole modal
        //also this allows you to nest buttons inside of modals to reload the content it is in
        //the if else are intentionally separated instead of put into a function to get the 
        //button since it is using a class not an #id so there are many of them and we need
        //to ensure we get the right button and content. 
        if ($('#modal').data('bs.modal').isShown) {
            $('#modal').find('#manuallyModal')
                    .load($(this).attr('value'));
            //dynamiclly set the header for the modal
//            document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        } else {
            //if modal isn't open; open it and load content
            $('#modal').modal('show')
                    .find('#manuallyModal')
                    .load($(this).attr('value'));
             //dynamiclly set the header for the modal
//            document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        }
    });
});

         function GetDownload() {
        $.post("$Webb/seating-invitees/download",
                {
                },
                function (data, status) {

                    var link = document.createElement("a");
                    link.download = "Invitee Template.xlsm";
                    link.href = "$Webb/Testing.xlsm";
                    link.click();
                });
}
    
   $('#UploadB').click(function(event) {
  $('#UploadFileEx').click();
});
   
   
      $("#UploadFileEx").change(function (){
        var formData = new FormData($('#UploadForm')[0]);
        
   
    console.log(formData);
    $.ajax({
        url: "$Webb/seating-invitees/upload-excel-file",  //Server script to process data
        type: 'POST',
        // Form data
        data: formData,
        success: function(response) {
          $('#InviteesPjax').load('$Webb/seating-invitees/after-adding-manually-invitee');
        $('#Statics').load('$Webb/seating-invitees/after-any-changes-statistics-invitee');
        $('#RealInviteeNumber').html(response.NumberOfInv);
        },

        error: function(){
            $('#InviteesPjax').load('$Webb/seating-invitees/after-adding-manually-invitee');
        $('#Statics').load('$Webb/seating-invitees/after-any-changes-statistics-invitee');
        
        },


        //Options to tell jQuery not to process data or worry about content-type.
        cache: false,
        contentType: false,
        processData: false
    });
});    
JS
);
?>