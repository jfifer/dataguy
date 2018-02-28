$(document).ready(function () {
        $("#btnSubmit").click(function (e) {
            e.preventDefault();
            var selText = $('#tags').val();

            if (selText === '') {
                alert("Please select a name!");
            } else {
                $.ajax({
                    type: 'GET',
                    url: 'php/php1.php',
                    jsonpCallback: 'jsonCallback',
                    dataType: 'jsonp',
                    jsonp: false,
                    data: {
                        q: selText
                    },
                    success: function (response) {
                        var response =
[
    {
        "Name": "Sagar Mujumbdar",
        "Group": "",
        "TeacherName": "John     Cena",
        "RollNo": "SX51998",
        "Work": "Sales",
        "Grade1": "Good",
        "Grade2": "5",
        "Grade3": "1"
    }
];
                     alert(response);
                     var trHTML = '';




                     $.each(response, function (i, o){
    trHTML += '<tr><td>' + o.Name +
              '</td><td>' + o.Group +
              '</td><td>' + o.Work +
              '</td><td>' + o.Grade1 +
              '</td><td>' + o.Grade2 +
              '</td><td>' + o.Grade3 +
              '</td><td>' + o.TeacherName +
              '</td><td>' + o.RollNo +
              '</td></tr>';
});
$('#records_table').append(trHTML);

};