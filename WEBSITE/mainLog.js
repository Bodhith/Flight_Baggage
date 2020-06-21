$( document ).ready(function() {

  var table_1 = '\
          <div class="table-responsive">\
            <table name="table_1" class="table table-bordered table-striped">\
              <thead>\
                <tr>\
                  <th>Select</th>\
                  <th>User Name</th>\
                  <th>User Mobile</th>\
                  <th>User PNR</th>\
                  <th>Status</th>\
                  <th>User Rfids</th>\
                </tr>\
              </thead>\
            <tbody>\
      ';

  var table_2 = '\
          <div class="table-responsive">\
            <table name="table_2" class="table table-bordered table-striped">\
              <thead>\
                <tr>\
                  <th>Select</th>\
                  <th>Rfid</th>\
                  <th>Rfid Route</th>\
                  <th>Timestamps</th>\
                </tr>\
              </thead>\
            <tbody>\
      ';

  var row = 0;
  jQuery.each(table, function(key, value)
  {
    table_1 += '\
          <tr>\
            <th scope="row">\
              ' + (row+1) + '\
            </th>\
    ';

    table_2 += '\
          <tr>\
            <th scope="row">\
              ' + (row+1) + '\
            </th>\
    ';

    var j = 0;
    jQuery.each(value, function(key, value)
    {
      if( j <= 3 )
      {
         table_1 += "<td>" + value + "</td>";
      }

      else if( j == 4 )
      {
        table_1 += "<td>";

        table_2 += "<td>";

        jQuery.each(value, function(key, value)
        {
          table_1 += value +"<br>";

          table_2 += value + "<br>";

        });

        table_1 += "</td>";

        table_2 += "</td>";
      }

      else if( j == 5 )
      {
        table_2 += '<td>';
        jQuery.each(value, function(key, value)
        {
          table_2 += value + "<br>";
        });
        table_2 += "</td>";
      }
      else if( j == 6 )
      {
        table_2 += '<td>';
        jQuery.each(value, function(key, value)
        {
          table_2 += key + " : " + value + "<br>";
        });
        table_2 += "</td>";
      }
      else if( j == 0 )
      {
        table_2_status += '<td>';
        table_2_status += '' + value + '<br>';
        table_2_status += '</td>';
      }
      j++;
    });

    table_1 += "</tr>";

    table_2 += "</tr>";

    row++;

  });

  table_1 += '\
          </tbody>\
        </div>\
      </table>\
  ';

  table_2 += '\
          </tbody>\
        </div>\
      </table>\
  ';

  $("#formTableData").append(table_1);
  $("#formTableData").append(table_2);

});
