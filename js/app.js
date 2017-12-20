var DONE = 4; // readyState 4 means the request is done.
var OK = 200; // status 200 is a successful return.

function addSubject() {
    var subjectsRequest = new XMLHttpRequest();
    subjectsRequest.open('Post', './php/addSubject.php');
    subjectsRequest.send('{"lvnr":"1234567","title":"TestTitle","groups":"2"}');
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

function addTeacher() {
    var teacherRequest = new XMLHttpRequest();
    teacherRequest.open('Post', './php/addTeacher.php');
    teacherRequest.send('{"fName":"Vorname","lName":"Nachname","short":"VRN"}');
    teacherRequest.onreadystatechange = function () {
        if (teacherRequest.readyState === DONE) {
            if (teacherRequest.status === OK) {
                console.log(teacherRequest.responseText);
                let parsedResponse = JSON.parse(teacherRequest.responseText);
                console.log(parsedResponse);
            } else {
                console.log('Error: ' + teacherRequest.status); // An error occurred during the request.
            }
        }
    };
}

function addLesson() {
    var lessonRequest = new XMLHttpRequest();
    lessonRequest.open('Post', './php/addLesson.php');
    lessonRequest.send('{"teacher":"0","subject":"0","hours":"20", "group":"gruppe"}');
    lessonRequest.onreadystatechange = function () {
        if (lessonRequest.readyState === DONE) {
            if (lessonRequest.status === OK) {
                console.log(lessonRequest.responseText);
                let parsedResponse = JSON.parse(lessonRequest.responseText);
                console.log(parsedResponse);
            } else {
                console.log('Error: ' + lessonRequest.status); // An error occurred during the request.
            }
        }
    };
}

var dataRequest = new XMLHttpRequest();
dataRequest.open('Get', './php/getData.php');
dataRequest.send();
//loginRequest.send('{"e":"email","pw":"password"}');
dataRequest.onreadystatechange = function () {
    if (dataRequest.readyState === DONE) {
        if (dataRequest.status === OK) {
            console.log(dataRequest.responseText);
            let parsedResponse = JSON.parse(dataRequest.responseText);
            console.log(parsedResponse);

            for (var i in parsedResponse.subjects) {
                document.getElementById('subjectContainer').insertAdjacentHTML('afterbegin', '<div>' + parsedResponse.subjects[i].lvnr + ' ' + parsedResponse.subjects[i].title + ' ' + parsedResponse.subjects[i].groups_required + '</div>');
            }
        } else {
            console.log('Error: ' + dataRequest.status); // An error occurred during the request.
        }
    }
};
