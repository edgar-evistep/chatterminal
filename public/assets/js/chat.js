$(".submit").click(function() {
    newMessage();
});

$(document).on("keydown", '#chat_inp', function(e) {
    if (e.which == 13) {
        newMessage();
        return false;
    }
});


function newMessage() {
    message = $("#chat_inp").val();
    if ($.trim(message) == "") {
        return false;
    }

    $.ajax({
        url: '/new_message',
        type: 'post',
        data: { '_token': $token, message },
        success: function(r) {}
    })
    let d = new Date(2010, 7, 5);
    let ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(d);
    let mo = new Intl.DateTimeFormat('en', { month: 'short' }).format(d);
    let da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);
    $(`<div class="chat-item">
        <div class="d-flex">
            <img src="https://image.freepik.com/free-vector/gamer-logo_43901-59.jpg" alt="">
            <div class="p-1">
                <div class="d-flex align-items-end">
                    <div class="sender-name"><a href="#">${'#' + $username}</a></div>
                    <div class="chat-time">${da}-${mo}-${ye}</div>
                </div>
<!--                <div class="float-right">-->
<!--                    <button type="button" class="dropdown-btn btn-tr p-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
<!--                        <i class="fas fa-ellipsis-v"></i>-->
<!--                    </button>-->
<!--                    <div class="dropdown-menu">-->
<!--                        &lt;!&ndash; Dropdown menu links &ndash;&gt;-->
<!--                        <a class="dropdown-item" href="#">Report</a>-->
<!--                        <a class="dropdown-item" href="#">Block</a>-->
<!--                    </div>-->
<!--                </div>-->
                <div class="chat-text">
                    ${message}
                </div>
            </div>
        </div>
    </div>`).appendTo($(".chat-view"));
    $("#chat_inp").val(null);

}
