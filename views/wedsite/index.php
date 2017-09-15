<div class="container secondary-navbar">
            <ul class="nav nav-pills">
                <li class="underLink" role="presentation"><a href="#">Home</a></li>
              <li class="underLink" role="presentation" id='aboutLink'><a href="#">About</a></li>
              <li  class="underLink" role="presentation" class="active" id='EventsLink'><a href="#">Events</a></li>
              <li class="underLink" role="presentation"><a href="#">Registry</a></li>
              <li class="underLink" id='CommunityLink' role="presentation"><a href="#">Community</a></li>
            </ul>           
          </div>
<?php
 

$this->registerJs(<<<JS
        $('#aboutLink').click(function() {
        $('.underLink').removeClass( "active" );
        $('#aboutLink').addClass( "active" );
            $('#content-pages').load('about');
        });
         $('#EventsLink').click(function() {
        $('.underLink').removeClass( "active" );
        $('#EventsLink').addClass( "active" );
            $('#content-pages').load('events');
        });
        
        $('#CommunityLink').click(function() {
        $('.underLink').removeClass( "active" );
        $('#CommunityLink').addClass( "active" );
            $('#content-pages').load('community');
        });
        $(document).ready(function() {
        $('.underLink').removeClass( "active" );
        $('#EventsLink').addClass( "active" );
            $('#content-pages').load('events');
        });

JS
);
                                                                   
                                                                ?>
<div id='content-pages'>
    
</div>