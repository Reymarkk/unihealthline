const body = document.querySelector("body"),
      modeToggle = body.querySelector(".mode-toggle");
      sidebar = body.querySelector("nav");
      sidebarToggle = body.querySelector(".sidebar-toggle");

let getMode = localStorage.getItem("mode");
if(getMode && getMode ==="dark"){
    body.classList.toggle("dark");
}

let getStatus = localStorage.getItem("status");
if(getStatus && getStatus ==="close"){
    sidebar.classList.toggle("close");
}

modeToggle.addEventListener("click", () =>{
    body.classList.toggle("dark");
    if(body.classList.contains("dark")){
        localStorage.setItem("mode", "dark");
    }else{
        localStorage.setItem("mode", "light");
    }
});

sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    if(sidebar.classList.contains("close")){
        localStorage.setItem("status", "close");
    }else{
        localStorage.setItem("status", "open");
    }
})

// for checkbox, stays checked on refresh
/*
var checkboxes = document.querySelectorAll('input[type="checkbox"]');

// On document ready event, set the initial states of the checkboxes
document.addEventListener('DOMContentLoaded', function () {
  checkboxes.forEach(function (checkbox) {
    this.checked = window.localStorage.getItem(checkbox.id) || false;
  });
});

// When checkbox state is changed, save it to the localStorage
checkboxes.forEach(function (checkbox) {
  checkbox.addEventListener('change', function () {
    window.localStorage.setItem(this.id, this.value);
  });
});
*/
/*
jQuery(function($) {
    var checkboxValue = JSON.parse(localStorage.getItem('checkboxValue')) || {}
    var $checkbox = $("#checkbox-container :checkbox");

    $checkbox.on("change", function() {
      $checkbox.each(function() {
        checkboxValue[this.id] = this.checked;
      });
      localStorage.setItem("checkboxValue", JSON.stringify(checkboxValue));
    });

    //on page load
    $.each(checkboxValue, function(key, value) {
      $("#" + key).prop('checked', value);
    });
  });
*/

document.addEventListener("DOMContentLoaded", function() {
    // Iterate through each checkbox
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(function(checkbox) {
      // Retrieve checkbox state from local storage
      var checkboxId = checkbox.getAttribute("id");
      var isChecked = localStorage.getItem(checkboxId) === "true";

      // Set checkbox state
      checkbox.checked = isChecked;
    });
  });

  // Save checkbox state to local storage on change
  var checkboxes = document.querySelectorAll('input[type="checkbox"]');
  checkboxes.forEach(function(checkbox) {
    checkbox.addEventListener("change", function() {
      var checkboxId = this.getAttribute("id");
      localStorage.setItem(checkboxId, this.checked);
    });
  });