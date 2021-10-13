var user_id;
var username;
var tasks;
var stats;
var level;

validate();

function validate() { //function for log in
    // if (window.name == ''){
    //     location.href = './index.php';
    //     return;
    // }
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
            stats = JSON.parse(data['stats']);
            level = data['level'];
            load_recommended();
        }
    });
}

function load_tasks() { //function to get either pending or done tasks
    let y=Object.keys(tasks['pending']).length-1; //number of all pending tasks
    let limit = y; //constant

    if (y>0) {
        // tanggal buwan
    }

    if (y==0) {
        // display buwan
    }

    $.ajax({
        type: 'POST',
        url: 'http://10.0.2.2:80/project/api/task/get_all.php',
        data: {
            'id':user_id,
            'pending': tasks['pending'],
            'all':null
        },
        success: function(data) {   //returns dictionary with categories as keys for task arrays
            console.log(data);
            document.getElementById('pend-holder').innerHTML = "";
            if(data) {
                data = data['health_tasks'].concat(data['creativity_tasks'], data['productivity_tasks']);
                $('#pend-holder').empty();
                cards = '';
                len = Object.keys(data).length;
                for (x=0;x<len;x++) {
                    cards+=
                    `
                    <div class="card shadow-sm" style="margin-top: 10px; border-radius: 15px;">
                    <img src="https://media.discordapp.net/attachments/760757739780571146/895519519630585866/productivity_orange.png?width=757&height=426" class="card-img-top" style="background:linear-gradient(rgba(255, 195, 113, 0.25), rgba(255, 95, 109, 0.25)); border-top-left-radius:15px;border-top-right-radius:15px;">
                        <div class="card-body">
                            <h5 class="card-title">`+data[x]['name']+`</h5>
                            <h6 class="card-text">`+tasks['pending'][data[x]['id']]['date_created']+`</h6>
                            <span class="btn btn-grey rounded-pill mt-2" onclick="donePendingTask(`+data[x]['id']+`, true);">Cancel</span>
                            <span class="btn btn-orange rounded-pill mt-2" onclick="donePendingTask(`+data[x]['id']+`);">Done</span>
                            <h6 class="card-subtitle text-end"><span class="badge badge-bg-orange">`+data[x]['category']+`</span></h6>
                            
                        </div>
                    </div>
                    `
                }
                $('#pend-holder').append(cards)
            }
            // else condition empty pending
        }
    });
}

function selectTag(e) {
    let button = document.getElementById(e);
    let bgColor = window.getComputedStyle(button).backgroundColor;
    if (bgColor == "rgb(117, 117, 117)") {
        button.style.backgroundColor = "rgb(255, 95, 36)";
        button.value = true;
    }   else {
        button.style.backgroundColor = "rgb(117, 117, 117)";
        button.value = false;
    }
    if(document.getElementById('brws_search').value != ""){
        search_task();
    }
    else{
        filter_tasks();
    }
}

function search_task() { //function to search task
    var task_name = document.getElementById('brws_search').value;
    if (!task_name) {
        return;
    }
    $.ajax({
        type: 'POST',
        url: 'http://10.0.2.2:80/project/api/task/get_all.php',
        data: {
            'name':task_name,
            'user_id':user_id,
            'pending': tasks['pending']
        },
        success: function(data) {
            load_browse(data);
        }
    });
}

function filter_tasks() { //function to get all tasks from tasks table
    $.ajax({
        type: 'POST',
        url: 'http://10.0.2.2:80/project/api/task/get_all.php',
        data: {
            'user_id':user_id,
            'pending': tasks['pending'],
            'all':true
        },
        success: function(data) {   //returns dictionary with categories as keys for task arrays
            load_browse(data);
        }
    });
}

