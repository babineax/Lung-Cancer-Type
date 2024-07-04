const progressbar = document.querySelector(".circle1");
const progressbar1 = document.querySelector(".circle2");
const progressbar2 = document.querySelector(".circle3");
const progressbar3 = document.querySelector(".circle4");

let progress = 0;

const ctxAccuracy = document.getElementById('accuracyChart').getContext('2d');
const ctxLoss = document.getElementById('lossChart').getContext('2d');

const accuracyData = {
    labels: ['Training', 'Validation'],
    datasets: [
        {
            label: 'Accuracy',
            backgroundColor: ['rgba(54, 162, 235, 0.6)', 'rgba(75, 192, 192, 0.6)'],
            borderColor: ['rgba(54, 162, 235, 1)', 'rgba(75, 192, 192, 1)'],
            borderWidth: 1,
            data: [0.3293, 0.3810]
        }
    ]
};

const lossData = {
    labels: ['Training', 'Validation'],
    datasets: [
        {
            label: 'Loss',
            backgroundColor: ['rgba(255, 99, 132, 0.6)', 'rgba(153, 102, 255, 0.6)'],
            borderColor: ['rgba(255, 99, 132, 1)', 'rgba(153, 102, 255, 1)'],
            borderWidth: 1,
            data: [1.3645, 1.3411]
        }
    ]
};

new Chart(ctxAccuracy, {
    type: 'bar',
    data: accuracyData,
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

new Chart(ctxLoss, {
    type: 'bar',
    data: lossData,
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});



function iom (progress,p){

    simulateProgress(progress,p);
    enableProgessBar(progress,p);
}

function enableProgessBar(s,m) {
  /* if JS is working, we'll enable the progess bar */
  /* all the styling for it comes from the role="progressbar" */
  /* and having that removes the no-js message */
  /* min of 0 and max of 100 are defaults, so we don't need aria-valuemin or -valuemax */
  m.setAttribute("role", "progressbar");
  m.setAttribute("aria-valuenow", s);
  m.setAttribute("aria-live", "polite");
}



// for simulating stuff when we click the buttons
const testingGround = document.querySelector(".testing-ground");
let interval = null;

function simulateProgress(newProgressValue,r) {
  clearInterval(interval);
  if (newProgressValue === "fake-upload") {
    simulateUpload(r);
  } else {
    updateProgress(newProgressValue,r);
  }
}


function updateProgress(progress,t) {
  t.setAttribute("aria-valuenow", progress);
  t.style.setProperty("--progress", progress + "%");
}

function simulateUpload(g) {
  // aria-busy prevents it from announcing every change as it keeps updating the progress
  // make sure to set it false once the progress is finished
  g.setAttribute("aria-busy", "true");
  let progress = 0;
  updateProgress(progress,g);

  intervalTimer = setInterval(() => {
    progress += 1;
    updateProgress(progress,g);
    if (progress === 100) {
      // probably want something to catch errros and also have this set to false then too
      g.setAttribute("aria-busy", "false");
      clearInterval(intervalTimer);
    }
  }, 500);
}









const form = document.querySelector("form"),
fileInput = document.querySelector(".file-input"),
progressArea = document.querySelector(".progress-area"),
uploadedArea = document.querySelector(".uploaded-area");

// form click event
form.addEventListener("click", () =>{
  fileInput.click();
});

fileInput.onchange = ({target})=>{
  let file = target.files[0]; //getting file [0] this means if user has selected multiple files then get first one only
  if(file){
    let fileName = file.name; //getting file name
    if(fileName.length >= 12){ //if file name length is greater than 12 then split it and add ...
      let splitName = fileName.split('.');
      fileName = splitName[0].substring(0, 13) + "... ." + splitName[1];
    }
    uploadFile(fileName); //calling uploadFile with passing file name as an argument
  }
}

// file upload function
function uploadFile(name){
  let xhr = new XMLHttpRequest(); //creating new xhr object (AJAX)
  xhr.open("POST", "php/upload.php"); //sending post request to the specified URL
  xhr.upload.addEventListener("progress", ({loaded, total}) =>{ //file uploading progress event
    let fileLoaded = Math.floor((loaded / total) * 100);  //getting percentage of loaded file size
    let fileTotal = Math.floor(total / 1000); //gettting total file size in KB from bytes
    let fileSize;
    // if file size is less than 1024 then add only KB else convert this KB into MB
    (fileTotal < 1024) ? fileSize = fileTotal + " KB" : fileSize = (loaded / (1024*1024)).toFixed(2) + " MB";
    let progressHTML = `<li class="row">
                          <i class="fas fa-file-alt"></i>
                          <div class="content">
                            <div class="details">
                              <span class="name">${name} • Uploading</span>
                              <span class="percent">${fileLoaded}%</span>
                            </div>
                            <div class="progress-bar">
                              <div class="progress" style="width: ${fileLoaded}%"></div>
                            </div>
                          </div>
                        </li>`;
    // uploadedArea.innerHTML = ""; //uncomment this line if you don't want to show upload history
    uploadedArea.classList.add("onprogress");
    progressArea.innerHTML = progressHTML;
    if(loaded == total){
      progressArea.innerHTML = "";
      let uploadedHTML = `<li class="row">
                            <div class="content upload">
                              <i class="fas fa-file-alt"></i>
                              <div class="details">
                                <span class="name">${name} • Uploaded</span>
                                <span class="size">${fileSize}</span>
                              </div>
                            </div>
                            <i class="fas fa-check"></i>
                          </li>`;
      uploadedArea.classList.remove("onprogress");
      // uploadedArea.innerHTML = uploadedHTML; //uncomment this line if you don't want to show upload history
      uploadedArea.insertAdjacentHTML("afterbegin", uploadedHTML); //remove this line if you don't want to show upload history
    }
  });
  let data = new FormData(form); //FormData is an object to easily send form data
  xhr.send(data); //sending form data
}