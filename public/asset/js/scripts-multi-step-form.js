
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    if(y[i].hasAttribute('required')){
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  }
  //loop select
  y = x[currentTab].getElementsByTagName("select");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
//******************************************************** */
$(document).ready(function()
  {

    $('.numeric-input').on('input', function() {
            // Get the current value of the input
            var inputValue = $(this).val();
            
            // Replace any commas with periods
            var newValue = inputValue.replace(/,/g, '.');
            
            // Update the input field with the new value
            $(this).val(newValue);
        });
  var licence_type =$('#licence_type_value').val();
  
  if(licence_type=='LMD')
  {
    $('#S5').attr('disabled',false);
    $('#S6').attr('disabled',false);
    $('#S5').attr('required',true);
    $('#S6').attr('required',true);
  }
  else if(licence_type=='Classique')
  {
    $('#S5').attr('disabled',true);
    $('#S6').attr('disabled',true);
    $('#S5').attr('required',false);
    $('#S6').attr('required',false);
   
  }
  else if(licence_type=='ingenieur')
  {
    $('#S6').attr('disabled',false);
    $('#S6').attr('disabled',true);
    $('#S5').attr('required',true);
    $('#S6').attr('required',false);
  }
       
     $('select#department_id').change(function() 
      {	
         //$(this).find(":selected").data("speciality_max_choice"); //works good
          var max_choice= $('#department_id option:selected').attr('data-speciality_max_choice');
          var licence_type =$('#licence_type_value').val();
         $.ajax({
              type: "get",
              data: {"department": this.value,"level":licence_type, "_token": "{{ csrf_token() }}" },
              url: '{{url("get_specialities")}}', 
              success: function(response){
                  
                      ///alert( (Math.min(3, response.length)));
                      var nb_choix = Math.min(max_choice, response.length);
                      html = "";
                      for($i=1;$i<=nb_choix;$i++){ 
                              
                          html += ' <div class="form-group row p-2">';
                          
                          html +=  '<label for="departments" class="col-sm-4 col-form-label text-left" > <b>{{__("translation.choix")}}'+$i+'<span style="color:red;"> *</span></b></label>';
                          html +=' <div class="col-sm-8">';
                          html +='<select name="special_'+$i+'" id="special_'+$i+'"  required="true"  class="form-select" >'  ;
                          html +='<option disabled="true"  selected required="true"></option>';
                      
                          $.each(response, function( index, value ) {

                              html += '<option class="form-control"  value="'+ value.id +'"> - '+ value.title+'</option>';
                          
                          });
                          html += '</select> </div>  </div>';
                      }  
                      
                      $('#sp').empty('').append(html);
              
              }    
      });
      });  	
      //test file size
      const maxFileSize = 1024*1024 *5  ; // 5MB= 1MB *5

      // Get references to the file input and error message elements
      const fileInput = document.getElementById('file');
      const errorMessage = document.getElementById('errorMessage');

    // Add an event listener to the file input element
    fileInput.addEventListener('change', function() {
    const selectedFile = fileInput.files[0]; // Get the selected file

    // Check if a file was selected
    if (!selectedFile) {
        errorMessage.textContent = 'No file selected.';
        return;
    }
    // Check the file size
    if (selectedFile.size > maxFileSize) {
        errorMessage.textContent = 'La taille du fichier dépasse la taille maximale autorisée (5 Mo).';
        fileInput.value = ''; // Clear the file input
    } else {
        errorMessage.textContent = ''; // Clear any previous error message
    }
    });

      //end file size test
  });