function load_recommended() { //function to get all tasks from tasks table
    $.ajax({
        type: 'POST',
        url: 'http://10.0.2.2:80/project/api/task/get_all.php',
        data: {
            'user_id':user_id,
            'pending': tasks['pending'],
            'all':true
        },
        success: function(data) {   //returns dictionary with categories as keys for task arrays
            document.getElementById('rec-holder').innerHTML = "";
            if(data) {
                temp_stats = {'health':stats['health'], 'productivity':stats['productivity'], 'creativity':stats['creativity']}
                console.log(data);
                x=0;
                while (Object.keys(temp_stats).length > 0) {
                    key = Object.keys(temp_stats).reduce((key, v) => temp_stats[v] < temp_stats[key] ? v : key);
                    console.log(temp_stats);
                    if (Object.keys(data[key + "_tasks"]).length > 0) {
                        data = data[key + "_tasks"];
                        break;
                    }
                    delete temp_stats[key];
                    x++;
                }
                console.log(data);
                
                cards = '';
                for (x=0;x<Object.keys(data).length;x++) {
                    cards+=
                    `
                    <div class="card shadow-sm" style="margin-top: 10px; border-radius: 15px;">
                    <img src="https://media.discordapp.net/attachments/760757739780571146/895519519630585866/productivity_orange.png?width=757&height=426" class="card-img-top" style="background:linear-gradient(rgba(251, 200, 212, 0.45), rgba(151, 149, 240, 0.2)); border-top-left-radius:15px;border-top-right-radius:15px;">
                        <div class="card-body">
                            <h5 class="card-title">`+data[x]['name']+`</h5>
                            <span class="btn btn-orange rounded-pill mt-3" onclick="add_pending(`+data[x]['id']+`)">Add Task</span>
                            <h6 class="card-subtitle text-end"><span class="badge badge-bg-orange">`+data[x]['category']+`</span></h6>
                        </div>
                    </div>
                    `
                }
                $('#rec-holder').append(cards)
            }
        }
    });
}

function load_browse(data) {
    data2 = [];
    if (document.getElementById('tag-productivity').value == 'true') {
        data2 = data2.concat(data['productivity_tasks']);
    };
    if (document.getElementById('tag-health').value == 'true') {
        data2 = data2.concat(data['health_tasks']);
    };
    if (document.getElementById('tag-creativity').value == 'true') {
        data2 = data2.concat(data['creativity_tasks']);
    };
    
    let cards = '';
    document.getElementById('browse-holder').innerHTML = "";
    for (let x=0;x<data2.length;x++) {
        cards +=
        `
        <div class="card shadow-sm" style="margin-top: 10px; border-radius: 15px;">
            <div class="card-body">
                <h5 class="card-title mt-2">`+data2[x]['name']+`</h5>
                <span class="btn btn-orange rounded-pill mt-3" onclick="add_pending(`+data2[x]['id']+`)" >Add Task</span>
                <h6 class="card-subtitle text-end"><span class="badge badge-bg-orange">`+data2[x]['category']+`</span></h6>
            </div>
        </div>
        `
    }
    $('#browse-holder').append(cards)
}

function add_pending(task_id) { //add to pending tasks
    let currentdate = getCurrentDate();
    var date_created = currentdate.monthNum + "/" + currentdate.date
        + "/" + currentdate.year;
    tasks['pending'][task_id] = {'date_created':date_created};
    update();

    $.ajax({
        type: 'POST',
        url: 'http://10.0.2.2:80/project/api/task/get.php',
        data: {
            'id': task_id,
        },
        success: function(data) {
            add_history(data['name'], 'Added');
        }
    });
    
    if(document.getElementById("rcmd-tab").style.display === "block"){
        load_recommended();
    }
    else if(document.getElementById('brws_search').value != ""){
        search_task();
    }
    else{
        filter_tasks();
    }
}

function update() {// updates user stats and tasks in database
    $.ajax({
        type: 'POST',
        url: 'http://10.0.2.2:80/project/api/user/update.php',
        data: {
            'id': user_id,
            'level': level,
            'tasks': JSON.stringify(tasks),
            'stats': JSON.stringify(stats)
        },
        success: function(response) {
            console.log(response);
        }
    });
}

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms*100));
}

