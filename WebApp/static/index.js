function to_login() {
    var state = document.getElementById("login");
    var state2 = document.getElementById("signup");
    if (state.style.display === "none" && state2.style.display !== "none") {
        state.style.display = "block";
        state2.style.display = "none"
    }
}

function to_signup() {
    var state = document.getElementById("signup");
    var state2 = document.getElementById("login");
    if (state.style.display === "none" && state2.style.display !== "none") {
        state.style.display = "block";
        state2.style.display = "none"
    }
}

function signup() {
    if(!document.getElementById("signname").value || !document.getElementById("signpass").value) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: 'error',
            title: 'Some fields are empty!'
        })
      return;
    }
    $.ajax({
        type: 'POST',
        url: 'http://localhost/project/api/user/create.php',
        data: {
            'username': document.getElementById("signname").value, //change to text field input
            'password': document.getElementById("signpass").value //change to text field input
        },
        success: function (data) { //returns user details if username and password matches a record
            if (data) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                Toast.fire({
                    icon: 'success',
                    title: 'Account created successfully.'
                })
                to_login();
            }
            else {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                Toast.fire({
                    icon: 'error',
                    title: 'Invalid account!'
                })
            }
        }
    });
}

function login() {
    if(!document.getElementById("username").value || !document.getElementById("password").value) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: 'error',
            title: 'Some fields are empty!'
        })
      return;
    }
    $.ajax({
        type: 'POST',
        url: 'http://localhost/project/api/user/get.php',
        data: {
            'username': document.getElementById("username").value, //change to text field input
            'password': document.getElementById("password").value, //change to text field input
            'id': 0
        },
        success: function (data) { //returns user details if username and password matches a record
            console.log(data);
            if (data) {
                window.name = data['id'];
                location.href = './main.php';
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                Toast.fire({
                    icon: 'success',
                    title: 'Signed in successfully.'
                })
            }
            else {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                Toast.fire({
                    icon: 'error',
                    title: 'Invalid account!'
                })
            }
        }
    });
}