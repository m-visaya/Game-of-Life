var user_id;
var username;
var tasks;

validate();

function validate() { 
    $.ajax({
        type: 'POST',
        url: 'http://10.0.2.2:80/project/api/user/get.php',
        data: {
            'id': window.name
        },
        success: function(data) {
            user_id = data['id'];
            username = data['username'];
            tasks = JSON.parse(data['tasks']);
        }
    });
}

function create_task() {
    if(!document.getElementById('titleCreate').value){
        Swal.fire({
            position: 'center',
            width: '12rem',
            icon: 'error',
            //title: 'All Fields are Required!',
            showConfirmButton: false,
            timer: 1500
          })
        return;
    }
    $.ajax({
        type: 'POST',
        url: 'http://10.0.2.2:80/project/api/task/create.php',
        data: {
            'name': document.getElementById('titleCreate').value,
            'description':'',
            'category': document.getElementById('categoryCreate').value,
            'value': document.getElementById('valueCreate').value,
            'creator': user_id
        },
        success: function(response) {
            if(response) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Task Added',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        }
    });
}

function to_main() {
    window.name = user_id;
    location.href = './main.html';
}