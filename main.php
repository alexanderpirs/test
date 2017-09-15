<?php

use yii\helpers\Html;
?>
<?php

use app\assets\AppAsset;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
$this->registerJsFile('/js/min/lnst.min.js'); 
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
       

        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
        <?php $this->head() ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
        <title>Online contract signature · SMS·Notification · LLeida.net</title>

        <meta name="description" content="The first electronic communications operator - Registered electronic messages">
        <meta name="keywords" content="fax on line, registered email, online contract, registered sms, sms, email">
        <meta charset="utf-8">
        <meta name="author" content="Eduard Salla">
        <meta name="Content-Security-Policy" value="ALLOW-FROM https://www.clubcdex.com/" />
        <meta name="google-site-verification" content="HzDXSP1oiQxN08vhPxpO0Ud8XLGiN96h2ZQ61UEc1hY" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <meta name="apple-mobile-web-app-capable" content="yes">

        <link rel="apple-touch-icon" sizes="180x180" href="/img/favicon/verifpost.jpg">
        <link rel="icon" type="image/png" href="/img/favicon/verifpost.jpg" sizes="32x32">
        <link rel="icon" type="image/png" href="/img/favicon/verifpost.jpg" sizes="16x16">
        <link rel="manifest" href="/img/favicon/manifest.json">
        <link rel="mask-icon" href="/img/favicon/verifpost.jpg" color="#5bbad5">
        <link rel="shortcut icon" href="/img/favicon/verifpost.jpg">
        <meta name="msapplication-TileColor" content="#2d89ef">
        <meta name="msapplication-TileImage" content="/img/favicon/verifpost.jpg">
        <meta name="msapplication-config" content="/img/favicon/browserconfig.xml">
        <meta name="theme-color" content="#ffffff">

        <meta property="og:title" content="Online contract signature · SMS·Notification · LLeida.net" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="https://www.lleida.net/en/" />
        <meta property="og:image" content="http://www.lleida.net/img/xs/og/sms-eNotification-eContracting.png?20170504105357" />

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@lleidanet">
        <meta name="twitter:creator" content="@lleidanet">
        <meta name="twitter:title" content="Online contract signature · SMS·Notification · LLeida.net">
        <meta name="twitter:description" content="The first electronic communications operator - Registered electronic messages">
        <meta name="twitter:image" content="http://www.lleida.net/img/xs/twitter/sms-eNotification-eContracting.png?20170504105357">

        <meta property="og:site_name" content="Online contract signature · SMS·Notification · LLeida.net">
        <meta property="og:description" content="The first electronic communications operator - Registered electronic messages" />
        <meta property="og:locale" content="en_GB" />
        <meta property="fb:app_id" content="1803216716629207" />

        <link rel="canonical" href="index.html" />
        <link rel="alternate" href="../ca/index.html" hreflang="ca" />
        <link rel="alternate" href="index.html" hreflang="en" />
        <link rel="alternate" href="../es/index.html" hreflang="es" />
        <link rel="alternate" href="../fr/index.html" hreflang="fr" />
        <link rel="alternate" href="../pt/index.html" hreflang="pt" />


    </head>

    <body>

        <div id="pageloader">
            <div class="loader-item">
                <img src="/img/other/puff.svg" alt="page loader">
            </div>
        </div>
        <a href="#page-top" class="go-to-top">
            <i class="icon-cap-amunt"></i>
        </a>

        <nav class="navbar navbar-pasific navbar-mp megamenu navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle border-dark" data-toggle="collapse" data-target=".navbar-main-collapse">
                        <i class="icon-menu color-dark"></i>
                    </button>
                    <a class="navbar-brand page-scroll " href="<?=Url::to(['site/index'])?>" style="padding-top: 0px;padding-bottom: 0px;">
                        <img src="/img/logos/VERIFPOST_BLUE.jpg" alt="logo" class="logo-color" style="width: 100px;">
                        <!--<img src="/img/logos/logo-lleidanet-blanc.png" alt="logo" class="logo-blanc">-->
                    </a>
                </div>
                <div class="navbar-collapse collapse navbar-main-collapse">
                    <ul class="nav navbar-nav">
                        <li class="dropdown megamenu-fw has-dropdown-menu"><a href="#" data-toggle="dropdown" class="dropdown-toggle color-dark ">Digital Notification and contracting</a>
                            <ul class="dropdown-menu fullwidth2">
                                <li class="megamenu-content withoutdesc">
                                    <div class="row">
                                        <div class="col-sm-4 col-sm-offset-1">
                                            <h3 class="title text-uppercase color-light alpha7">Notification</h3>
                                            <ul>
                                                <li><a href="<?=Url::to(['site/registered-email'])?>" id="" class="" onclick="dataLayer.push({ & #39; category & #39; : & #39; Conversion & #39; , & #39; action & #39; : & #39; Nou_menu & #39; , & #39; label & #39; : & #39; Email_certificat & #39; , & #39; event & #39; : & #39; eventga & #39; });">Registered email</a></li>
                                                <li><a href="<?=Url::to(['site/registered-sms'])?>" id="" class="" onclick="dataLayer.push({ & #39; category & #39; : & #39; Conversion & #39; , & #39; action & #39; : & #39; Nou_menu & #39; , & #39; label & #39; : & #39; SMS_certificat & #39; , & #39; event & #39; : & #39; eventga & #39; });">Registered SMS</a></li>
                                                <li><a href="<?=Url::to(['site/invoice'])?>" id="" class="" onclick="dataLayer.push({ & #39; category & #39; : & #39; Conversion & #39; , & #39; action & #39; : & #39; Nou_menu & #39; , & #39; label & #39; : & #39; Factura & #39; , & #39; event & #39; : & #39; eventga & #39; });">Registered invoice</a></li>
                                                <li><a href="<?=Url::to(['site/registered-delivery'])?>" id="" class="" onclick="dataLayer.push({ & #39; category & #39; : & #39; Conversion & #39; , & #39; action & #39; : & #39; Nou_menu & #39; , & #39; label & #39; : & #39; Recepcio & #39; , & #39; event & #39; : & #39; eventga & #39; });">Registered inbox</a></li>
                                                <li><a href="<?=Url::to(['site/openum'])?>" id="" class="" onclick="dataLayer.push({ & #39; category & #39; : & #39; Conversion & #39; , & #39; action & #39; : & #39; Nou_menu & #39; , & #39; label & #39; : & #39; Openum & #39; , & #39; event & #39; : & #39; eventga & #39; });">Openum</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4 col-sm-offset-1">
                                            <h3 class="title text-uppercase color-light alpha7"><u>Contracting</u></h3>
                                            <ul>
                                                <li><a href="<?=Url::to(['site/signaturum'])?>" id="" class="" onclick="dataLayer.push({ & #39; category & #39; : & #39; Conversion & #39; , & #39; action & #39; : & #39; Nou_menu & #39; , & #39; label & #39; : & #39; Signaturum & #39; , & #39; event & #39; : & #39; eventga & #39; });">Signaturum Pro (Connectaclick Pro)</a></li>
                                                <li><a href="<?=Url::to(['site/signaturum-basic'])?>" id="" class="" onclick="dataLayer.push({ & #39; category & #39; : & #39; Conversion & #39; , & #39; action & #39; : & #39; Nou_menu & #39; , & #39; label & #39; : & #39; Signaturum_Basic & #39; , & #39; event & #39; : & #39; eventga & #39; });">Signaturum Basic (Connectaclick Basic)</a></li>
                                                <li><a href="<?=Url::to(['site/registered-electronic-contracting'])?>" id="" class="" onclick="dataLayer.push({ & #39; category & #39; : & #39; Conversion & #39; , & #39; action & #39; : & #39; Nou_menu & #39; , & #39; label & #39; : & #39; Contracte_SMS & #39; , & #39; event & #39; : & #39; eventga & #39; });">Registered SMS contract</a></li>
                                                <li><a href="<?=Url::to(['site/registered-electronic-contracting'])?>" id="" class="" onclick="dataLayer.push({ & #39; category & #39; : & #39; Conversion & #39; , & #39; action & #39; : & #39; Nou_menu & #39; , & #39; label & #39; : & #39; Contracte_email & #39; , & #39; event & #39; : & #39; eventga & #39; });">Registered email contract</a></li>
                                                <li><a href="<?=Url::to(['site/videoconferencing-contracting'])?>" id="" class="" onclick="dataLayer.push({ & #39; category & #39; : & #39; Conversion & #39; , & #39; action & #39; : & #39; Nou_menu & #39; , & #39; label & #39; : & #39; Riu & #39; , & #39; event & #39; : & #39; eventga & #39; });">RIU &middot; Remote Identification Unit</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown has-dropdown-menu"><a href="#" data-toggle="dropdown" class="dropdown-toggle color-dark ">SMS solutions</a>
                            <ul class="dropdown-menu">
                                <li><a href="<?=Url::to(['site/texting'])?>" id="" class="" onclick="dataLayer.push({ & #39; category & #39; : & #39; Conversion & #39; , & #39; action & #39; : & #39; Nou_menu & #39; , & #39; label & #39; : & #39; SMS & #39; , & #39; event & #39; : & #39; eventga & #39; });">SMS</a></li>
                                <li><a href="<?=Url::to(['site/wholesale'])?>" id="" class="" onclick="dataLayer.push({ & #39; category & #39; : & #39; Conversion & #39; , & #39; action & #39; : & #39; Nou_menu & #39; , & #39; label & #39; : & #39; Smart & #39; , & #39; event & #39; : & #39; eventga & #39; });">Wholesale</a></li>
                                <li><a href="<?=Url::to(['site/operator-services'])?>" id="" class="" onclick="dataLayer.push({ & #39; category & #39; : & #39; Conversion & #39; , & #39; action & #39; : & #39; Nou_menu & #39; , & #39; label & #39; : & #39; Interconnexio_submenu & #39; , & #39; event & #39; : & #39; eventga & #39; });">Operators</a></li>
                            </ul>
                        </li>
                        <li class="dropdown megamenu-fw has-dropdown-menu"><a href="#" data-toggle="dropdown" class="dropdown-toggle color-dark ">Data validation</a>
                            <ul class="dropdown-menu fullwidth">
                                <li class="megamenu-content withoutdesc">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <h3 class="title text-uppercase color-light alpha7">Phone numbers</h3>
                                            <ul>
                                                <li><a href="<?=Url::to(['site/phone-checker'])?>" id="" class="" onclick="dataLayer.push({ & #39; category & #39; : & #39; Conversion & #39; , & #39; action & #39; : & #39; Nou_menu & #39; , & #39; label & #39; : & #39; Checker_telefon & #39; , & #39; event & #39; : & #39; eventga & #39; });">Check all</a></li>
                                                <li><a href="<?=Url::to(['site/phone-checker'])?>" id="" class="" onclick="dataLayer.push({ & #39; category & #39; : & #39; Conversion & #39; , & #39; action & #39; : & #39; Nou_menu & #39; , & #39; label & #39; : & #39; Checker_telefon & #39; , & #39; event & #39; : & #39; eventga & #39; });">Check network</a></li>
                                                <li><a href="<?=Url::to(['site/phone-checker'])?>" id="" class="" onclick="dataLayer.push({ & #39; category & #39; : & #39; Conversion & #39; , & #39; action & #39; : & #39; Nou_menu & #39; , & #39; label & #39; : & #39; Checker_telefon & #39; , & #39; event & #39; : & #39; eventga & #39; });">Phone Alert</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <h3 class="title text-uppercase color-light alpha7">Emails.</h3>
                                            <ul>
                                                <li><a href="<?=Url::to(['site/email-checker'])?>" id="" class="" onclick="dataLayer.push({ & #39; category & #39; : & #39; Conversion & #39; , & #39; action & #39; : & #39; Nou_menu & #39; , & #39; label & #39; : & #39; Checker_email & #39; , & #39; event & #39; : & #39; eventga & #39; });">Email checker</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <h3 class="title text-uppercase color-light alpha7">Documents</h3>
                                            <ul>
                                                <li><a href="<?=Url::to(['site/stamp-id'])?>" id="" class="" onclick="dataLayer.push({ & #39; category & #39; : & #39; Conversion & #39; , & #39; action & #39; : & #39; Nou_menu & #39; , & #39; label & #39; : & #39; Checker_docs & #39; , & #39; event & #39; : & #39; eventga & #39; });">Stamp ID
                                                    </a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="hidden-md hidden-lg"><a href="demos/index.html" id="" class="color-dark " onclick="dataLayer.push({ & #39; category & #39; : & #39; Conversion & #39; , & #39; action & #39; : & #39; Nou_menu & #39; , & #39; label & #39; : & #39; Demos & #39; , & #39; event & #39; : & #39; eventga & #39; });">Demos</a>
                        </li>
                        <li class="dropdown has-dropdown-menu"><a href="#" data-toggle="dropdown" class="dropdown-toggle color-dark ">Company</a>
                            <ul class="dropdown-menu">
                                <li><a href="<?=Url::to(['company/about-us'])?>" id="" class="" onclick="dataLayer.push({ & #39; category & #39; : & #39; Conversion & #39; , & #39; action & #39; : & #39; Nou_menu & #39; , & #39; label & #39; : & #39; SMS & #39; , & #39; event & #39; : & #39; eventga & #39; });">About Us</a></li>
                                <li><a href="<?=Url::to(['company/work-with-us'])?>" id="" class="" onclick="dataLayer.push({ & #39; category & #39; : & #39; Conversion & #39; , & #39; action & #39; : & #39; Nou_menu & #39; , & #39; label & #39; : & #39; Smart & #39; , & #39; event & #39; : & #39; eventga & #39; });">Contact</a></li>
                               
                            </ul>
                        </li>
                        <!--<li><a href="<?=Url::to(['site/investors'])?>" id="" class="color-dark " onclick="dataLayer.push({ & #39; category & #39; : & #39; Conversion & #39; , & #39; action & #39; : & #39; Nou_menu & #39; , & #39; label & #39; : & #39; Inversores & #39; , & #39; event & #39; : & #39; eventga & #39; });">Investors</a>-->
                        </li>
                        <li><a href="http://blog.lleida.net/en/" class="color-dark" target="_blank">Blog</a>
                        </li>
                        <li><a href="http://tools.verifpost.net/" class="color-dark" target="_blank">tools</a>
                        </li>
                        <li class="ml10 bg-blue br4"><a href="<?=Url::to(['site/register'])?>" id="boto-menu-comprar" class="bg-blue br4 color-light hover-ripple-out" onclick="dataLayer.push({ & #39; category & #39; : & #39; Conversion & #39; , & #39; action & #39; : & #39; ComprarP1 & #39; , & #39; label & #39; : & #39; Menu & #39; , & #39; event & #39; : & #39; eventga & #39; });">Free Register</a>
                        </li>
                        <li><a href="#" data-toggle="modal" data-target="#searchModal"><i class="icon-cerca-menu color-pasific"></i></a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="searchModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <div class="modal-content">
                    <div class="modal-header bg-gray">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title text-center"><i class="fa fa-search fa-fw"></i> Search</h5>
                    </div>
                    <div class="modal-body">
                        <form action="https://www.lleida.net/en/search-results" class="inline-form" itemprop="potentialAction" itemscope itemtype="https://schema.org/SearchAction">
                            <meta itemprop="target" content="https://www.lleida.net/en/search-results?q={q}"/>
                            <input type="text" class="modal-search-input" name="q" autofocus>
                        </form>
                    </div>
                    <div class="modal-footer bg-gray">
                    </div>
                </div>
            </div>
        </div>
        <?php $this->beginBody() ?>
        <?= $content ?>
        <?php $this->endBody() ?>
    </body>

    <footer>
        <section class="bg-dark2 pt15 pb15">
            <div class="container">
                <div class="row social">
                    <div class="col-xs-12 text-right">
                        <a class="color-light h4 mt0 mb0 pt0 pb0 mr5" href='https://www.linkedin.com/company-beta/18089647/' target='_blank' onclick="dataLayer.push({'socialnetwork':'LinkedIn', 'socialaction':'IrCanal', 'socialtarget':'https://www.linkedin.com/company-beta/18089647/', 'event':'socialbutton'});" >
                            <i class="icon-linkedin"></i>
                        </a>
                        <a class="color-light h4 mt0 mb0 pt0 pb0 mr5" href='https://twitter.com/verifpost' target='_blank' onclick="dataLayer.push({'socialnetwork':'Twitter', 'socialaction':'IrCanal', 'socialtarget':'https://twitter.com/verifpost', 'event':'socialbutton'});" >
                            <i class="icon-twitter"></i>
                        </a>
                        <a class="color-light h4 mt0 mb0 pt0 pb0 mr5" href='https://www.facebook.com/Verifpost-432493083779698/' target='_blank' onclick="dataLayer.push({'socialnetwork':'Facebook', 'socialaction':'IrCanal', 'socialtarget':'https://www.facebook.com/Verifpost-432493083779698/', 'event':'socialbutton'});" >
                            <i class="icon-facebook"></i>
                        </a>
