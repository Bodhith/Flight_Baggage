$( document ).ready(function() {

  var content = "\
    <table name='table' class='table table-bordered table-striped'>\
      <thead>\
        <tr>\
         <th>Select</th>\
         <th>User Name</th>\
         <th>User Mobile</th>\
         <th>User PNR</th>\
         <th>Departure Airport</th>\
         <th>Arrival Airport</th>\
         <th>User Bags</th>\
         <th>User Status</th>\
        </tr>\
      </thead>\
      <tbody>\
      ";

  var content_2 = "\
    Stolen Bags/Rfid Tags\
    <table name='table' class='table table-bordered table-striped'>\
      <thead>\
        <tr>\
         <th>#</th>\
         <th>Rfid</th>\
        </tr>\
      </thead>\
      <tbody>\
      ";

  for(var x=0; x<stolenRfids.length; x++)
  {
    content_2 += '\
      <tr>\
      <td> ' + (x+1) + ' </td>\
      <td> ' + stolenRfids[x] + ' </td>\
      </tr>\
    ';
  }

  content_2 += '\
      </tbody>\
    </table>\
  ';


  var checkBoxMode, checkBoxId;

  for(var i=0; i<table.length; i++)
  {
    checkBoxMode = userVerdicts[i];

    if( checkBoxMode == "Passed" )
    {
      checkBoxMode = "checked disabled";
      checkBoxId = -1;
    }
    else {
      checkBoxMode = "enabled";
      checkBoxId = i;
    }

    content += '\
    <tr id="row_SelectedUser_'+i+'">\
      <th scope="row">\
        <div class="custom-control custom-checkbox">\
          <input name="'+checkBoxId+'" type="checkbox" class="custom-control-input" id="selectedUser_'+i+'" '+checkBoxMode+'>\
          <label class="custom-control-label" for="selectedUser_'+i+'"></label>\
        </div>\
      </th>\
    ';
    var j = 0, status;
    jQuery.each(table[i], function(key, value)
    {
      if( j <= 4 )
      {
         content += "<td>" + value + "</td>";
      }

      else
      {
        content += "<td>";
        jQuery.each(table[i]["Attached Rfids"], function(key, value)
        {
          status = value;
          content += key +", ";
        });
        content += "</td>";

        content += '\
          <td> '+ status +' </td>\
        ';
      }
      j++;
    });

    content += "</tr>";
  }
  content += '\
    </tbody>\
  </table>\
  ';

  $("#formTableData").append(content);
  $("#formTableData").append(content_2);

  $(document).on('click', 'tbody tr', function () {
        var checked= $(this).find('input[type="checkbox"]');

        if( !checked.is('[disabled]') )
        {
          checked.prop('checked', !checked.is(':checked'));
        }
    });

});
