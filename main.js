// Create a registration system
var objPeople = [
	{
		username: 'sam',
		password: 'sam25'
	},
	{
		username: 'matt',
		password: 'matt25'
	},
	{
		username: 'chris',
		password: 'chris25'
	}
]



// register functionality
function registerUser() {
	// store new users username
	var registerUsername = document.getElementById('newUsername').value;
	// store new users password
	var registerPassword = document.getElementById('newPassword').value
	// store new email 
	var registerEmail = document.getElementById('newEmail').value
	// store message to display
	var messanger = document.getElementById('msg');
	

	// store new user data in an object
	var newUser = {
		username: registerUsername,
		password: registerPassword
	}
	// loop throught people array to see if the username is taken, or password to short
	for(var i = 0; i < objPeople.length; i++) {
		// check if new username is equal to any already created usernames
		if(registerUser == objPeople[i].username) {
			// alert user that the username is taken
			alert('That username is already in user, please choose another')
			// stop the statement if result is found true
			break
		// check if new password is 8 characters or more
		} else if (registerPassword.length < 5) {
			// alert user that the password is to short
			alert('Password is to short, include 5 or more characters')
			// stop the statement if result is found true
			break
		} 
	}  if (registerUsername =="")
	alert ('Hey!, Please insert a Username');
else if(registerUsername && registerPassword == ""){
	messanger.innerHTML = 'SUCCESSFULLY UNREGISTERED';	
	}else{
	messanger.innerHTML = 'SUCCESSFULLY REGISTERED';
	objPeople.push(newUser)
	}
	
	//CLEARS INPUT
	document.getElementById('newUsername').value = '';
	document.getElementById('newPassword').value = '';
	document.getElementById('newEmail').value == '';
	// console the updated people array
	console.log(objPeople)
// push new object to the people array


}



//login functionality
function login() {
	
// retreive data from username and store in username variable
const username = document.getElementById('username').value;
// retreive data from password and store in password variable
const password = document.getElementById('password').value;	

var formdata = {
	username: username,
	password: password

}
	//console.log(JSON.stringify(formdata))
	
// To compare if the username or password to reg is the same as to login
	if(objPeople.some( person => person.username === formdata.username && person.password === formdata.password)){
		alert ('Hea, You are now logged in')
		console.log('Its the same');
	} else {
		alert('incorrect Password Username or Password')
		console.log('You are not logged in. Try using the right Parameters')
	}

}
