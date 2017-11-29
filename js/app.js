function fillData() {
    var DONE = 4; // readyState 4 means the request is done.
    var OK = 200; // status 200 is a successful return.


    var subjectsRequest = new XMLHttpRequest();
    subjectsRequest.open('GET', './php/getData.php');
    subjectsRequest.send(null);
    subjectsRequest.onreadystatechange = function () {
        if (subjectsRequest.readyState === DONE) {
            if (subjectsRequest.status === OK) {
                console.log(subjectsRequest.responseText);
                let parsedResponse = JSON.parse(subjectsRequest.responseText);
                console.log(parsedResponse);

                for (var i in parsedResponse) {
                    document.getElementById('subjectContainer').insertAdjacentHTML('afterbegin', '<div>' + parsedResponse[i] + '</div>');
                }
            } else {
                console.log('Error: ' + xhr.status); // An error occurred during the request.
            }
        }
    };
}
