var user_id;
var username;
var tasks;
var stats;
var level;
var currentdate;
var gradients = {
    'productivity': "linear-gradient(rgba(251, 200, 212, 0.45), rgba(151, 149, 240, 0.2))",
    'health': "linear-gradient(rgba(255, 195, 113, 0.25), rgba(255, 95, 109, 0.25))",
    'creativity': "linear-gradient(rgba(253, 187, 45, 0.2), rgba(34, 193, 195, 0.2))"
};
var months = ["January", "February", "March", "April", "May", "June",
"July", "August", "September", "October", "November", "December"];
var days = ["Sunday", "Monday", "Tuesday", "Wedneday", "Thursday", "Friday", "Saturday"];

$(document).ready(function () {
    validate();
    currentdate = getCurrentDate();
    document.getElementById('date-today').innerHTML = `` + currentdate.day + `, ` + currentdate.month + ` ` + currentdate.date + ``;
});

function validate() { //function for log in
    if (window.name == '') {
        location.href = './index.php';
        return;
    }
    $.ajax({
        type: 'POST',
        url: 'http://localhost/project/api/user/get.php',
        data: {
            'username': "",
            'password': "",
            'id': window.name
        },
        success: function (data) {
            user_id = data['id'];
            username = data['username'];
            tasks = JSON.parse(data['tasks']);
            stats = JSON.parse(data['stats']);
            level = data['level'];
            document.getElementById('user-name').innerHTML = username;
            document.getElementById('today-done').innerHTML = tasks['done'];
            document.getElementById('today-pending').innerHTML = Object.keys(tasks['pending']).length - 1;
            load_tasks();
            loadStats();
            load_recommended();
        }
    });
}

// function sleep(ms) {
//     return new Promise(resolve => setTimeout(resolve, ms * 100));
// }

function selectTag(e) {
    let button = document.getElementById(e);
    let bgColor = window.getComputedStyle(button).backgroundColor;
    if (bgColor == "rgb(117, 117, 117)") {
        button.style.backgroundColor = "var(--text-orange)";
    } else {
        button.style.backgroundColor = "var(--text-dark-gray)";
    }
    if (document.getElementById('search_task').value != "") {
        search_task();
    }
    else {
        filter_tasks();
    }
}

function search_task() { //function to search task
    // await sleep(1);
    var task_name = document.getElementById('search_task').value;
    if (!task_name) {
        return;
    }
    $.ajax({
        type: 'POST',
        url: 'http://localhost/project/api/task/get_all.php',
        data: {
            'name': task_name,
            'user_id': user_id,
            'pending': tasks['pending'],
            'all': null
        },
        success: function (data) {
            load_browse(data);
        }
    });
}

function filter_tasks() { //function to get all tasks from tasks table
    // await sleep(1);
    $.ajax({
        type: 'POST',
        url: 'http://localhost/project/api/task/get_all.php',
        data: {
            'user_id': user_id,
            'pending': tasks['pending'],
            'name':null,
            'all': true
        },
        success: function (data) {   //returns dictionary with categories as keys for task arrays
            load_browse(data);
        }
    });
}