function donePendingTask(task_id, cancel=false) { //complete task in pending
    let currentdate = getCurrentDate();
    var date_finished = currentdate.monthNum + "/" + currentdate.date
        + "/" + currentdate.year;
    let action = (cancel) ? "Cancelled" : "Done";
    $.ajax({
        type: 'POST',
        url: 'http://10.0.2.2:80/project/api/task/get.php',
        data: {
            'id':task_id
        },
        success: function(data) { //returns task details from tasks table
            // document.getElementById(task_id).remove();
            if(!cancel) {
                tasks['done'][task_id] = tasks['pending'][task_id];
                tasks['done'] += 1;
                stats[data['category']] = parseInt(stats[data['category']]) + parseInt(data['value']); //increases stat values
                // loadStats();
                level = 1 + Math.floor((stats['productivity'] + stats['creativity'] + stats['health']) / 10);
            }
            delete tasks['pending'][task_id];
            update();
            load_tasks();
            add_history(data['name'], action);
        }
    });
}

function getCurrentDate() {
    let today = new Date();
    let months = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"];
    var days = ["Sunday", "Monday", "Tuesday", "Wedneday", "Thursday", "Friday", "Saturday"];
    var day = days[today.getDay()];
    let month = months[today.getMonth()];
    let date = today.getDate();
    let year = today.getFullYear();
    let monthNum = today.getMonth() + 1;

    return { "day": day, "date": date, "year": year, "month": month, "monthNum": monthNum }
}

function add_history(task_name, action) {
    $.ajax({
        type: 'POST',
        url: 'http://10.0.2.2:80/project/api/history/create.php',
        data: {
            'task_name': task_name,
            'action': action,
            'user_id': user_id
        },
        success: function(response) { //returns boolean value
            console.log(response);
        }
    });
}

function swpend(){
    load_tasks();
    var state = document.getElementById("pend-tab")
    var state2 = document.getElementById("rcmd-tab")
    var state3 = document.getElementById("brws-tab")
    var state4 = document.getElementById("pend-btn")
    var state5 = document.getElementById("rcmd-btn")
    var state6 = document.getElementById("brws-btn")
    var state7 = document.getElementById("navbartop")
    var state8 = document.getElementById("searchbartop")
    if ((state2.style.display !== "none"|| state3.style.display !== "none") && state.style.display === "none" ){
        state.style.display = "block"
        state2.style.display ="none"
        state3.style.display ="none"
        state4.style.color ="#FF5F24"
        state5.style.color ="#353535"
        state6.style.color ="#353535"
        state7.style.zIndex="1"
        state8.style.zIndex="0"
        console.log("swpend() done");
    }
}

function swbrws(){
    filter_tasks();
    var state = document.getElementById("brws-tab")
    var state2 = document.getElementById("rcmd-tab")
    var state3 = document.getElementById("pend-tab")
    var state4 = document.getElementById("brws-btn")
    var state5 = document.getElementById("rcmd-btn")
    var state6 = document.getElementById("pend-btn")
    var state7 = document.getElementById("navbartop")
    var state8 = document.getElementById("searchbartop")
    if ((state2.style.display !== "none"|| state3.style.display !== "none") && state.style.display === "none" ){
        state.style.display = "block"
        state2.style.display ="none"
        state3.style.display ="none"
        state4.style.color ="#FF5F24"
        state5.style.color ="#353535"
        state6.style.color ="#353535"
        state7.style.zIndex="0"
        state8.style.zIndex="1"
        console.log("swpend() done");
    }
}

function swrcmd(){
    load_recommended();
    var state = document.getElementById("rcmd-tab")
    var state2 = document.getElementById("brws-tab")
    var state3 = document.getElementById("pend-tab")
    var state4 = document.getElementById("rcmd-btn")
    var state5 = document.getElementById("brws-btn")
    var state6 = document.getElementById("pend-btn")
    var state7 = document.getElementById("navbartop")
    var state8 = document.getElementById("searchbartop")
    if ((state2.style.display !== "none"|| state3.style.display !== "none") && state.style.display === "none" ){
        state.style.display = "block"
        state2.style.display ="none"
        state3.style.display ="none"
        state4.style.color ="#FF5F24"
        state5.style.color ="#353535"
        state6.style.color ="#353535"
        state7.style.zIndex="1"
        state8.style.zIndex="0"
        console.log("swpend() done");
    }
}

function to_create() {
    window.name = user_id;
    location.href = './create.html';
}

function to_profile() {
    window.name = user_id;
    location.href = './profile.html';
}