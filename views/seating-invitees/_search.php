 <?php
                                                                                            if($Invitees!=null && sizeof($Invitees->getModels())>0){
                                                                                                    
                                                                                                    
                                                                                                   
                                                                                                    $Invitees=$Invitees->getModels();
                                                                                                    if($Invitees!=null &&  sizeof($Invitees)>0){
                                                                                                        foreach($Invitees as $invitee){
                                                                                                            if($invitee->INVITEE_RESPONSE=='A'){
                                                                                                                ?>
                                                                                                                <li class="list-people-body clearfix firstclassperson">
													<div class="l-input">
														<label for="list-1">
															<input type="checkbox" class="custom-checkbox" id="list-1" >
															<i class="l-overlay"></i>
															<span class="label-checkbox"></span>
														</label>
													</div>
													<div class="l-guests ">
														<div class="wrapperofimgguest">
															<img src="<?= $invitee->INVITEE_PIC!=null ?Yii::getAlias('@web').'/'.$invitee->INVITEE_PIC: Yii::getAlias('@web').'/img/emptypic.jpg' ?>" alt="" class="img-avatar">
														</div>
														<div class="people-info">
															<p class="name fontsanslight"><?=$invitee->FIRST_INVITEE_NAME?></p>
															<div class="info">
                                                                                                                              
                                                                                                                            <a href="" class="p-phone <?= $invitee->PHONE!=null ? "active" : ""?>" data-toggle="tooltip" data-placement="top" title="Tooltip on top"><img src="<?=Yii::getAlias('@web').'/img/icons/call-answer.png'?>" alt=""></a>
                                                                                                                               
																<a href="" class="p-email <?= $invitee->INVITEE_EMAIL!=null ? "active" : ""?>" data-toggle="tooltip" data-placement="top" title="Tooltip on top"><img src="<?=Yii::getAlias('@web').'/img/icons/message.png'?>" alt=""></a>
																<a href="" class="p-address <?= $invitee->ADDRESS!=null ? "active" : ""?>" data-toggle="tooltip" data-placement="top" title=""><img src="<?=Yii::getAlias('@web').'/img/icons/home.png'?>" alt=""></a>
																<a href="" class="p-comment <?= $invitee->NOTE!=null ? "active" : ""?>" data-toggle="tooltip" data-placement="top" title=""><img src="<?=Yii::getAlias('@web').'/img/icons/book.png'?>" alt=""></a>
															</div>
                                                                                                                         <?php 
                                                                                                                      
                                                                                                                      $GuestCount=0;
                                                                                                                      if($invitee->inviteeGuests!=null && sizeof($invitee->inviteeGuests)>0){
                                                                                                                         $GuestCount= sizeof($invitee->inviteeGuests);
                                                                                                                      }
                                                                                                                      
                                                                                                                      if($GuestCount!=0){
                                                                                                                          ?>
                                                                                                                        <div class="badge badgeLightBlue" data-toggle="collapse" data-target="#informationInvitee<?=$invitee->INVITEE_ID?>">+<?=$GuestCount?></div>
                                                                                                                        <?php
                                                                                                                      }
                                                                                                                          ?>
															
														</div>
													</div>
													<div class="l-events fontsanslight">
                                                                                                            <?php if($invitee->inviteeEvents!=null && sizeof($invitee->inviteeEvents)>0){
                                                                                                                    $p=0;
                                                                                                                    foreach($invitee->inviteeEvents as $Events){
                                                                                                                       
                                                                                                                            ?>
                                                                                                                            <p class="EventsBorder"><?=$Events->eVENT->weddingEventTranslations[0]->wedding_event_VALUE?> <img src="<?=Yii::getAlias('@web').'/img/xmark.png'?>" class="xmark" alt=""></p> 
                                                                                                                          
                                                                                                                                <?php
                                                                                                                        
                                                                                                                    ?>
                                                                                                                   
                                                                                                                    <?php $p++;}}?>
														
														
													</div>
													<div class="l-circles fontsansreg">
														<p><?php if($invitee->iNVITEECIRCLE!=null){
                                                                                                                    $p=0;
                                                                                                                   
                                                                                                                      
                                                                                                                            ?>
                                                                                                                            <?=$invitee->iNVITEECIRCLE->inviteesCirclesTrans[0]->INVITEE_CIRCLE_TRANS?>
                                                                                                                                
                                                                                                                   
                                                                                                                    <?php }?></p>
													</div>
													<div class="l-place-with fontsansreg">
														<p>
                                                                                                                    <?php if($invitee->iNVITEEPLACEWITH!=null && sizeof($invitee->iNVITEEPLACEWITH)>0){
                                                                                                                    
                                                                                                                    
                                                                                                                            ?>
                                                                                                                            <?=$invitee->iNVITEEPLACEWITH->inviteesPlaceWithTrans[0]->INVITEE_PALCE_WITH_VALUE?>
                                                                                                                           
                                                                                                                   
                                                                                                                <?php } ?>
                                                                                                                </p>
													</div>
													<div class="l-invitation fontsansreg">
                                                                                                            
                                                                                                            <?php
                                                                                                            if($invitee->inviteeSendCartBies!=null && sizeof($invitee->inviteeSendCartBies)>0){
                                                                                                              $p=0;
                                                                                                                    foreach($invitee->inviteeSendCartBies as $InviteBy){
                                                                                                                    
                                                                                                                            ?>
                                                                                                                         <p class="EventsBorder"><?=$InviteBy->sENDCARTBY->sendCartByTrans[0]->SEND_CART_BY_NAME?> <img src="<?=Yii::getAlias('@web').'/img/xmark.png'?>" class="xmark" alt=""></p>
                                                                                                                        
                                                                                                                       
                                                                                                                   
                                                                                                                    <?php $p++;}}?>  
														
													</div>
													<div class="l-action">
														<button><span class="ws-ws_edit"></span></button>
														<button><span class="ws-ws_delete"></span></button>
													</div>
                                                                                                    
                                                                                                   <?php if($invitee->inviteeGuests!=null && sizeof($invitee->inviteeGuests)>0){
                                                                                                                 
                                                                                                                 ?>
													<div class="information-invitee collapse" id="informationInvitee<?=$invitee->INVITEE_ID?>">
                                                                                                             <?php foreach($invitee->inviteeGuests as $Guest){ ?>
														<div class="guestRow clearfix">
															<div class="guest-name fontsanslight">
																<p><?=$Guest->GUEST_NAME?></p>
															</div>
															<div class="guest-event fontsanslight">
                                                                                                                            <p>Should be Fix</p>
															</div>
															<div class="guest-circle fontsansreg">
																<p><?=$Guest->CIRLE_ID!=null && $Guest->cIRLE!=null && $Guest->cIRLE->inviteesCirclesTrans!=null && sizeof($Guest->cIRLE->inviteesCirclesTrans)>0 ?$Guest->cIRLE->inviteesCirclesTrans[0]->INVITEE_CIRCLE_TRANS:"" ?></p>
															</div>
															<div class="guest-place-with fontsansreg">
																<p><?=$Guest->PLACE_WITH!=null && $Guest->pLACEWITH!=null && $Guest->pLACEWITH->inviteesPlaceWithTrans!=null && sizeof($Guest->pLACEWITH->inviteesPlaceWithTrans)>0 ?$Guest->pLACEWITH->inviteesPlaceWithTrans[0]->INVITEE_PALCE_WITH_VALUE:"" ?></p>
															</div>
															<div class="guest-invitation fontsansreg">
																<p>Invitation</p>
															</div>
														</div>
                                                                                                            <?php }?>
														
													 </div>
                                                                                                   <?php } ?>
                                                                                                           
												</li>
                                                                                                <?php
                                                                                                            }
                                                                                                            if($invitee->INVITEE_RESPONSE=='N'){
                                                                                                                ?>
                                                                                                               <li class="list-people-body clearfix secclassperson">
													<div class="l-input">
														<label for="list-1">
															<input type="checkbox" class="custom-checkbox" id="list-1" >
															<i class="l-overlay"></i>
															<span class="label-checkbox"></span>
														</label>
													</div>
													<div class="l-guests ">
														<div class="wrapperofimgguestblue">
															<img src="<?= $invitee->INVITEE_PIC!=null ?Yii::getAlias('@web').'/'.$invitee->INVITEE_PIC: Yii::getAlias('@web').'/img/emptypic.jpg' ?>" alt="" class="img-avatar">
														</div>
														<div class="people-info">
															<p class="name fontsanslight"><?=$invitee->FIRST_INVITEE_NAME?></p>
															<div class="info">
                                                                                                                              
                                                                                                                            <a href="" class="p-phone <?= $invitee->PHONE!=null ? "active" : ""?>" data-toggle="tooltip" data-placement="top" title="Tooltip on top"><img src="<?=Yii::getAlias('@web').'/img/icons/call-answerblue.png'?>" alt=""></a>
                                                                                                                               
																<a href="" class="p-email <?= $invitee->INVITEE_EMAIL!=null ? "active" : ""?>" data-toggle="tooltip" data-placement="top" title="Tooltip on top"><img src="<?=Yii::getAlias('@web').'/img/icons/messageblue.png'?>" alt=""></a>
																<a href="" class="p-address <?= $invitee->ADDRESS!=null ? "active" : ""?>" data-toggle="tooltip" data-placement="top" title=""><img src="<?=Yii::getAlias('@web').'/img/icons/homeblue.png'?>" alt=""></a>
																<a href="" class="p-comment <?= $invitee->NOTE!=null ? "active" : ""?>" data-toggle="tooltip" data-placement="top" title=""><img src="<?=Yii::getAlias('@web').'/img/icons/bookblue.png'?>" alt=""></a>
															</div>
                                                                                                                         <?php 
                                                                                                                      
                                                                                                                      $GuestCount=0;
                                                                                                                      if($invitee->inviteeGuests!=null && sizeof($invitee->inviteeGuests)>0){
                                                                                                                         $GuestCount= sizeof($invitee->inviteeGuests);
                                                                                                                      }
                                                                                                                      
                                                                                                                      if($GuestCount!=0){
                                                                                                                          ?>
                                                                                                                        <div class="badge badgeLightBlue" data-toggle="collapse" data-target="#informationInvitee<?=$invitee->INVITEE_ID?>">+<?=$GuestCount?></div>
                                                                                                                        <?php
                                                                                                                      }
                                                                                                                          ?>
															
														</div>
													</div>
													<div class="l-events fontsanslight">
                                                                                                            <?php if($invitee->inviteeEvents!=null && sizeof($invitee->inviteeEvents)>0){
                                                                                                                    $p=0;
                                                                                                                    foreach($invitee->inviteeEvents as $Events){
                                                                                                                       
                                                                                                                            ?>
                                                                                                                            <p class="EventsBorder"><?=$Events->eVENT->weddingEventTranslations[0]->wedding_event_VALUE?> <img src="<?=Yii::getAlias('@web').'/img/xmark.png'?>" class="xmark" alt=""></p> 
                                                                                                                          
                                                                                                                                <?php
                                                                                                                        
                                                                                                                    ?>
                                                                                                                   
                                                                                                                    <?php $p++;}}?>
														
														
													</div>
													<div class="l-circles fontsansreg">
														<p><?php if($invitee->iNVITEECIRCLE!=null){
                                                                                                                    $p=0;
                                                                                                                   
                                                                                                                      
                                                                                                                            ?>
                                                                                                                            <?=$invitee->iNVITEECIRCLE->inviteesCirclesTrans[0]->INVITEE_CIRCLE_TRANS?>
                                                                                                                                
                                                                                                                   
                                                                                                                    <?php }?></p>
													</div>
													<div class="l-place-with fontsansreg">
														<p>
                                                                                                                    <?php if($invitee->iNVITEEPLACEWITH!=null && sizeof($invitee->iNVITEEPLACEWITH)>0){
                                                                                                                    
                                                                                                                    
                                                                                                                            ?>
                                                                                                                            <?=$invitee->iNVITEEPLACEWITH->inviteesPlaceWithTrans[0]->INVITEE_PALCE_WITH_VALUE?>
                                                                                                                           
                                                                                                                   
                                                                                                                <?php } ?>
                                                                                                                </p>
													</div>
													<div class="l-invitation fontsansreg">
                                                                                                            
                                                                                                            <?php
                                                                                                            if($invitee->inviteeSendCartBies!=null && sizeof($invitee->inviteeSendCartBies)>0){
                                                                                                              $p=0;
                                                                                                                    foreach($invitee->inviteeSendCartBies as $InviteBy){
                                                                                                                    
                                                                                                                            ?>
                                                                                                                         <p class="EventsBorder"><?=$InviteBy->sENDCARTBY->sendCartByTrans[0]->SEND_CART_BY_NAME?> <img src="<?=Yii::getAlias('@web').'/img/xmark.png'?>" class="xmark" alt=""></p>
                                                                                                                        
                                                                                                                       
                                                                                                                   
                                                                                                                    <?php $p++;}}?>  
														
													</div>
													<div class="l-action">
														<button><span class="ws-ws_edit"></span></button>
														<button><span class="ws-ws_delete"></span></button>
													</div>
                                                                                                    
                                                                                                   <?php if($invitee->inviteeGuests!=null && sizeof($invitee->inviteeGuests)>0){
                                                                                                                 
                                                                                                                 ?>
													<div class="information-invitee collapse" id="informationInvitee<?=$invitee->INVITEE_ID?>">
                                                                                                             <?php foreach($invitee->inviteeGuests as $Guest){ ?>
														<div class="guestRow clearfix">
															<div class="guest-name fontsanslight">
																<p><?=$Guest->GUEST_NAME?></p>
															</div>
															<div class="guest-event fontsanslight">
                                                                                                                            <p>Should be Fix</p>
															</div>
															<div class="guest-circle fontsansreg">
																<p><?=$Guest->CIRLE_ID!=null && $Guest->cIRLE!=null && $Guest->cIRLE->inviteesCirclesTrans!=null && sizeof($Guest->cIRLE->inviteesCirclesTrans)>0 ?$Guest->cIRLE->inviteesCirclesTrans[0]->INVITEE_CIRCLE_TRANS:"" ?></p>
															</div>
															<div class="guest-place-with fontsansreg">
																<p><?=$Guest->PLACE_WITH!=null && $Guest->pLACEWITH!=null && $Guest->pLACEWITH->inviteesPlaceWithTrans!=null && sizeof($Guest->pLACEWITH->inviteesPlaceWithTrans)>0 ?$Guest->pLACEWITH->inviteesPlaceWithTrans[0]->INVITEE_PALCE_WITH_VALUE:"" ?></p>
															</div>
															<div class="guest-invitation fontsansreg">
																<p>Invitation</p>
															</div>
														</div>
                                                                                                            <?php }?>
														
													 </div>
                                                                                                   <?php } ?>
                                                                                                           
												</li>
                                                                                                <?php
                                                                                                            }
                                                                                                            if($invitee->INVITEE_RESPONSE=='R'){
                                                                                                                ?>
                                                                                                               <li class="list-people-body clearfix thirdclassperson">
													<div class="l-input">
														<label for="list-1">
															<input type="checkbox" class="custom-checkbox" id="list-1" >
															<i class="l-overlay"></i>
															<span class="label-checkbox"></span>
														</label>
													</div>
													<div class="l-guests ">
														<div class="wrapperofimgguestred">
															<img src="<?= $invitee->INVITEE_PIC!=null ?Yii::getAlias('@web').'/'.$invitee->INVITEE_PIC: Yii::getAlias('@web').'/img/emptypic.jpg' ?>" alt="" class="img-avatar">
														</div>
														<div class="people-info">
															<p class="name fontsanslight"><?=$invitee->FIRST_INVITEE_NAME?></p>
															<div class="info">
                                                                                                                              
                                                                                                                            <a href="" class="p-phone <?= $invitee->PHONE!=null ? "active" : ""?>" data-toggle="tooltip" data-placement="top" title="Tooltip on top"><img src="<?=Yii::getAlias('@web').'/img/icons/call-answerred.png'?>" alt=""></a>
                                                                                                                               
																<a href="" class="p-email <?= $invitee->INVITEE_EMAIL!=null ? "active" : ""?>" data-toggle="tooltip" data-placement="top" title="Tooltip on top"><img src="<?=Yii::getAlias('@web').'/img/icons/messagered.png'?>" alt=""></a>
																<a href="" class="p-address <?= $invitee->ADDRESS!=null ? "active" : ""?>" data-toggle="tooltip" data-placement="top" title=""><img src="<?=Yii::getAlias('@web').'/img/icons/homered.png'?>" alt=""></a>
																<a href="" class="p-comment <?= $invitee->NOTE!=null ? "active" : ""?>" data-toggle="tooltip" data-placement="top" title=""><img src="<?=Yii::getAlias('@web').'/img/icons/bookred.png'?>" alt=""></a>
															</div>
                                                                                                                         <?php 
                                                                                                                      
                                                                                                                      $GuestCount=0;
                                                                                                                      if($invitee->inviteeGuests!=null && sizeof($invitee->inviteeGuests)>0){
                                                                                                                         $GuestCount= sizeof($invitee->inviteeGuests);
                                                                                                                      }
                                                                                                                      
                                                                                                                      if($GuestCount!=0){
                                                                                                                          ?>
                                                                                                                        <div class="badge badgeLightBlue" data-toggle="collapse" data-target="#informationInvitee<?=$invitee->INVITEE_ID?>">+<?=$GuestCount?></div>
                                                                                                                        <?php
                                                                                                                      }
                                                                                                                          ?>
															
														</div>
													</div>
													<div class="l-events fontsanslight">
                                                                                                            <?php if($invitee->inviteeEvents!=null && sizeof($invitee->inviteeEvents)>0){
                                                                                                                    $p=0;
                                                                                                                    foreach($invitee->inviteeEvents as $Events){
                                                                                                                       
                                                                                                                            ?>
                                                                                                                            <p class="EventsBorder"><?=$Events->eVENT->weddingEventTranslations[0]->wedding_event_VALUE?> <img src="<?=Yii::getAlias('@web').'/img/xmark.png'?>" class="xmark" alt=""></p> 
                                                                                                                          
                                                                                                                                <?php
                                                                                                                        
                                                                                                                    ?>
                                                                                                                   
                                                                                                                    <?php $p++;}}?>
														
														
													</div>
													<div class="l-circles fontsansreg">
														<p><?php if($invitee->iNVITEECIRCLE!=null){
                                                                                                                    $p=0;
                                                                                                                   
                                                                                                                      
                                                                                                                            ?>
                                                                                                                            <?=$invitee->iNVITEECIRCLE->inviteesCirclesTrans[0]->INVITEE_CIRCLE_TRANS?>
                                                                                                                                
                                                                                                                   
                                                                                                                    <?php }?></p>
													</div>
													<div class="l-place-with fontsansreg">
														<p>
                                                                                                                    <?php if($invitee->iNVITEEPLACEWITH!=null && sizeof($invitee->iNVITEEPLACEWITH)>0){
                                                                                                                    
                                                                                                                    
                                                                                                                            ?>
                                                                                                                            <?=$invitee->iNVITEEPLACEWITH->inviteesPlaceWithTrans[0]->INVITEE_PALCE_WITH_VALUE?>
                                                                                                                           
                                                                                                                   
                                                                                                                <?php } ?>
                                                                                                                </p>
													</div>
													<div class="l-invitation fontsansreg">
                                                                                                            
                                                                                                            <?php
                                                                                                            if($invitee->inviteeSendCartBies!=null && sizeof($invitee->inviteeSendCartBies)>0){
                                                                                                              $p=0;
                                                                                                                    foreach($invitee->inviteeSendCartBies as $InviteBy){
                                                                                                                    
                                                                                                                            ?>
                                                                                                                         <p class="EventsBorder"><?=$InviteBy->sENDCARTBY->sendCartByTrans[0]->SEND_CART_BY_NAME?> <img src="<?=Yii::getAlias('@web').'/img/xmark.png'?>" class="xmark" alt=""></p>
                                                                                                                        
                                                                                                                       
                                                                                                                   
                                                                                                                    <?php $p++;}}?>  
														
													</div>
													<div class="l-action">
														<button><span class="ws-ws_edit"></span></button>
														<button><span class="ws-ws_delete"></span></button>
													</div>
                                                                                                    
                                                                                                   <?php if($invitee->inviteeGuests!=null && sizeof($invitee->inviteeGuests)>0){
                                                                                                                 
                                                                                                                 ?>
													<div class="information-invitee collapse" id="informationInvitee<?=$invitee->INVITEE_ID?>">
                                                                                                             <?php foreach($invitee->inviteeGuests as $Guest){ ?>
														<div class="guestRow clearfix">
															<div class="guest-name fontsanslight">
																<p><?=$Guest->GUEST_NAME?></p>
															</div>
															<div class="guest-event fontsanslight">
                                                                                                                            <p>Should be Fix</p>
															</div>
															<div class="guest-circle fontsansreg">
																<p><?=$Guest->CIRLE_ID!=null && $Guest->cIRLE!=null && $Guest->cIRLE->inviteesCirclesTrans!=null && sizeof($Guest->cIRLE->inviteesCirclesTrans)>0 ?$Guest->cIRLE->inviteesCirclesTrans[0]->INVITEE_CIRCLE_TRANS:"" ?></p>
															</div>
															<div class="guest-place-with fontsansreg">
																<p><?=$Guest->PLACE_WITH!=null && $Guest->pLACEWITH!=null && $Guest->pLACEWITH->inviteesPlaceWithTrans!=null && sizeof($Guest->pLACEWITH->inviteesPlaceWithTrans)>0 ?$Guest->pLACEWITH->inviteesPlaceWithTrans[0]->INVITEE_PALCE_WITH_VALUE:"" ?></p>
															</div>
															<div class="guest-invitation fontsansreg">
																<p>Invitation</p>
															</div>
														</div>
                                                                                                            <?php }?>
														
													 </div>
                                                                                                   <?php } ?>
                                                                                                           
												</li>
                                                                                                <?php
                                                                                                            }
                                                                                                            ?>
                                                                                                         
												
                                                                                                    <?php
                                                                                                
                                                                                                        }
                                                                                                    }
                                                                                                }
                                                                                                ?>