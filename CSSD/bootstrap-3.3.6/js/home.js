$(document).ready(function(){
	$(':text').click(function(){
		current_input_val = $(this).val();
		$(this).select();
	}).focusout(function(){
		if($(this).val() == ''){
			$(this).val(current_input_val);
		}
	});

	$(':password').focusin(function() {
		if($(this).attr('placeholder') != undifined){
			$(this).removeAttr('placeholder')
		}
	});

	$(':password.password').focusout(function(){
		$(this).attr('placeholder', 'Password');
	});

	$('password.password_confirm').focusout(function(){
		$(this).attr('placeholder', 'Confirm Password');
	});

		
});

var counter = 1;

var limit = 3;

function addInput(divName){

     if (counter == limit)  {

          alert("You have reached the limit of adding " + counter + " inputs");

     }

     else {

          var newdiv = document.createElement('div');

          newdiv.innerHTML = "Entry " + (counter + 1) + " <th><input type='text' name='myInputs[]'></th>";

          document.getElementById(divName).appendChild(newdiv);

          counter++;

     }

}

$(document).ready(function(){
    var next = 1;
    $(".add-more").click(function(e){
        e.preventDefault();
        var addto = "#field" + next;
        var addRemove = "#field" + (next);
        next = next + 1;
        var newIn = '<input autocomplete="off" class="input form-control" id="field' + next + '" name="field' + next + '" type="text">';
        var newInput = $(newIn);
        var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >-</button></div><div id="field">';
        var removeButton = $(removeBtn);
        $(addto).after(newInput);
        $(addRemove).after(removeButton);
        $("#field" + next).attr('data-source',$(addto).attr('data-source'));
        $("#count").val(next);  
        
            $('.remove-me').click(function(e){
                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length-1);
                var fieldID = "#field" + fieldNum;
                $(this).remove();
                $(fieldID).remove();
            });
    });
    

    
});

$(document).ready(function(){
    var next = 1;
    $(".add-diklat").click(function(e){
        e.preventDefault();
        var addto = "#field" + next;
        var addRemove = "#field" + (next);
        next = next + 1;
        var newIn = '<th> <input autocomplete="off" class="input form-control" id="field' + next + '" name="field' + next + '" type="text" >';
        var newInput = $(newIn);
        var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" style="width: 45px; height: 45px; margin:5px;">-</button></div><div id="field">  </th>';
        var removeButton = $(removeBtn);
        $(addto).after(newInput);
        $(addRemove).after(removeButton);
        $("#field" + next).attr('data-source',$(addto).attr('data-source'));
        $("#count").val(next);  
        
        $('.remove-me').click(function(e){
            e.preventDefault();
            var fieldNum = this.id.charAt(this.id.length-1);
            var fieldID = "#field" + fieldNum;
            $(this).remove();
            $(fieldID).remove();
        });
    });
});

function addRow() {
         
    var myName = document.getElementById("name");
    var age = document.getElementById("age");
    var table = document.getElementById("myTableData");

    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);

    row.insertCell(0).innerHTML= '<input type="button" value = "Delete" onClick="Javacsript:deleteRow(this)">';
    row.insertCell(1).innerHTML= myName.value;
    row.insertCell(2).innerHTML= age.value;

}

function deleteRow(obj) {
     
    var index = obj.parentNode.parentNode.rowIndex;
    var table = document.getElementById("myTableData");
    table.deleteRow(index);
   
}

function addTable() {
     
    var myTableDiv = document.getElementById("myDynamicTable");
     
    var table = document.createElement('TABLE');
    table.border='1';
   
    var tableBody = document.createElement('TBODY');
    table.appendChild(tableBody);
     
    for (var i=0; i<3; i++){
       var tr = document.createElement('TR');
       tableBody.appendChild(tr);
      
       for (var j=0; j<4; j++){
           var td = document.createElement('TD');
           td.width='75';
           td.appendChild(document.createTextNode("Cell " + i + "," + j));
           tr.appendChild(td);
       }
    }
    myTableDiv.appendChild(table);
   
}

function load() {
   
    console.log("Page load finished");

}
