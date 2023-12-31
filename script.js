function changeView(stats) {
    var signUpBox = document.getElementById("signUpBox")
    var signInBox = document.getElementById("signInBox")
    
    signUpBox.classList.toggle("d-none")
    signInBox.classList.toggle("d-none")
}

function signup(){
    var fname = document.getElementById("fname")
    var lname = document.getElementById("lname")
    var email = document.getElementById("email")
    var password = document.getElementById("password")
    var mobile = document.getElementById("mobile")
    var gender = document.getElementById("gender")

    var form = new FormData()
    form.append("f", fname.value)
    form.append("l", lname.value)
    form.append("e", email.value)
    form.append("p", password.value)
    form.append("m", mobile.value)
    form.append("g", gender.value)

    var request = new XMLHttpRequest();

    request.onreadystatechange = function(){
        if(request.status == 200 & request.readyState == 4){
            var response = request.responseText
            
            if(response == "success"){
                document.getElementById("msg").innerHTML = "Registration Successfull";
                document.getElementById("msg").className = "alert alert-success"
                document.getElementById("msgdiv").className = "d-block"
            } else {
                document.getElementById("msg").innerHTML = response;
                document.getElementById("msg").className = "alert alert-danger"
                document.getElementById("msgdiv").className = "d-block"
            }
        }
    }
    request.open("POST", "php/signupProcess.php", true)
    request.send(form)



}