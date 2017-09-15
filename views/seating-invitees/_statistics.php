<?php if($numberOfInvitees==0)
                                                                                 { ?>
                                
                          
										<div class="statistic-circle hidden-xs hidden-sm col-md-9">
											<div class="statistic statistic-danger circle-size-2 fontsanslightS">2</div>
											<div class="statistic statistic-warning circle-size-3 fontsanslightS">3</div>
											<div class="statistic statistic-success circle-size-4 fontsanslightS">4</div>
											<div class="statistic statistic-primary circle-size-1 fontsanslightS">1</div>
                                                                                        
										</div>
                                                                            <div class="" style="position: relative;text-align: center;font-size: larger;color:red;">Template</div>
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
										</div>
									
                                
                                <?php }
                                else{?>
                                
                                <div class="statistic-circle hidden-xs hidden-sm col-md-9">

                                    <?php
                                    $CircleIDArray = [];
                                    $CircleValuesArray = [];
                                    $CircleValuesCounterArray = [];
                                    $p = 0;
                                    if (isset($Invitees) && $Invitees != null) {
                                        $Inviteess = $Invitees->getModels();
                                        if ($Inviteess != null && sizeof($Inviteess) > 0) {

                                            foreach ($Inviteess as $invitee) {


                                                if ($invitee->INVITEE_CIRCLE_ID != null && !in_array($invitee->INVITEE_CIRCLE_ID, $CircleIDArray)) {
                                                    $CircleIDArray[$p] = $invitee->INVITEE_CIRCLE_ID;
                                                    $CircleValuesArray[$p] = $invitee->iNVITEECIRCLE->inviteesCirclesTrans[0]->INVITEE_CIRCLE_TRANS;
                                                    
                                                    $p++;
                                                }
                                                $Co = 0;
                                                    if ($invitee->iNVITEECIRCLE!=null &&$invitee->iNVITEECIRCLE->inviteesCirclesTrans!=null && sizeof($invitee->iNVITEECIRCLE->inviteesCirclesTrans)>0 &&  isset($CircleValuesCounterArray[$invitee->iNVITEECIRCLE->inviteesCirclesTrans[0]->INVITEE_CIRCLE_TRANS]) && $CircleValuesCounterArray[$invitee->iNVITEECIRCLE->inviteesCirclesTrans[0]->INVITEE_CIRCLE_TRANS] != null) {
                                                        $Co = $CircleValuesCounterArray[$invitee->iNVITEECIRCLE->inviteesCirclesTrans[0]->INVITEE_CIRCLE_TRANS];
                                                        
                                                    }
                                                    if($invitee->iNVITEECIRCLE!=null && $invitee->iNVITEECIRCLE->inviteesCirclesTrans!=null && sizeof($invitee->iNVITEECIRCLE->inviteesCirclesTrans)>0){
                                                    $CircleValuesCounterArray[$invitee->iNVITEECIRCLE->inviteesCirclesTrans[0]->INVITEE_CIRCLE_TRANS] = $Co + 1;
                                                    }
                                                if ($invitee->inviteeGuests != null && sizeof($invitee->inviteeGuests) > 0) {
                                                    foreach ($invitee->inviteeGuests as $Guest) {

                                                        if ($Guest->CIRLE_ID != null && !in_array($Guest->CIRLE_ID, $CircleIDArray)) {
                                                            $CircleIDArray[$p] = $Guest->CIRLE_ID;
                                                            $CircleValuesArray[$p] = $Guest->cIRLE->inviteesCirclesTrans[0]->INVITEE_CIRCLE_TRANS;
                                                            
                                                            $p++;
                                                        }
                                                        $Co = 0;
                                                            if ( $invitee->iNVITEECIRCLE!=null &&$invitee->iNVITEECIRCLE->inviteesCirclesTrans!=null && sizeof($invitee->iNVITEECIRCLE->inviteesCirclesTrans)>0 && isset($CircleValuesCounterArray[$Guest->cIRLE->inviteesCirclesTrans[0]->INVITEE_CIRCLE_TRANS]) && $CircleValuesCounterArray[$Guest->cIRLE->inviteesCirclesTrans[0]->INVITEE_CIRCLE_TRANS] != null) {
                                                                $Co = $CircleValuesCounterArray[$Guest->cIRLE->inviteesCirclesTrans[0]->INVITEE_CIRCLE_TRANS];
                                                                 
                                                            }
                                                            if($Guest->cIRLE!=null && $Guest->cIRLE->inviteesCirclesTrans!=null && sizeof($Guest->cIRLE->inviteesCirclesTrans)>0){
                                                            $CircleValuesCounterArray[$Guest->cIRLE->inviteesCirclesTrans[0]->INVITEE_CIRCLE_TRANS] = intval($Co) + 1;
                                                            }
                                                           
                                                    }
                                                }
                                            }
                                        }
                                    }
                                 
//$numberOfInvitees
                                    $BackGroundColors=['background: rgba(232, 124, 100, 0.9);','background: rgba(122, 165, 240, 0.9);','background: rgba(243, 216, 117, 0.9);','background: rgba(192, 213, 129, 0.9);','background: rgba(220, 124, 190, 0.9);'];
                                    $BackGroundCountetr= sizeof($BackGroundColors);
                                      $DD=0;
                                                                        if ($CircleValuesArray != null && sizeof($CircleValuesArray) > 0) {
                                        for ($i = 0; $i < sizeof($CircleValuesArray); $i++) {
                                            
                                            if($BackGroundCountetr==($i-1)){
                                             $DD=0;   
                                            }else{
                                              $DD++;  
                                            }
//                                            $CircleValuesCounterArray
                                            
                                            $CirleBy=intval(isset($CircleValuesCounterArray[$CircleValuesArray[$i]]) ?$CircleValuesCounterArray[$CircleValuesArray[$i]]:'0');
                                            $perc=($CirleBy*100)/$numberOfInvitees;
                                            ?>
                                            <div class="statistic fontsanslightS" style="<?=$BackGroundColors[$DD]?> width: <?=$perc*5?>px;height: <?=$perc*5?>px;font-size: <?=(50*$perc)/100?>px;word-wrap: break-word;line-height:<?=($perc*5)/2?>px; z-index: 2;"><?=''.intval($perc).'%'?></div>
                                            <?php
                                        }
                                    }
                                    ?>
                                        <!--
                                        
                                        
                                       
                                        -->
<!--                                    <div class="statistic statistic-danger circle-size-2">2</div>
                                    <div class="statistic statistic-warning circle-size-3">3</div>
                                    <div class="statistic statistic-success circle-size-4">4</div>
                                    <div class="statistic statistic-primary circle-size-1">1</div>-->
                                </div>
                                <div class="statistic-rectangle pullRight col-sm-4 col-md-3" style="min-height: 200px;">
                                    <?php
                                    $DD=0;
                                    if ($CircleValuesArray != null && sizeof($CircleValuesArray) > 0) {
                                        for ($i = 0; $i < sizeof($CircleValuesArray); $i++) {
                                            if($BackGroundCountetr==($i-1)){
                                             $DD=0;   
                                            }else{
                                              $DD++;  
                                            }
                                            ?>  
                                    <div class="statistic  fontsanslight" style="<?=$BackGroundColors[$DD]?>text-align : left;">
                                               <?=isset($CircleValuesCounterArray[$CircleValuesArray[$i]]) ?$CircleValuesCounterArray[$CircleValuesArray[$i]]:'0'?><?=" "?><?=$CircleValuesArray[$i]?>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <?php }?>