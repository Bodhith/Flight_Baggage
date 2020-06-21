$( document ).ready(function() {

  var content = "\
    <table name='table' class='table table-bordered table-striped'>\
      <thead>\
        <tr>\
         <th>Select</th>\
         <th>Bag</th>\
        </tr>\
      </thead>\
      <tbody>\
      ";

  var checkBoxMode;

  for(var i=0; i<Object.keys(userRfids).length; i++)
  {
    if( stolenRfids[i] !== userRfids[i] )
    {
      checkBoxMode = "enabled";
    }
    else {
      checkBoxMode = "checked disabled";
    }

    content += '\
    <tr id="row_SelectedUser_'+i+'">\
      <th scope="row">\
        <div class="custom-control custom-checkbox">\
          <input name="'+i+'" type="checkbox" class="custom-control-input" id="selectedBag_'+i+'" '+checkBoxMode+'>\
          <label class="custom-control-label" for="selectedBag_'+i+'"></label>\
        </div>\
      </th>\
    ';

    content += '\
      <td> Bag ' + (i+1) + ' </td>\
    ';

    content += "</tr>";
  }
  content += '\
    </tbody>\
  </table>\
  ';

  $("#formReportTable").append(content);

  $(document).on('click', 'tbody tr', function () {
        var checked= $(this).find('input[type="checkbox"]');

        if( !checked.is('[disabled]') )
        {
          checked.prop('checked', !checked.is(':checked'));
        }
    });

});