function load_recommended() { //function to get all tasks from tasks table
    // await sleep(1);
    $.ajax({
        type: 'POST',
        url: 'http://127.0.0.1:80/project/api/task/get_all.php',
        data: {
            'user_id': user_id,
            'pending': tasks['pending'],
            'name':null,
            'all': true
        },
        success: function (data) {   //returns dictionary with categories as keys for task arrays
            $('#recommended-container').empty();
            if (data) {
                let temp_stats = { 'health': stats['health'], 'productivity': stats['productivity'], 'creativity': stats['creativity'] }

                x=0;
                while (Object.keys(temp_stats).length > 0) {
                    key = Object.keys(temp_stats).reduce((key, v) => temp_stats[v] < temp_stats[key] ? v : key);
                    if (Object.keys(data[key + "_tasks"]).length > 0) {
                        data = data[key + "_tasks"];
                        break;
                    }
                    delete temp_stats[key];
                    x++;
                }
                    document.getElementById('headerRecommended').style.display = "block";
                    let cards = [];
                    for (x = 0; x < Object.keys(data).length; x++) {
                        if (!data[x]) {
                            continue;
                        }
                        let background = `` + gradients[data[x]['category']] + `,url('./assets/` + data[x]['category'] + `.png')`;
                        let card = `
                        <div class="task-card task-card-animation">
                        <div class="task-card-overlay">
                        <svg onclick="add_pending(`+ data[x]['id'] + `, true)" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-circle green" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                        </div>

                        <div class="top" style="background: `+ background + `"></div>
                        <div class="card-body">
                        <div class="content">
                            <h3>`+ data[x]['name'] + `</h3>
                        </div>
                        <div class="container-card-footer">
                            <button>`+ data[x]['category'] + `</button>
                        </div>
                        </div>
                        </div>
                        `;
                        cards.push(card);
                    }
                    cards.forEach((element,i) => {
                        setTimeout(
                            function(){
                                $('#recommended-container').append(element);  
                            }
                        , i * 200);
                    });
            }
            else {
                document.getElementById('headerRecommended').style.display = "none";
            }
        }
    });
}

function load_browse(data) {
    data2 = [];
    if (window.getComputedStyle(document.getElementById('tag-creativity')).backgroundColor != "rgb(117, 117, 117)") {
        data2 = data2.concat(data['creativity_tasks']);
    };
    if (window.getComputedStyle(document.getElementById('tag-productivity')).backgroundColor != "rgb(117, 117, 117)") {
        data2 = data2.concat(data['productivity_tasks']);
    };
    if (window.getComputedStyle(document.getElementById('tag-health')).backgroundColor != "rgb(117, 117, 117)") {
        data2 = data2.concat(data['health_tasks']);
    };
    document.getElementById('container-taskResults').innerHTML = "";
    let cards = '';
    for (let x = 0; x < data2.length; x++) {
        let background = `` + gradients[data2[x]['category']] + `,url('./assets/` + data2[x]['category'] + `.png')`;
        cards += `
        <div class="card-taskResults">
        <div class="overlay" onclick='add_pending(`+ data2[x]['id'] + `);'> 
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
        </svg>
        </div>
        <div class="left" style="background:`+ background + `"></div>
        <div class="right">
            <h3>`+ data2[x]['name'] + `</h3>
            <p>`+ data2[x]['category'] + `</p>
        </div>
        </div>
        `;
    }
    $('#container-taskResults').append(cards)
}

function load_tasks(viewAll=false) { //function to get either pending or done tasks
    // await sleep(1);
    let size = Object.keys(tasks['pending']).length - 1; //number of all pending tasks
    let limit = updatePendingContainer(size, viewAll);
    $('#pending-container').empty();
    $.ajax({
        type: 'POST',
        url: 'http://localhost/project/api/task/get_all.php',
        data: {
            'user_id': user_id,
            'name': null,
            'pending': tasks['pending'],
            'all': null
        },
        success: function (data) {   //returns dictionary with categories as keys for task arrays
            document.getElementById('pending-container').innerHTML = "";
            if (data) {
                let cards = [];
                data = data['health_tasks'].concat(data['creativity_tasks'], data['productivity_tasks']);
                data = data.sort(() => Math.random() - 0.5);
                for (x = 0; x < limit; x++) {
                    let background = `` + gradients[data[x]['category']] + `,url('./assets/` + data[x]['category'] + `.png')`;
                    let card = `
                    <div class="task-card task-card-animation" id=`+ data[x]['id'] + `>
                    <div class="task-card-overlay">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg red" viewBox="0 0 16 16" onClick="donePendingTask(`+ data[x]['id'] + `, true);">
                            <path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-check-lg green" viewBox="0 0 16 16" onClick="donePendingTask(`+ data[x]['id'] + `);">
                            <path d="M13.485 1.431a1.473 1.473 0 0 1 2.104 2.062l-7.84 9.801a1.473 1.473 0 0 1-2.12.04L.431 8.138a1.473 1.473 0 0 1 2.084-2.083l4.111 4.112 6.82-8.69a.486.486 0 0 1 .04-.045z"/>
                        </svg>
                    </div>
                    <div class="top" style="background: `+ background + `"></div>
                    <div class="card-body">
                    <div class="content">
                        <h3>`+ data[x]['name'] + `</h3>
                        <h5>`+ tasks['pending'][data[x]['id']]['date_created'] + `</h5>
                    </div>
                    <div class="container-card-footer">
                    <button>`+ data[x]['category'] + `</button>
                    </div>
                    </div>
                </div>
                    `;
                    cards.push(card);
                }
                cards.forEach((element,i) => {
                    setTimeout(
                        function(){
                            $('#pending-container').append(element);
                        }
                    , i * 200);
                });
            }
            // else condition empty pending
        }
    });
}

