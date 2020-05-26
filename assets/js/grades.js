var d;

$(document).ready(function(){


    $('#txtstudentnumber').focus();
    var gradedatatable =   $('#gradetable').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
    });


    $('#txtstudentnumber').keypress(function(event){
        $('tbody#studenttbody').empty();
        $('#selectsy').empty();
        $('#selectsem').empty();
        $('tbody#gradetablebody').empty();
        var keycode = (event.keyCode ? event.keyCode : event.which);

        if(keycode == '13'){
            var studentnumber = $(this).val();
            var siteurl  = $('#cont_url').val();
            console.log(siteurl);
            $.ajax({
                type: "POST",
                url  : siteurl,
                dataType : "JSON",
                data : {studentnum:studentnumber},
                success: function(data){
                    d= data;
                    console.log(data);
                    if(d.length > 0){

                        //console.log(data);
                        $('#noresult').remove();
                        for(var i = 0;i<d.length;i++){
                            var d1 = $('<td></td>').text(d[i].StudentNumber);
                            var d2 =$('<td></td>').text(d[i].LastName +", " +d[i].FirstName);
                            var d3 =$('<td></td>').append(d[i].CourseCode);
                            var r = $('<tr></tr>').attr("id",d[i].StudentNumber).addClass("student").append(d1,d2,d3);
                            $('#studenttbody').append(r);}}}

            });
        }
    });


    $("#selectsy").change(function () {
        $('#selectsem option[id="nosemres"]').remove();
        $('#selectsem').empty();
        var key1 = $('#selectsy option:selected').text();
        var key2 = '';
        var count2 = 0;
        Object.keys(d[0]['gradelist'][key1]).forEach((key,index) =>{
            if(count2 == 0){
                key2 = key;
                count2++;
            }
            $("#selectsem").append("<option value='" + key + "'>" + key + "</option>");

        });
        AddData('gradetable',key2,key1);
    });

    $("#selectsem").change(function () {
        var key1 = $('#selectsy option:selected').text();
        var key2 = $('#selectsem option:selected').text();
        AddData('gradetable',key2,key1);
    });


    $(document).on('click','.student',function(){
        //alert("you have selected" +$('.student').attr("id"));
        $('#selectsy option[id="noyearres"]').remove();
        var count = 0;
        var key1 = '';
        Object.keys(d[0]['gradelist']).forEach((key,index) =>{
            if(count == 0){
                key1 = key;
                count ++;
            }
            $("#selectsy").append("<option value='" + key + "'>" + key + "</option>");
        });
        var count2 = 0;
        var key2 = '';
        $('#selectsem option[id="nosemres"]').remove();
        $('#selectsem').empty();
        Object.keys(d[0]['gradelist'][key1]).forEach((key,index) =>{
            if(count2 == 0){
                key2 =key;
                count2++;
            }
            $("#selectsem").append("<option value='" + key + "'>" + key + "</option>");
        });

        $('#searchgrade').removeClass("disabled");

        AddData('gradetable',key2,key1);
    });

    function AddData(id,semester,schoolyear){
        gradedatatable.destroy();
        var tbody = $('#'+id+'body');
        tbody.empty();

        gradedatatable = $('#'+id).DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
        var g1 = d[0]['gradeactualgrade'];
        for(var j = 0;j<d[0]['gradelist'][schoolyear][semester].length;j++){
            var gradelist = d[0]['gradelist'][schoolyear][semester][j];
            var rowNode ;
            var datarow = [];
            $.each(gradelist,function(fields,value){
                if (fields == 'enrollSchedcode' || fields =="remarks" || fields == "CourseCode")
                {

                }else {

                    datarow.push(value);

                }

            });
            var enrolled = true;
            var grade = '';
            var cunit ='';
            var remarks = '';
            for(var u = 0;u <g1.length;u++){
                if(datarow[0] == g1[u]['Schedcode'] &&datarow[3]===null){
                    grade = g1[u]['Grade'];
                    cunit = g1[u]['CreditUnits'];
                    remarks = g1[u]['remarks'];
                    enrolled = false;
                    break;
                }
            }
            if(datarow[3] === null && !enrolled){ //if not enrolled
                datarow.push("Not Enrolled but has grade" );
                datarow[3] = grade;
                datarow[4] = cunit;
                datarow[5] =  remarks;
            }
            else if (datarow[3] === null && enrolled) {
                datarow.push("Please Upload Grade");
                datarow[3] = '';
                datarow[4] = '0';
                datarow[5] =  'Not Graded.';
            }
            else if(datarow[3] == '4.00'|| datarow[3] == '8.00'){
                datarow[4] = '0';
                datarow[5] = 'INCOMPLETE';

                datarow.push("Complete the grade");
            }
            else{
                datarow.push("Grade Uploaded");
            }

            rowNode = gradedatatable
                .row.add( datarow )
                .draw()
                .node();
            switch(datarow[6]){
                case "Not Enrolled but has grade":{$( rowNode ).addClass("table-warning");} break;
                case "Please Upload Grade": { $( rowNode ).addClass("table-light");} break;
                case "Grade Uploaded": { $( rowNode ).addClass("table-success");} break;
                case "Complete the grade": { $( rowNode ).addClass("table-danger");} break;
            }

        }// outer for loop

        $('#'+id+'body tr.table-light').each(function(index,value){

            var td =  $(value).find("td:nth-child(4)");
            var select = $('<select></select>').attr("id",'grade').addClass("uploadgrade");
            var grade = ['0.00','1.00','1.25','1.50','1.75','2.00','2.25','2.50','2.75','3.00','4.00','5.00','6.00','8.00'];
            for (var g10 = 0;g10<grade.length;g10++){
                $("<option></option>", {value: grade[g10], text: grade[g10]}).appendTo(select);
            }
            td.html(select);
        });
        $('#'+id+'body tr.table-danger').each(function(index,value){

            var td =  $(value).find("td:nth-child(4)");
            var select = $('<select></select>').attr("id",'grade').addClass("changegrade");
            var grade = ['0.00','1.00','1.25','1.50','1.75','2.00','2.25','2.50','2.75','3.00','4.00','5.00','6.00','8.00'];
            for (var g10 = 0;g10<grade.length;g10++){
                $("<option></option>", {value: grade[g10], text: grade[g10]}).appendTo(select);
            }
            select.appendTo(td);
            //td.html(select);
        });
        $('#'+id+'body tr.table-danger').each(function(index,value){

            var td =  $(value).find("td:nth-child(7)");
            var buttonsubmit = $('<input/>').attr({
                type: "button",
                value: 'Complete Subject'
            }).addClass("btn btn-primary  bcompletesubject");
            td.html(buttonsubmit);
        });

        $('#'+id+'body tr.table-warning').each(function(index,value){

            var td =  $(value).find("td:nth-child(7)");
            var buttonsubmit = $('<input/>').attr({
                type: "button",
                value: 'Enroll Subject'
            }).addClass("btn btn-primary benrollsubject");
            td.html(buttonsubmit);
        });


    }



    $(document).on('change','select.uploadgrade',function(){
        var selectedoption = $(this).find('option:selected');
        var grade = selectedoption.text();
        var parentTR = selectedoption.closest('tr').removeClass("table-warning table-danger table-light table-dark table-primary");
        var tdunit = parentTR.find("td:nth-child(3)");
        var tdcreditunit = parentTR.find("td:nth-child(5)");
        var tdremarks = parentTR.find("td:nth-child(6)");
        var tdoption = parentTR.find("td:nth-child(7)");
        switch(grade){
            case '1.00':{tdcreditunit.html(tdunit.html());tdremarks.html("PASSED"); parentTR.addClass("table-primary");}break;
            case '1.25':{tdcreditunit.html(tdunit.html());tdremarks.html("PASSED");parentTR.addClass("table-primary");}break;
            case '1.50':{tdcreditunit.html(tdunit.html());tdremarks.html("PASSED");parentTR.addClass("table-primary");}break;
            case '1.75':{tdcreditunit.html(tdunit.html());tdremarks.html("PASSED");parentTR.addClass("table-primary");}break;
            case '2.00':{tdcreditunit.html(tdunit.html());tdremarks.html("PASSED");parentTR.addClass("table-primary");}break;
            case '2.25':{tdcreditunit.html(tdunit.html());tdremarks.html("PASSED");parentTR.addClass("table-primary");}break;
            case '2.50':{tdcreditunit.html(tdunit.html());tdremarks.html("PASSED");parentTR.addClass("table-primary");}break;
            case '2.75':{tdcreditunit.html(tdunit.html());tdremarks.html("PASSED");parentTR.addClass("table-primary");}break;
            case '3.00':{tdcreditunit.html(tdunit.html());tdremarks.html("PASSED");parentTR.addClass("table-primary");}break;
            case '4.00':{tdcreditunit.html('0');tdremarks.html("Incomplete");parentTR.addClass("table-warning");}break;
            case '5.00':{tdcreditunit.html('0');tdremarks.html("FAILED");parentTR.addClass("table-danger");}break;
            case '6.00':{tdcreditunit.html('0');tdremarks.html("DROPPED");parentTR.addClass("table-dark");}break;
            case '8.00':{tdcreditunit.html('0');tdremarks.html("GRADES WITHHELD");parentTR.addClass("table-dark");}break;
        }
        //var buttonsubmit = $('<button></button>').addClass("btn btn-primary buploadgrade").html('Upload Grade');
        var buttonsubmit = $('<input/>').attr({
            type: "button",
            value: 'Upload Grade'
        }).addClass("btn btn-primary buploadgrade");
        tdoption.html(buttonsubmit);

    });

    $(document).on('change','select.changegrade',function(){
        var selectedoption = $(this).find('option:selected');
        var grade = selectedoption.text();
        var parentTR = selectedoption.closest('tr').removeClass("table-warning table-danger table-light table-dark table-primary");
        var tdunit = parentTR.find("td:nth-child(3)");
        var tdcreditunit = parentTR.find("td:nth-child(5)");
        var tdremarks = parentTR.find("td:nth-child(6)");
        var tdoption = parentTR.find("td:nth-child(7)");
        switch(grade){
            case '1.00':{tdcreditunit.html(tdunit.html());tdremarks.html("PASSED"); parentTR.addClass("table-primary");}break;
            case '1.25':{tdcreditunit.html(tdunit.html());tdremarks.html("PASSED");parentTR.addClass("table-primary");}break;
            case '1.50':{tdcreditunit.html(tdunit.html());tdremarks.html("PASSED");parentTR.addClass("table-primary");}break;
            case '1.75':{tdcreditunit.html(tdunit.html());tdremarks.html("PASSED");parentTR.addClass("table-primary");}break;
            case '2.00':{tdcreditunit.html(tdunit.html());tdremarks.html("PASSED");parentTR.addClass("table-primary");}break;
            case '2.25':{tdcreditunit.html(tdunit.html());tdremarks.html("PASSED");parentTR.addClass("table-primary");}break;
            case '2.50':{tdcreditunit.html(tdunit.html());tdremarks.html("PASSED");parentTR.addClass("table-primary");}break;
            case '2.75':{tdcreditunit.html(tdunit.html());tdremarks.html("PASSED");parentTR.addClass("table-primary");}break;
            case '3.00':{tdcreditunit.html(tdunit.html());tdremarks.html("PASSED");parentTR.addClass("table-primary");}break;
            case '4.00':{tdcreditunit.html('0');tdremarks.html("Incomplete");parentTR.addClass("table-warning");}break;
            case '5.00':{tdcreditunit.html('0');tdremarks.html("FAILED");parentTR.addClass("table-danger");}break;
            case '6.00':{tdcreditunit.html('0');tdremarks.html("DROPPED");parentTR.addClass("table-dark");}break;
            case '8.00':{tdcreditunit.html('0');tdremarks.html("GRADES WITHHELD");parentTR.addClass("table-dark");}break;
        }
    //var buttonsubmit = $('<button></button>').addClass("btn btn-primary buploadgrade").html('Upload Grade');
    });


    $(document).on('click','.benrollsubject',function(){
        var parentTR = $(this).closest('tr');
        var studentnumber = $('#txtstudentnumber').val();
        var sy = $('#selectsy option:selected').text();
        var sem = $('#selectsem option:selected').text();
        var tdschedcode = parentTR.find("td:nth-child(1)");
        var status = 'GRADED';
        var studentenrollsubject = {
            'StudentNumber':studentnumber,
            'Schoolyear': $('#selectsy option:selected').text(),
            'semester' :$('#selectsem option:selected').text(),
            'SchedCode' : tdschedcode.html(),
            'status': status,
        };
        var enrollsubjecturl  = $('#cont_urlenrollsubj').val();

        $.ajax({
            type: "POST",
            url  : enrollsubjecturl,
            dataType : "JSON",
            data : {studentenroll:studentenrollsubject},
            success: function(data){
                alert("The grade is successfully uploaded.");
                console.log("The grade is successfully uploaded.");
                $(this).prop({"value":"Enrolled","disabled":true});
            }}
        );

    });


    $(document).on('click','.bcompletesubject',function(){
        var parentTR = $(this).closest('tr');
        var studentnumber = $('#txtstudentnumber').val();
        //var sy = $('#selectsy option:selected').text();
        //var sem = $('#selectsem option:selected').text();
        var tdcreditunit = parentTR.find("td:nth-child(5)");
        var tdschedcode = parentTR.find("td:nth-child(1)");
        //var status = 'GRADED';
        var tdremarks = parentTR.find("td:nth-child(6)");
        var tdgrade = parentTR.find("td:nth-child(4)").find($('.changegrade option:selected'));

        var studentcompletesubject = {
            'StudentNumber':studentnumber,
            'SchedCode' : tdschedcode.html(),
            'CreditUnits': tdcreditunit.html(),
            'Grade' : tdgrade.text(),
            'remarks': tdremarks.html()

        };
        console.log(studentcompletesubject);


    });







    $(document).on('click','.buploadgrade',function(){
        //console.log("putang ina mo");

        //console.log($(this).html());
        var parentTR = $(this).closest('tr');
        var tdschedcode = parentTR.find("td:nth-child(1)");
        var tdcoursecode = parentTR.find("td:nth-child(2)");
        var tdgrade = parentTR.find("td:nth-child(4)").find($('.uploadgrade option:selected'));
        var tdcreditunit = parentTR.find("td:nth-child(5)");
        var tdremarks = parentTR.find("td:nth-child(6)");
        var tdoption = parentTR.find("td:nth-child(7)");
        var studentnumber = $('#txtstudentnumber').val();
        tdoption.append($('input:checkbox').prop("checked",true).attr("id",tdschedcode.html()));
        var studentgrade1 = {
            'StudentNumber':studentnumber,
            'CourseCode' : tdcoursecode.html(),
            'Semester' :$('#selectsem option:selected').text(),
            'Schoolyear': $('#selectsy option:selected').text(),
            'CreditUnits': tdcreditunit.html(),
            'Grade' : tdgrade.text(),
            'remarks': tdremarks.html(),
            'SchedCode' : tdschedcode.html()
        };
        var uploadurl  = $('#cont_urlupdate').val();
        //console.log(studentgrade);
        $.ajax({
            type: "POST",
            url  : uploadurl,
            dataType : "JSON",
            data : {uploadgrade:studentgrade1},
            success: function(data){
                alert("The grade is successfully uploaded.");
                console.log("The grade is successfully uploaded.");
                $(this).prop({"value":"Grade Uploaded ","disabled":true});
            }}
        );


    });




});
