$(document).ready(function () {

    $.ajax({
	  type: 'GET',
	  datatype: 'json',
	  url: 'getCustomer.php',
	  data: { 'action': 'getData' },
	  success: function (data) {

        var trHTML = '';
		var data = $.parseJSON(data);
		$.each(data, function (i, o){

		    trHTML += '<tr><td>'  + o.F1 +
		              '</td><td>' + o.F2 +
		              '</td><td>' + o.F3 +
		              '</td></tr>';
		});

	$('#records_table').append(trHTML);
    }
  });
});