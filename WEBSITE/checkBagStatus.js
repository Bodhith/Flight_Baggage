$( document ).ready(function() {

  var table_1 = '\
          <div class="table-responsive">\
            <table name="table_1" class="table table-bordered table-striped">\
              <thead>\
                <tr>\
                  <th>Select</th>\
                  <th>Bag Id</th>\
                  <th>Status</th>\
                </tr>\
              </thead>\
            <tbody>\
      ';

  var row = 0, j = 0;
  jQuery.each(table, function(key, value)
  {

    for(var x=0; x<Object.keys(value['bags']).length; x++)
    {
      table_1 += '\
            <tr>\
              <th scope="row">\
                ' + (row+1) + '\
              </th>\
      ';

      table_1 += '\
        <td>' + value['bags'][x] + '</td>\
      ';

      table_1 += '<td>';
      j=0;
      jQuery.each(value['status'], function(key, value)
      {
        if( j == row )
        {
          for(var k=0; k<value.length; k++)
          {
            table_1 += '\
              ' + value[k][0] + ' , ' + value[k][1] + '<br>\
            ';
          }
        }

        j++;

      });

      table_1 += '</td>';

      table_1 += "</tr>";

      row++;
    }

  });

  table_1 += '\
          </tbody>\
        </div>\
      </table>\
  ';

  $("#formTableData").append(table_1);

});
