const database = firebase.firestore();
let i = 0;
var out = '';
database.collection('chat').get().then((querySnapshot) => {
    querySnapshot.forEach((doc) => {
        out += `<li id="` + doc.id + `" class="hihi" onClick="getAllmess(` + doc.id + `)">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1940306/chat_avatar_01.jpg" alt="" >
                            <div><h2>` + doc.data()['group'] + `</h2><h3><span class="status orange"></span><div id="number_mess"></div</h3></div></li>`;
    });
    document.getElementById("output").innerHTML = out;

});

function checkTime(time) {
    let mystring = time;
    let arrayStrig = mystring.split(" ");
    // console.log();
    return arrayStrig[1];
}

function getAllmess(id_g) {
    let message_view = ''
    var id_g = id_g.toString();
    document.getElementById("left-chat").style.visibility = 'visible';
    document.getElementById("first-chat").style.display = 'none';
    const name_group = database.collection("chat").doc(id_g);
    const chat_mess = database.collection("chat").doc(id_g).collection('chat_worker').orderBy('time');

    document.getElementById("first-chat").style.display = 'none';
    name_group.get().then(group => {
        if (group.exists) {

            document.getElementById("header-chat").innerHTML = group.data().group;
            document.getElementById("id_group").setAttribute('value', group.id);

        } else {
            console.log('Null');
        }
    });

    chat_mess.onSnapshot(querySnapshot => {
        querySnapshot.forEach((doc) => {
            if (doc.exists) {
                message_view += ` <li  class="`;
                if (doc.data().id_worker != '{{Auth::user()->id}}') {
                    message_view += `you"> 
                            <div class="entete">
                                <span class="status green"></span>
                                <h3> ` + checkTime(doc.data().time) + `</h3>
                                <h2> ` + doc.data().name_worker + `</h2>
                            </div>`;
                } else {
                    message_view += `me"> 
                            <div class="entete">
                                <span class="status green"></span>
                                <h2> ` + doc.data().name_worker + `</h2>
                                <h3> ` + checkTime(doc.data().time) + `</h3>
                            </div>`;
                }
                message_view += `<div class="message">`;
                if (doc.data().content != '' && doc.data().img_path == '') {
                    message_view += doc.data().content;
                } else {
                    if (doc.data().content == '' && doc.data().img_path != '') {
                        message_view += `<img src="` + doc.data().img_path + `" class='image_thumb' style="max-height:150px; width:auto"  data-toggle="modal" data-target="#` + doc.id + `">
                                <div class="modal fade" id="` + doc.id + `" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" style="margin-top:150px">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="container-fluid">
                                                    <img src="` + doc.data().img_path + `" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                    } else {
                        message_view += `<img src="` + doc.data().img_path + `" class='image_thumb' style="max-height:150px; width:auto"  data-toggle="modal" data-target="#` + doc.id + `"><hr>
                                ` + doc.data().content + `
                                <div class="modal fade" id="` + doc.id + `" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" style="margin-top:150px">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="container-fluid">
                                                    <img src="` + doc.data().img_path + `" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                    }
                }
                message_view += `
                        </div>
                    </li>`;
            } else {
                console.log('Null1111111111111111111111111111111111');
            }
        });
        document.getElementById("chat-mess").innerHTML = message_view;
        var messageBody = document.querySelector('#chat');
        messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;

    });
}
// button image
$('#OpenImgUpload').click(function() { $('#imgupload').trigger('click'); });
//Gửi tin nhắn theo nhóm chat
$('#sent_mess').click(function() {
    var content_mess = $("#content_chat").val();
    var id_doc = $("#id_group").val();
    let time = moment().format('L h:mm:ss');
    var name_worker = '{{Auth::user()->name}}';
    var id_worker = '{{Auth::user()->id}}';
    var url_chat = `{{asset('')}}`;
    let dataImage = $('#imgupload');
    let photo = document.getElementById("imgupload").files[0];;
    // console.log(photo);
    // console.log(encodeURIComponent(photo.name));
    // console.log(content_mess);
    if (photo != undefined) { //tồn tại hình
        if (content_mess != '') {
            let img = $("#imgupload");
            var form = new FormData();
            form.append("imageFile", img[0].files[0]);
            form.append("id_worker", id_doc);
            var req = null;
            $.ajax({
                type: "POST",
                url: "https://data.thoviet.net/api/saveImage",
                processData: false,
                mimeType: "multipart/form-data",
                contentType: false,
                data: form,
                success: function(response) {

                    img_path = 'https://data.thoviet.net/' + response;
                    database.collection("chat")
                        .doc(id_doc)
                        .collection('chat_worker')
                        .add({
                            content: content_mess,
                            img_path: img_path,
                            name_worker: name_worker,
                            id_worker: id_worker,
                            time: time,
                        })
                        .then((docRef) => {
                            console.log("Document written with ID: ", docRef.id);
                        })
                        .catch((error) => {
                            console.error("Error adding document: ", error);
                        });
                },
                error: function(e) {
                    console.log(e);
                }
            });
        } else

        {

            let img = $("#imgupload");
            var form = new FormData();
            form.append("imageFile", img[0].files[0]);
            form.append("id_worker", id_doc);
            var req = null;
            $.ajax({
                type: "POST",
                url: "https://data.thoviet.net/api/saveImage",
                processData: false,
                mimeType: "multipart/form-data",
                contentType: false,
                data: form,
                success: function(response) {

                    img_path = 'https://data.thoviet.net/' + response;
                    database.collection("chat")
                        .doc(id_doc)
                        .collection('chat_worker')
                        .add({
                            content: content_mess,
                            img_path: img_path,
                            name_worker: name_worker,
                            id_worker: id_worker,
                            time: time,
                        })
                        .then((docRef) => {
                            console.log("Document written with ID: ", docRef.id);
                        })
                        .catch((error) => {
                            console.error("Error adding document: ", error);
                        });
                },
                error: function(e) {
                    console.log(e);
                }
            });

        }


    } else {
        //    k tồn tại hình
        if (content_mess != '') {
            database.collection("chat")
                .doc(id_doc)
                .collection('chat_worker')
                .add({
                    content: content_mess,
                    img_path: '',
                    name_worker: name_worker,
                    id_worker: id_worker,
                    time: time,
                })
                .then((docRef) => {
                    console.log("Document written with ID: ", docRef.id);
                })
                .catch((error) => {
                    console.error("Error adding document: ", error);
                });
        } else {
            alert("Vui lòng soạn tin nhắn!!");
        }
    }

});
$("#sent_mess").on("click", function(event) {
    $("#content_chat").val("");
    $("#imgupload").val("");
});

let contentElement = document.getElementById("content");