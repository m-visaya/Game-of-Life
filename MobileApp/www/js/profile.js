var user_id;
var username;
var tasks;
var stats;
var level;
var gain;
var gainWidth;

var months = ["January", "February", "March", "April", "May", "June",
"July", "August", "September", "October", "November", "December"];
var days = ["Sunday", "Monday", "Tuesday", "Wedneday", "Thursday", "Friday", "Saturday"];

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
            stats = JSON.parse(data['stats']);
            tasks = JSON.parse(data['tasks']);
            document.getElementById('username').innerHTML = data['username'];
            document.getElementById('level').innerHTML += " "+data['level'];
            document.getElementById('completed_tasks').innerHTML += " "+tasks['done'];
            document.getElementById('health').innerHTML = stats['health'];
            document.getElementById('productivity').innerHTML = stats['productivity'];
            document.getElementById('creativity').innerHTML = stats['creativity'];
            let gain = (stats['productivity'] + stats['creativity'] + stats['health']) % 10;
            gainWidth = gain*10;
            document.getElementById('level-bar').style.width = gainWidth+"%";
        }
    });
}

//profile switcher buttons

function swtaskdone(){
    var state = document.getElementById("profile")
    var state2 = document.getElementById("show-history")
    if (state.style.display !== "none" && state2.style.display === "none" ){
        state.style.display = "none"
        state2.style.display ="block"
        console.log("task done switched");
    }

    $.ajax({
        type: 'POST',
        url: 'http://10.0.2.2:80/project/api/history/get_all.php',
        data: {
            'user_id': user_id
        },
        success: function(history) { //returns boolean value
            document.getElementById('cards-history').innerHTML = "";
            
            cards = '';
            console.log(history);
            for (date in history) {
                var sD = date.split(/[- :]/);
                var formattedDate = new Date(Date.UTC(sD[0], sD[1]-1, sD[2]));
                content = days[formattedDate.getDay()]+`, `+ months[formattedDate.getMonth()] +` `+ formattedDate.getDate();
                cards += `<div class="card shadow-sm" style="padding: 25px; border-radius: 15px; margin-top: 10px;"><h4>`+content+`</h4>`;
                for(x=0; x<=Object.keys(history[date]).length-1; x++){
                    cards+=
                    `<div class="card" style="margin-top: 10px; border-radius: 15px;">
                        <div class="card-body">
                            <h5 class="card-title mt-2">`+history[date][x]['task_name']+`</h5>
                            <h6 class="card-text mt-3 text-muted">`+history[date][x]['action']+`</h6>
                        </div>
                    </div> `
                }
                cards += `</div>`
            }
            $('#cards-history').append(cards);
        }
    });
    
}


function swreturnprofile(){
    var state = document.getElementById("show-history")
    var state2 = document.getElementById("profile")
    if (state.style.display !== "none" && state2.style.display === "none" ){
        state.style.display = "none"
        state2.style.display ="block"
        console.log("profile returned");
    }
}

function logout() {
    location.href = './index.html';
}

// function to_main() {
//     window.name = user_id;
//     location.href = './main.html';
// }