function openSidebar() {
    let sidebar = document.getElementById('sidebar');
    if (sidebar.style.display == "flex") {
        sidebar.style.display = "none";
        document.getElementById('main-body').style.maxHeight = "initial";
        document.getElementById('main-body').style.overflow = "initial";
        document.getElementById('appname1').style.display = "initial";
        document.getElementById('appname2').style.display = "initial";
    }
    else {
        sidebar.style.display = "flex";
        document.getElementById('hamburger').style.display = "block";
        document.getElementById('main-body').style.maxHeight = "91vh";
        document.getElementById('main-body').style.overflow = "hidden";
        document.getElementById('appname1').style.display = "none";
        document.getElementById('appname2').style.display = "none";
    }
}

function displayWindowSize(){
    let width = document.documentElement.clientWidth;
    let sidebar = document.getElementById('sidebar');
    document.getElementById('main-body').style.maxHeight = "fit-content";
    document.getElementById('main-body').style.overflow = "auto";
    if (width >= 800) {
        sidebar.style.display = "flex";
        sidebar.style.width = "24%";
        document.getElementById('hamburger').style.display = "none";
        document.getElementById('appname1').style.display = "block";
        document.getElementById('appname2').style.display = "block";
        document.getElementById('navbar').style.display = "none";
    }
    else {
        sidebar.style.display = "none";
        document.getElementById('navbar').style.display = "flex";
        document.getElementById('appname1').style.display = "block";
        document.getElementById('appname2').style.display = "block";
    }
}

window.addEventListener("resize", displayWindowSize);


function logout() {
    user_id = null;
    username = null;
    tasks = null;
    stats = null;
    window.name = '';
    location.href = './index.php';

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
        title: 'Logged out!'
    })
}

function add_pending(task_id, recommended = false) { //add to pending tasks
    let currentdate = getCurrentDate();
    var date_created = currentdate.monthNum + "/" + currentdate.date
        + "/" + currentdate.year;
    tasks['pending'][task_id] = { 'date_created': date_created };
    update();

    $.ajax({
        type: 'POST',
        url: 'http://localhost/project/api/task/get.php',
        data: {
            'id': task_id
        },
        success: function (data) {
            let pendingSize = Object.keys(tasks.pending).length;
            let limit = updatePendingContainer(pendingSize-1);
            if (pendingSize < 10 || limit > 8) {
            let background = `` + gradients[data.category] + `,url('./assets/` + data.category + `.png')`;
            let card = `
                <div class="task-card task-card-animation" id=`+ data.id + `>
                <div class="task-card-overlay">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg red" viewBox="0 0 16 16" onClick="donePendingTask(`+ data.id + `, true);">
                        <path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-check-lg green" viewBox="0 0 16 16" onClick="donePendingTask(`+ data.id + `);">
                        <path d="M13.485 1.431a1.473 1.473 0 0 1 2.104 2.062l-7.84 9.801a1.473 1.473 0 0 1-2.12.04L.431 8.138a1.473 1.473 0 0 1 2.084-2.083l4.111 4.112 6.82-8.69a.486.486 0 0 1 .04-.045z"/>
                    </svg>
                </div>
                <div class="top" style="background: `+ background + `"></div>
                <div class="card-body">
                <div class="content">
                    <h3>`+ data.name + `</h3>
                    <h5>`+ tasks['pending'][task_id]['date_created'] + `</h5>
                </div>
                <div class="container-card-footer">
                <button>`+ data.category + `</button>
                </div>
                </div>
                </div>
            `
            $('#pending-container').append(card);
            }
            add_history(data['name'], 'Added');

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
                title: 'Task Added!'
            })
        }
    });
    if(recommended) {
        load_recommended();
    }
    else if (document.getElementById('search_task').value != "") {
        search_task();
    }
    else {
        filter_tasks();
    }
}

