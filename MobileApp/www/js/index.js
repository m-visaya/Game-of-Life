/*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */

// Wait for the deviceready event before using any of Cordova's device APIs.
// See https://cordova.apache.org/docs/en/latest/cordova/events/events.html#deviceready
document.addEventListener('deviceready', onDeviceReady, false);

function onDeviceReady() {
    // Cordova is now initialized. Have fun!

    console.log('Running cordova-' + cordova.platformId + '@' + cordova.version);
    document.getElementById('deviceready').classList.add('ready');
}


//login switcher buttons

function swlogin(){
    var state = document.getElementById("splash")
    var state2 = document.getElementById("login")
    if (state.style.display !== "none" && state2.style.display === "none" ){
        state.style.display = "none"
        state2.style.display ="block"
        console.log("splash none login block");
    }
}

function swsignup(){
    var state = document.getElementById("splash")
    var state2 = document.getElementById("signup")
    if (state.style.display !== "none" && state2.style.display === "none" ){
        state.style.display = "none"
        state2.style.display ="block"
        console.log("splash none signup block");
    }
}

function swsignuptologin(){
    var state = document.getElementById("signup")
    var state2 = document.getElementById("login")
    var state3 = document.getElementById("splash")
    if ((state2.style.display === "none" && state3.style.display === "none" )&& state.style.display !== "none"){
        state.style.display = "none"
        state2.style.display ="block"
        state3.style.display ="none"
        console.log("signup done, switched to login");

        Swal.fire({
            position: 'center',
            icon: 'success',
            width: '15rem',
            title: 'Account Created',
            showConfirmButton: false,
            timer: 1500
        })
    }
}

function swreturn(){
    var state = document.getElementById("splash")
    var state2 = document.getElementById("login")
    var state3 = document.getElementById("signup")
    if (state.style.display === "none" && (state2.style.display !== "none" || state3.style.display !== "none") ){
        state.style.display = "block"
        state2.style.display ="none"
        state3.style.display ="none"
        console.log("splash block login signup none");
    }
}

// ajax

function signup(){
    if(!document.getElementById("s-name").value || !document.getElementById("s-pass").value) {
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
        url: 'http://10.0.2.2:80/project/api/user/create.php',
        data: {
            'username': document.getElementById("s-name").value, //change to text field input
            'password': document.getElementById("s-pass").value //change to text field input
        },
        success: function(data) { //returns user details if username and password matches a record
            console.log(data);
            if(data){
                console.log('Account Created');
                swsignuptologin();
            }
            else{
                console.log('Invalid Account')
            }
        }
    });
}

function login(){
    if(!document.getElementById("l-name").value || !document.getElementById("l-pass").value) {
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
        url: 'http://10.0.2.2:80/project/api/user/get.php',
        data: {
            'username': document.getElementById("l-name").value, //change to text field input
            'password': document.getElementById("l-pass").value //change to text field input
        },
        success: function(data) { //returns user details if username and password matches a record
            console.log(data);
            if(data){
                console.log("Logged In Successfully");
                window.name = data['id'];
                location.href = './main.html';
            }
            else{
                console.log("Invalid Account");
                alert("invalidcredentials");
            }
        }
    });
}
