function getBaseURL() {
    return location.protocol + "//" + location.hostname + (location.port && ":" + location.port) + "/";
}
var pageUrl = getBaseURL();

/// MAKE TOKEN


$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    window.app_absolute = '<?php echo GetRelativePath(dirname(__FILE__)); ?>';

    function startFCM() {
        messaging
            .requestPermission()
            .then(function() {
                return messaging.getToken()
            })
            .then(function(response) {

                $.ajax({
                    url: pageUrl + 'makeToken',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        token: response
                    },
                    success: function(response) {

                    },

                    error: function(error) {
                        // alert(error);
                    },
                });

            }).catch(function(error) {
                // alert(error);
            });
    }

    setInterval(function() {
        startFCM();
    }, 7000);
});

/// PUSH NOTIFICATION CÔNG VIỆC APPP
$(document).ready(function() {
    // updating the view with notifications using ajax
    function load_push_notificationMobile(view = '') {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: pageUrl + 'countnotiPushFirebaseMobile',
            method: "post",
        });
    }
    load_push_notificationMobile();
    $(document).on('click', '#noti_app', function() {
        $('#count').html('');
        load_push_notificationMobile('yes');

    });

    setInterval(function() {
        load_push_notificationMobile();
    }, 30000);
});

// /// ĐẾM CÔNG VIỆC APP
$(document).ready(function() {
    // updating the view with notifications using ajax
    function load_unseen_notificationMobile(view = '') {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            url: pageUrl + 'countnotiMobile',
            method: "post",

            data: { view: view },
            dataType: "json",
            success: function(data) {
                $('#menu_notiAppMobile').html(data.notificationMobile);
                $('#menu_notiWorker').html(data.notificationWorker);
                if (data.unseen_notificationMobile > 0) {
                    $('#countnoticationMobile').html(data.unseen_notificationMobile);
                    var myAudio = new Audio(pageUrl + "/dist/mp3/1.mp3");
                    myAudio.play();
                    setTimeout(function() {
                        myAudio.pause();
                        myAudio.currentTime = 0;
                    }, 5000);

                }
            }
        });
    }
    load_unseen_notificationMobile();
    $(document).on('click', '#noti_app', function() {
        $('#count').html('');
        load_unseen_notificationMobile('yes');

    });

    setInterval(function() {
        load_unseen_notificationMobile();
    }, 5000);
});
// nút chuyển   
function srolltoDN() {
    const element = document.getElementById("lichDN");
    element.scrollIntoView();
}

function srolltoDL() {
    const element = document.getElementById("lichDL");
    element.scrollIntoView();
}

function srolltoDG() {
    const element = document.getElementById("lichDG");
    element.scrollIntoView();
}

function srolltoXD() {
    const element = document.getElementById("lichXD");
    element.scrollIntoView();
}

function srolltoKhac() {
    const element = document.getElementById("lichKhac");
    element.scrollIntoView();
}

// // / ĐẾM THÔNG BÁO
// $(document).ready(function() {
//     // updating the view with notifications using ajax
//     function load_unseen_notification(view = '') {


//         $.ajax({
//             url: pageUrl + '/countnoti',
//             method: "post",

//             data: { view: view },
//             dataType: "json",
//             success: function(data) {
//                 $('#menu_notiApp').html(data.notification);
//                 if (data.unseen_notification > 0) {
//                     $('#countnotication').html(data.unseen_notification);
//                     var myAudio = new Audio(pageUrl + "/dist/mp3/1.mp3");
//                     myAudio.play();
//                     setTimeout(function() {
//                         myAudio.pause();
//                         myAudio.currentTime = 0;
//                     }, 7000);
//                     console.log(data.unseen_notification);
//                 }
//             }
//         });
//     }
//     load_unseen_notification();
//     $(document).on('click', '#noti_app', function() {
//         $('#count').html('');
//         load_unseen_notification('yes');

//     });

//     setInterval(function() {
//         load_unseen_notification();
//     }, 7000);
// });

// function sentMess() {
//     var content_chat = document.getElementById('content_chat').value;
//     var user_chat = document.getElementById('user_chat').value;
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
//     $.ajax({
//         url: pageUrl + 'sentMess',
//         type: 'POST',
//         dataType: 'JSON',
//         data: {
//             'content_chat': content_chat,
//             ' user_chat': user_chat
//         },

//         success: function(response) { console.log(data); },

//         error: function(error) {
//             alert(error);
//             // console.log(data);
//         },
//     });

// }