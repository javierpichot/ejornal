@php
    $message_class = "m-row-" . $thread->id;
@endphp
<div id="js-chat-messages-title">


        <div class="chat-me ">
            <div class="chat-msg js-chat-msg"  data-message_id="{{ $thread->id }}"></div>
        </div>


        <div class="chat-other ">
            <div class="avatar-xs avatar mr10" >

            </div>
            <div class="chat-msg js-chat-msg"  data-message_id="{{ $thread->id }}">

            </div>
        </div>




        <script class="temp-script33">
            //don't show duplicate messages
            $("<?php echo '.' . $message_class; ?>:first").nextAll("<?php echo '.' . $message_class; ?>").remove();
        </script>

</div>
<div id="js-chat-old-messages">

</div>