<!--                        <a class="color-light h4 mt0 mb0 pt0 pb0 mr5" href='https://www.youtube.com/user/lleidanet' target='_blank' onclick="dataLayer.push({'socialnetwork':'YouTube', 'socialaction':'IrCanal', 'socialtarget':'https://www.youtube.com/user/lleidanet', 'event':'socialbutton'});" >
                            <i class="icon-youtube"></i>
                        </a>
                        <a class="color-light h4 mt0 mb0 pt0 pb0" href="skype:customerservicelleidanet?chat" onclick="dataLayer.push({'category':'Interaccion', 'action':'Contacto', 'label':'Skype_IconoFooter', 'event':'eventga'});" >
                            <i class="icon-skype"></i>
                        </a>-->
                    </div>
                </div>
            </div>
        </section>
        <section class='footer-two bg-dark3 pt20 pb20'>
            <div class='container'>
                <div class="row mb3">
                    <div class="col-xs-4 col-sm-2">
                        <h5 class="color-light text-uppercase alpha8">Company</h5>
                        <ul class="llista-peu no-icon-list">
                            <li><a href="<?=Url::to(['company/about-us'])?>" id="" class="color-light alpha7" onclick="null">About us</a></li>
                            <li><a href="<?=Url::to(['company/team'])?>" id="" class="color-light alpha7" onclick="null">The team</a></li>
                            <li><a href="<?=Url::to(['company/work-with-us'])?>" id="" class="color-light alpha7" onclick="null">Work with us</a></li>
                            <li><a href="<?=Url::to(['company/we-are-in'])?>" id="" class="color-light alpha7" onclick="null">We are in</a></li>
                            <li><a href="<?=Url::to(['legal/patents'])?>" target="_blank" class="color-light alpha7" click="dataLayer.push({'category':'Navegacion', 'action':'Descarga_PDF', 'label':'iso_cert', 'event':'eventga'});">ISO 27001</a></li>
                            <li><a href="<?=Url::to(['company/platform-for-equity'])?>" id="" class="color-light alpha7" onclick="null">Platform4Equity</a></li>
                        </ul>
                    </div>
                    <div class="col-xs-4 col-sm-2">
                        <h5 class="color-light text-uppercase alpha8">Legal</h5>
                        <ul class="llista-peu no-icon-list">
                            <li><a href="<?=Url::to(['legal/certificate'])?>" id="" class="color-light alpha7" onclick="null">The certificate</a></li>
                            <li><a href="<?=Url::to(['company/legal'])?>" id="" class="color-light alpha7" onclick="null">Legal</a></li>
                            <li><a href="<?=Url::to(['legal/legal-framework'])?>" id="" class="color-light alpha7" onclick="null">International</a></li>
                            <li><a href="<?=Url::to(['legal/patents'])?>" id="" class="color-light alpha7" onclick="null">Patents</a></li>
                        </ul>
                    </div>
                    <div class="col-xs-4 col-sm-2">
                        <h5 class="color-light text-uppercase alpha8">Resources</h5>
                        <ul class="llista-peu no-icon-list">
                            <li><a href="<?=Url::to(['resources/demos'])?>" id="" class="color-light alpha7" onclick="dataLayer.push({ & #39; category & #39; : & #39; Conversion & #39; , & #39; action & #39; : & #39; Nou_menu & #39; , & #39; label & #39; : & #39; Demos & #39; , & #39; event & #39; : & #39; eventga & #39; });">Demos</a>
                            </li>
                            <li><a href="<?=Url::to(['resources/customers'])?>" id="" class="color-light alpha7" onclick="dataLayer.push({ & #39; category & #39; : & #39; Conversion & #39; , & #39; action & #39; : & #39; Nou_menu & #39; , & #39; label & #39; : & #39; Casos exito & #39; , & #39; event & #39; : & #39; eventga & #39; });">Case studies</a></li>
                            <li><a href="<?=Url::to(['resources/whitepapers'])?>" id="" class="color-light alpha7" onclick="dataLayer.push({ & #39; category & #39; : & #39; Navegacion & #39; , & #39; action & #39; : & #39; Footer & #39; , & #39; label & #39; : & #39; whitepapers & #39; , & #39; event & #39; : & #39; eventga & #39; });">Whitepapers</a></li>
                            <li><a href='https://api.lleida.net/devel/es/index.html' class="color-light alpha7" target='_blank'>The APIs</a></li>
                        </ul>
                    </div>
                    <div class="visible-xs-block clearfix mb10 mt10"></div>
                    <div class="col-xs-4 col-sm-2">
                        <h5 class="color-light text-uppercase alpha8">Press</h5>
                        <ul class="llista-peu no-icon-list">
                            <li><a href="<?=Url::to(['press/press'])?>" id="" class="color-light alpha7" onclick="dataLayer.push({ & #39; category & #39; : & #39; Navegacion & #39; , & #39; action & #39; : & #39; Footer & #39; , & #39; label & #39; : & #39; whitepapers & #39; , & #39; event & #39; : & #39; eventga & #39; });">Press</a></li>
                            <li><a href="https://blog.lleida.net/en/" class="color-light alpha7" target="_blank">Blog</a></li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-xs-offset-1 col-sm-3 col-sm-offset-0 col-md-2 col-lg-2">
                        <div class="visible-xs-block visible-sm-block mt20"></div>
                        <div>
                            <a href="<?=Url::to(['legal/patents'])?>"  class="center-block" click="dataLayer.push({'category':'Interaccion', 'action':'Nou_menu', 'label':'Demos', 'event':'eventga'});"><img src="/img/logos/iso-27001-en.png" alt="ISO 27001" /></a>
                            <p class="color-light text-center"><strong>IS 632576</strong></p>
                        </div>
                        <div class="center-block">
                            <a href="https://www.gsm.org" target="_blank" class="pull-left mt5"><img src="/img/logos/gsma.png" alt="GSMA Associate Member"/></a>
                            <a href="https://www.bolsasymercados.es/mab/esp/EE/Ficha/LLEIDA_NET_ES0105089009.aspx" target="_blank" class="pull-right"><img src="/img/logos/mab.png" alt="Mercado Alternativo Bursatil"/></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class='bg-dark4 pt20 pb20'>
            <div class='container'>
                <div class='row peu-ciutats'>
                    <div class='col-xs-12 col-lg-10 col-lg-offset-1 text-center color-light alpha9'>
                        <p class='mb0'>Lleida &middot; Barcelona &middot; Madrid &middot; London &middot; Miami &middot; Paris &middot; New Delhi &middot; Santiago de Chile &middot; Bogot&aacute; &middot; S&atilde;o Paulo &middot; Tokyo &middot; Santo Domingo &middot; Cape Town &middot; Montevideo &middot; Johannesburg &middot; San Jos&eacute; &middot; Lima &middot; Beirut &middot; Dubai</p>
                    </div>
                </div>
            </div>
        </section>
        <section class='bg-dark3 pt20 pb20'>
            <div class='container'>
                <div class="row bb-solid-1 mb10 pb10 wrap-idiomes">
                    <div class="col-xs-12">
                        <p class="pull-right mb0">
                            <a href="https://tools.lleida.net" target="_blank" class="color-light alpha6" onclick="dataLayer.push({'category':'Conversion', 'action':'Tools', 'label':'Nou_header', 'event':'eventga'});">User&apos;s portal Tools</a>
                        </p>
                        <p class="mb0">
                            <a href="../ca/index.html" id="" class="color-light alpha7" onclick="null">
                                Catal&agrave;
                            </a>
                            &nbsp;&middot;&nbsp;
                            <a href="../es/index.html" id="" class="color-light alpha7" onclick="null">
                                Espa&ntilde;ol
                            </a>
                            &nbsp;&middot;&nbsp;
                            <a href="index.html" id="" class="color-light alpha7" onclick="null">
                                English
                            </a>
                            &nbsp;&middot;&nbsp;
                            <a href="../fr/index.html" id="" class="color-light alpha7" onclick="null">
                                Fran&ccedil;ais
                            </a>
                            &nbsp;&middot;&nbsp;
                            <a href="../pt/index.html" id="" class="color-light alpha7" onclick="null">
                                Portugu&ecirc;s
                            </a>
                        </p>
                    </div>
                </div>
                <div class='row pt2 pb2' itemscope itemtype='https://schema.org/Organization'>
                    <meta itemprop='name' content='Lleida.net' />
                    <meta itemprop='legalName' content='Lleida.net' />
                    <meta itemprop='logo' content='https://www.lleida.net/img/logos/Horizontal_claim_COLOR.png' />
                    <div class='col-xs-12' itemscope itemtype='https://schema.org/PostalAddress'>
                        <p class='mb0 pull-left color-light alpha7 peu-empresa'>
                            <span class="wrap"><span itemprop='streetAddress'>PCiTAL &middot; Edifici H1 &middot; 2a planta B </span>&middot;
                                <span itemprop='postalCode'>25003</span>
                                <span itemprop='addressLocality'>Lleida</span> (<span itemprop='addressCountry'>SPAIN</span>)</span>
                            <span itemprop='telephone' class="wrap"><a class="color-light alpha7 word-break" href='tel:+442033978568'>(+44)&nbsp;203&nbsp;397&nbsp;85&nbsp;68</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="color-light alpha7 word-break" style='text-decoration:none;' href='tel:+34973282300'>(+34)&nbsp;973&nbsp;282&nbsp;300</a></span>
                            <span class="wrap"><a href='mailto:info@verifpost.net' class='color-light alpha7' itemprop='email'>info@verifpost.net</a></span>
                        </p>
                        <p class='mb0 pull-right text-right peu-links'>
                            <span><a href="disclaimer-data-protection/index.html" id="" class="color-light alpha7" onclick="null">Disclaimer</a></span>
                            <span><a href="general-conditions-contract/index.html" id="" class="color-light alpha7" onclick="null">General conditions of contract</a></span>
                            <span><a href="disclaimer-data-protection/index.html" id="" class="color-light alpha7" onclick="null">Data protection</a></span>
                        </p>
                    </div>
                </div>
            </div>
    </footer>
</footer>
</html>
<?php $this->endPage() ?>