function update() {// updates user stats and tasks in database
    $.ajax({
        type: 'POST',
        url: 'http://localhost/project/api/user/update.php',
        data: {
            'id': user_id,
            'level': level,
            'tasks': JSON.stringify(tasks),
            'stats': JSON.stringify(stats)
        },
        success: function (response) {
        }
    });
}

function donePendingTask(task_id, cancel = false) { //complete task in pending
    let currentdate = getCurrentDate();
    let date_finished = currentdate.monthNum + currentdate.date
        + "/" + currentdate.year;
    let action = (cancel) ? "Cancelled" : "Done";
    $.ajax({
        type: 'POST',
        url: 'http://localhost/project/api/task/get.php',
        data: {
            'id': task_id
        },
        success: function (data) { //returns task details from tasks table
            // document.getElementById(task_id).remove();
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
            if (!cancel) {
                tasks['done']+=1;
                stats[data['category']] = parseInt(stats[data['category']]) + parseInt(data['value']); //increases stat values
                level = 1 + Math.floor((stats['productivity'] + stats['creativity'] + stats['health']) / 10);
                loadStats();

                Toast.fire({
                    icon: 'success',
                    title: 'Task Done!'
                })
            }
            else{
                Toast.fire({
                    icon: 'error',
                    title: 'Task Cancelled!'
                })
            }
            delete tasks['pending'][task_id];
            // load_tasks();
            document.getElementById(task_id).classList.remove("task-card-animation");
            document.getElementById(task_id).className += " task-card-animation2";
            console.log(document.getElementById(task_id).className);

            setTimeout(function(){
                let currSize = Object.keys(tasks.pending).length-1
                let limit = updatePendingContainer(currSize);
                if (currSize > 7 && limit == 8){
                    load_tasks();
                }
                else {
                    document.getElementById(task_id).remove();
                }
            }, 500);
            load_recommended();
            update();
            add_history(data['name'], action);

        }
    });
}

function loadStats() {
    document.getElementById('user-currLevel').innerHTML = "Level " + level;
    let gain = (stats['productivity'] + stats['creativity'] + stats['health']) % 10;
    let gainWidth = gain*10;
    document.getElementById('level-bar').style.borderRadius = "0 1em 1em 0";
    document.getElementById('level-gain').style.borderRadius = "1em 0 0 1em";
    if (gain==0) {
        document.getElementById('level-bar').style.borderRadius = "1em";
        document.getElementById('level-gain').style.borderRadius = "1em";
    }
    document.getElementById('level-bar').style.width = ``+ 100 - gainWidth +`%`;
    document.getElementById('level-gain').style.width = ``+gainWidth+`%`;
    document.getElementById('user-productivity').innerHTML = stats['productivity'];
    document.getElementById('user-creativity').innerHTML = stats['creativity'];
    document.getElementById('user-health').innerHTML = stats['health'];
}

function openBrowseTasks() {
    document.getElementById('browseTasks').style.display = "block";
    filter_tasks();
}

function closeBrowseTasks() {
    document.getElementById('browseTasks').style.display = "none";
}


function closeCustomTask() {
    document.getElementById('customTask').style.display = "none";
}

function openCustomTask() {
    document.getElementById('customTask').style.display = "block";
    document.getElementById('titleCreate').value = '';
}

function sliderDrag(val) {
    let sliderDisplay = document.getElementById('rangeValue');
    sliderDisplay.innerHTML = val;
}

function viewDropdownCategories() {
    let dropdownContent = document.getElementById('dropdown-categoryContent');
    let dropdownButton = document.getElementById('button-dropdownCategories');

    if (dropdownContent.style.display == "block") {
        dropdownContent.style.display = "none";
        dropdownButton.style.borderRadius = "0 0 0.8em 0.8em";
    }
    else {
        dropdownContent.style.display = "block";
        dropdownButton.style.borderRadius = "0";
    }
}

