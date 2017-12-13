var DONE = 4; // readyState 4 means the request is done.
var OK = 200; // status 200 is a successful return.

function fillData() {
    var subjectsRequest = new XMLHttpRequest();
    subjectsRequest.open('Get', './php/getData.php');
    loginRequest.send();
    //loginRequest.send('{"e":"email","pw":"password"}');
    subjectsRequest.onreadystatechange = function () {
        if (subjectsRequest.readyState === DONE) {
            if (subjectsRequest.status === OK) {
                console.log(subjectsRequest.responseText);
                let parsedResponse = JSON.parse(subjectsRequest.responseText);
                console.log(parsedResponse);

                for (var i in parsedResponse.subjects) {
                    document.getElementById('subjectContainer').insertAdjacentHTML('afterbegin', '<div>' + parsedResponse.subjects[i].lvnr + ' ' + parsedResponse.subjects[i].title + ' ' + parsedResponse.subjects[i].groups_required + '</div>');
                }
            } else {
                console.log('Error: ' + subjectsRequest.status); // An error occurred during the request.
            }
        }
    };
}

function addSubject() {
    var subjectsRequest = new XMLHttpRequest();
    subjectsRequest.open('Post', './php/addSubject.php');
    loginRequest.send('{"lvnr":"1234567","title":"TestTitle","groups":"2"}');
    subjectsRequest.onreadystatechange = function () {
        if (subjectsRequest.readyState === DONE) {
            if (subjectsRequest.status === OK) {
                console.log(subjectsRequest.responseText);
                let parsedResponse = JSON.parse(subjectsRequest.responseText);
                console.log(parsedResponse);
            } else {
                console.log('Error: ' + subjectsRequest.status); // An error occurred during the request.
            }
        }
    };
}
