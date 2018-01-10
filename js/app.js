var DONE = 4; // readyState 4 means the request is done.
var OK = 200; // status 200 is a successful return.

function addSubject() {
	var subjectsRequest = new XMLHttpRequest();
	subjectsRequest.open('Post', './php/addSubject.php');
	subjectsRequest.send('{"lvnr":"1234567","title":"TestTitle","groups":"2"}');
	subjectsRequest.onreadystatechange = function() {
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
	teacherRequest.onreadystatechange = function() {
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

function addLesson(subjectId) {
	var lessonRequest = new XMLHttpRequest();
	lessonRequest.open('Post', './php/addLesson.php');
	lessonRequest.send('{"teacher":"1","subject":"'+subjectId+'","hours":"20", "group":"gruppe"}');
	lessonRequest.onreadystatechange = function() {
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
dataRequest.onreadystatechange = function() {
	if (dataRequest.readyState === DONE) {
		if (dataRequest.status === OK) {
			console.log(dataRequest.responseText);
			let parsedResponse = JSON.parse(dataRequest.responseText);
			console.log(parsedResponse);

			var subjects = [];

			for (var i in parsedResponse.subjects) {
				var x = 0;
				for (var j in subjects) {
					if (parsedResponse.subjects[i].id == subjects[j].id) {
						x++;
					}
				}
				if (x == 0) {
					subjects[subjects.length] = {
						id: parsedResponse.subjects[i].id,
						lvnr: parsedResponse.subjects[i].lnvr,
						title: parsedResponse.subjects[i].title,
						groups_required: parsedResponse.subjects[i].groups_required,
						lessons: [
							{
								hours: parsedResponse.subjects[i].hours,
								short: parsedResponse.subjects[i].short,
								group: parsedResponse.subjects[i].group
							}
						]
					};
				} else {
					for (var j in subjects) {
						if (parsedResponse.subjects[i].id == subjects[j].id) {
							subjects[j].lessons[subjects[j].lessons.length] = {
								hours: parsedResponse.subjects[i].hours,
								short: parsedResponse.subjects[i].short,
								group: parsedResponse.subjects[i].group
							};
						}
					}
				}
			}

			console.log(subjects);

			for (var i in subjects) {
				appendSubject(document.getElementById('subjects'), subjects[i]);
			}
		} else {
			console.log('Error: ' + dataRequest.status); // An error occurred during the request.
		}
	}
};

function appendSubject(element, subject) {
	element.insertAdjacentHTML('beforeend', '<div class="subject"><div class="info"><button type="button" name="button" class="closeButton">x</button><div class="half"><b>Subject: </b><span class="name">' + subject.title + '</span></div><div class="half"><b>Criteria: </b><span class="timecriteria"> 5 </span></div></div><div class="lessonContainer" id="subject' + subject.id + '"></div></div>');
	for (var i = 0; i < subject.lessons.length; i++) {
		appendLesson(document.getElementById('subject' + subject.id), subject.lessons[i]);
	}
	document.getElementById('subject' + subject.id).insertAdjacentHTML('beforeend', '<button type="button" name="button" onclick="addLesson('+subject.id+');"> + </button>');
}

function appendLesson(element, lesson) {
	element.insertAdjacentHTML('beforeend', '<div class="lessons"><div class="lesson centered"><div class="row teacherrow"><span class="teacher">' + lesson.short + '</span></div><div class="row"><span class="half">Group </span><span class="half">' + lesson.group + '</span</div></div></div>');
}