function selectedDropDown(value) {
    let dropdownButton = document.getElementById('button-dropdownCategories');
    dropdownButton.innerHTML = value;

    viewDropdownCategories();
}

function viewTaskHistory() {
    let screenTaskHistory = document.getElementById('taskHistory');

    if (screenTaskHistory.style.display == "block") {
        screenTaskHistory.style.display = "none";
    }
    else {
        screenTaskHistory.style.display = "block";
        get_history();
    }
}

function sliderDrag(val) {
    let sliderDisplay = document.getElementById('rangeValue');

    sliderDisplay.innerHTML = "Value: " + val;
}

function create_task() {
    document.getElementById('customTask').style.display = "none";
    let task_name = document.getElementById('titleCreate').value;
    let val = document.getElementById('rangeSlider').value;
    $.ajax({
        type: 'POST',
        url: 'http://127.0.0.1/project/api/task/create.php',
        data: {
            'name': task_name,
            'description': '',
            'category': document.getElementById('dropdown-category').value,
            'value': val,
            'creator': user_id
        },
        success: function (response) {
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
                title: 'Task Created!'
            })
        }
    });
}

function getCurrentDate() {
    let today = new Date();
    var day = days[today.getDay()];
    let month = months[today.getMonth()];
    let date = today.getDate();
    let year = today.getFullYear();
    let monthNum = today.getMonth() + 1;

    return { "day": day, "date": date, "year": year, "month": month, "monthNum": monthNum }
}

function updatePendingContainer(size,viewAll=false) {
    let limit = size;
    if (size > 0) {
        document.getElementById('noPendingTask').style.display = "none";
        if (size > 8) {
            if (viewAll) {
                document.getElementById('viewLessPendingTasks').style.display = "block";
                document.getElementById('viewAllPendingTasks').style.display = "none";
                limit = size;
            }
            else {
                document.getElementById('viewAllPendingTasks').style.display = "block";
                document.getElementById('viewLessPendingTasks').style.display = "none";
                limit = 8;
            }
        }
        else {
            document.getElementById('viewAllPendingTasks').style.display = "none";
            document.getElementById('viewLessPendingTasks').style.display = "none";
        }
    }
    else {
        document.getElementById('noPendingTask').style.display = "flex";
    }

    return limit;
}

function add_history(task_name, action) {
    console.log('history')
    let size = Object.keys(tasks['pending']).length - 1;
    
    if (action == "Added"){
        document.getElementById('today-pending').innerHTML = size;
        console.log('added');
    }
    else if(action == "Cancelled") {
        document.getElementById('today-pending').innerHTML = size;
    }
    else if(action == "Done") {
        document.getElementById('today-pending').innerHTML = size;
        document.getElementById('today-done').innerHTML = tasks['done'];
    }
    $.ajax({
        type: 'POST',
        url: 'http://localhost/project/api/history/create.php',
        data: {
            'task_name': task_name,
            'action': action,
            'user_id': user_id
        },
        success: function(response) { //returns boolean value
            // console.log(response);
        }
    });
}

function get_history() {
    $.ajax({
        type: 'POST',
        url: 'http://localhost/project/api/history/get_all.php',
        data: {
            'user_id': user_id
        },
        success: function(history) {
            $('#container-taskHistory').empty();
            let content = "";
            for (date in history) {
                var sD = date.split(/[- :]/);
                var formattedDate = new Date(Date.UTC(sD[0], sD[1]-1, sD[2]));
                content += `<h2>`+ days[formattedDate.getDay()] +`, `+ months[formattedDate.getMonth()] +` `+ formattedDate.getDate() +`</h2> <hr>`;
                for (let x=0; x<Object.keys(history[date]).length; x++) {
                    if (history[date][x]) {
                        content += `<div class='taskHistory-item'> 
                        <p class='bg-`+history[date][x].action+`'> `+ history[date][x].action +` </p> 
                        <p>`+ history[date][x].task_name +`</p></div>
                        `;
                    }
                }
            }
            $('#container-taskHistory').append(content);
        }
    });
}

//end of new codes