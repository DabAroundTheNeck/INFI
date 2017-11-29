function fillData() {
    var DONE = 4; // readyState 4 means the request is done.
    var OK = 200; // status 200 is a successful return.


    var subjectsRequest = new XMLHttpRequest();
    subjectsRequest.open('GET', 'send-ajax-data.php');
    subjectsRequest.send(null);
    subjectsRequest.onreadystatechange = function () {
        if (subjectsRequest.readyState === DONE) {
            if (subjectsRequest.status === OK)
                document.getElementById("subjectContainer").innerText = subjectsRequest.responseText;
            } else {
                console.log('Error: ' + xhr.status); // An error occurred during the request.
            }
        }
    };
}
