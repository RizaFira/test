require 
var c = document.currentScript.getAttribute('server');
let url = 'http://127.0.0.1:8000/' + c;
// let xhr = new XMLHttpRequest();
// xhr.open("GET", url);
// xhr.send();
// xhr.onload = () => console.log(xhr.response);

//
fetch(url).then(function (response) {
    response.json().then(function (users) {
        users.forEach(function (user) {
            var a = [user.name];
            return a;



        });
    });
}).catch(err => console.error(err));
const data = [
    {
        name: 'Kiara',
        age: 40,
        letx: c
    }

];
window.addEventListener("DOMContentLoaded", function () {
    function Item(configurationObject) {
        apiCall(data);
    }
    function apiCall(data) {
        // Do some API call and get back the data
        // With the Unique ID that wass passed in via the
        // configuration Object
        // "data" is faked just for the demonstration
        createHTML(data);
    }

    function createHTML(data) {
        const mainDiv = document.createElement("div");
        document.body.appendChild(mainDiv);
        let html = '';

        data.forEach((user) => {
            html += `
                <body onload="startTime()" >>
            <div class="callout">
            <div class="callout-header">Test</div>
            <span class="closebtn" onclick="this.parentElement.style.display='none';">×</span>
            <div class="callout-container">
            <div class="col-md-6">
                 <h4>
                    <div class="float-right" id="date"></div>
                    <br>
                    <div class="float-right" id="time"></div>
                    </h4>
                </div>
                <p>ywgue uqygwweq biwqeuhyioqwey woeiqhwejqw oqwiehjqe oqwiejhoqi oqwikeh jqw </p>
                <a class='button' href="#">Learn more</a>
            </div>
            </div>
        </body>
          `;
        });

        mainDiv.innerHTML = html;

        createStylesheet();
    }

    function createStylesheet() {
        const style = document.createElement("style");
        style.innerHTML = `
      body {font-family: Arial, Helvetica, sans-serif;}

      .callout {
        position: fixed;
        bottom: 35px;
        right: 20px;
        margin-left: 20px;
        max-width: 300px;
      }

      .callout-header {
        padding: 25px 15px;
        background: #555;
        font-size: 30px;
        color: white;
      }

      .callout-container {
        padding: 15px;
        background-color: #ccc;
        color: black
      }

      .closebtn {
        position: absolute;
        top: 5px;
        right: 15px;
        color: white;
        font-size: 30px;
        cursor: pointer;
      }

      .closebtn:hover {
        color: lightgrey;
      }
      `;

        document.head.appendChild(style);
    }

    let configurationObject = {
        uniqueID: 1234
    }

    let initialize = new Item(configurationObject);
});
function startTime() {
    const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu'];
    const bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    const today = new Date();
    let day = today.getDay();
    let date = today.getDate();
    let month = today.getMonth();
    let year = today.getFullYear();
    let h = today.getHours();
    let m = today.getMinutes();
    let s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('date').innerHTML = days[day] + ", " + date + " " + bulan[month] + " " + year;
    document.getElementById('time').innerHTML = h + ":" + m + ":" + s;
    setTimeout(startTime, 1000)
}
function checkTime(i) {
    if (i < 10) { i = "0" + i };
    return i;
}

