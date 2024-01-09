document.addEventListener("DOMContentLoaded", function() {
    var slideUpElements = document.querySelectorAll(".slide-up-element");
    
    function runAnimation(element) {
      element.style.opacity = 1;
      element.style.transform = "translateY(0)";
    }
  
    slideUpElements.forEach(function(element) {
      setTimeout(function() {
        runAnimation(element);
      }, 0); // 適宜遅延時間を調整
    });
  });

  document.addEventListener("DOMContentLoaded", function() {
    var slideUpElements = document.querySelectorAll(".slide-up-element-2");
    
    function runAnimation(element) {
      element.style.opacity = 1;
      element.style.transform = "translateY(0)";
    }
  
    slideUpElements.forEach(function(element) {
      setTimeout(function() {
        runAnimation(element);
      }, 100); // 適宜遅延時間を調整
    });
  });

  document.addEventListener("DOMContentLoaded", function() {
    var slideUpElements = document.querySelectorAll(".slide-up-element-3");
    
    function runAnimation(element) {
      element.style.opacity = 1;
      element.style.transform = "translateY(0)";
    }
  
    slideUpElements.forEach(function(element) {
      setTimeout(function() {
        runAnimation(element);
      }, 300); // 適宜遅延時間を調整
    });
  });