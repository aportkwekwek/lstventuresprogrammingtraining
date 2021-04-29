$(document).ready(function(){

    var currentDate = new Date();
    var yearNow = currentDate.getFullYear();

    var day = ("0" + currentDate.getDate()).slice(-2);
    var month = ("0" + (currentDate.getMonth() + 1)).slice(-2);

    var today = (yearNow)+"-"+(month)+"-"+(day) ;

    $('#dateFetcher').val(today);
    $('#dateFetcherFrom').val(today);
    $('#dateFetcherTo').val(today);

     // // // // // // // // // // // // // // 
    $.ajax({
        url:'../fetcher/dbQueries.php',
        type:'post',
        data:{
            loadStudent:1
        },
        dataType:'json',
        success:function(data){

            // console.log(data.studentcode);

            var concatinated = "ST"+yearNow+""+data.studentcode;
            $('#txtStudentCode').val(concatinated);


        },
        error:function(err){
            console.log(err);
        }

    });


    
    $('#txtFetcherContact').keypress(function(e){
        if(e.which != 8 && e.which !=0 && e.which < 48 || e.which > 57){
            toastr.error('Input should not be letters');
            return false;
            
        }
    });



    $(document).on('click','#addStudent',function(e){
    
        e.preventDefault();
        var studentCode = $('#txtStudentCode').val();
        var studentName = $('#txtStudentName').val();


        if(studentCode == ''){
            toastr.error("Please dont modify student code!");
            return 0;
        }

        if(studentName == ""){
            toastr.error("Cannot enter blank Student Name");
            return 0;
        }
        
        $.ajax({
            url:'../fetcher/dbQueries.php',
            type:'POST',
            dataType:'json',
            data:{
                studentCode:studentCode,
                studentName:studentName,
                addStudent:1
            },
            success:function(data){

                if(data.status == 'Error'){
                    toastr.error(data.message);
                }else{

                    // $('#tblStudents').empty();
                    
                    toastr.success(data.message);
                    setTimeout(function(){
                        window.location.reload();
                    },1400);

                }

                console.log(data);
            },
            error:function(err){
                console.log(err);
            }
        });


    });

    // Load fetcher code

    $.ajax({
        url:'../fetcher/dbQueries.php',
        type:'post',
        data:{
            loadFetchers:1
        },
        success:function(data){
            // console.log(data);
        },
        error:function(err){
            console.log(err);
        }
    });


    $(document).on('change','.comboBoxStudentCode',function(){

        var studentCode = $(this).val();
       
        if(studentCode == 0){
            toastr.error('Please select student code!');
            return 0;
        }

        $.ajax({
            url:'../fetcher/dbQueries.php',
            type:'post',
            data:{
                studentCode:studentCode,
                changeStudent:1
            },
            dataType:'json',
            success:function(data){

                $('#txtSelectedName').val(data.fullname);


            },
            error:function(err){
                console.log(err);
                
            }

    });


    });


    $(document).on('click','#addinfototable',function(e){


        e.preventDefault();
        

        var comboBoxStudentCode = $('#comboBoxStudentCode').val();
        var txtRelationship = $('#txtRelationship').val();

        if(comboBoxStudentCode == null || comboBoxStudentCode == ''){
            toastr.error('Please insert student code!');
            exit
        }

        if(txtRelationship == ''){
            toastr.error('Please enter relationship status');
            return 0;
        }

        $('#tblFetcherData tr').each(function(i,element){
            var val = $(element).children().eq(0).text();

            if(val == comboBoxStudentCode){
                toastr.error("Student code exists in the same table");
                return exit;
            }
        });

        $('#tblFetcherData tbody').append("<tr class='fade-in'>"+
        "<td class='cmbstdntcodefetcher'>" + comboBoxStudentCode + "</td>" +
        "<td>" + $('#txtSelectedName').val() + "</td>" +
        "<td class='txtrelationshipfetcher'>" + txtRelationship + "</td>" +
        "<td class=''><button class='btn btn-sm btn-danger btnDelete'><i class='fa fa-trash'></i></button></td>" +
        
        "</td>");

        $('#txtRelationship').val('');
        $('#comboBoxStudentCode').val('');
        $('#txtSelectedName').val('');


    });


    $(document).on('click','.btnDelete',function(e){

        e.preventDefault();

        Swal.fire({
            title: 'Are you sure?',
            text: "Student can still be added later.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire(
                'Deleted!',
                'Student deleted from fetcher.',
                'success'
              );
              $(this).closest('tr').remove();
            }
          });


    });



    // Add Fetcher

    $(document).on('click','#addFetcher',function(e){

        var txtFetcherCode = $('#txtFetcherCode').val();
        var txtFetcherName = $('#txtFetcherName').val();
        var txtFetcherContact = $('#txtFetcherContact').val();
        var dateFetcher = $('#dateFetcher').val();
        var fetcherActive = $('#fetcherActive').val();

       if($('#fetcherActive').is(':checked')){
           fetcherActive = 1;
       }else{
           fetcherActive = 0;
       }

       if(txtFetcherCode == ''){
           toastr.error("Fetcher Code shouldnt be blank!");
           return 0;
       }

       if(txtFetcherName == ''){
           toastr.error('Fetcher Name shouldnt be blank');
           $('#txtFetcherName').focus();
           return 0;
       }

       if(txtFetcherContact == ''){
           toastr.error('Contact Number shouldnt be blank!');
           $('#txtFetcherContact').focus();
           return 0;
       }

       if(dateFetcher == ''){
           toastr.error('Registered date shouldnt be blank!');
           $('#dateFetcher').focus();
           return 0;
       }

       var studentCodes = new Array();
       var studentRelationships = new Array();

       $('#tblFetcherData').find('tr').each(function(i , el){
           var $tbls = $(this).find('td');
            stdCds = $tbls.eq(0).text();
            stdRls = $tbls.eq(2).text();

            studentCodes.push(stdCds);
            studentRelationships.push(stdRls);
       });

       if(studentCodes.length <= 1){
           toastr.error("Please insert something on the table");
           return 0;
       }

       $.ajax({
        type:'post',
        url:'../fetcher/dbQueries.php',
        data:{
            studentCodes:studentCodes,
            studentRelationships:studentRelationships,
            txtFetcherCode:txtFetcherCode,
            txtFetcherName:txtFetcherName,
            txtFetcherContact:txtFetcherContact,
            dateFetcher:dateFetcher,
            fetcherActive:fetcherActive,
            addFetcher:1
        },
        dataType:'json',
        success:function(data){
            console.log(data);
            if(data.status == 'Error'){
                toastr.error(data.message);
                return 0;
            }else{
                toastr.success(data.message);
                setTimeout(function(){
                    window.location.reload();
                },2000);
            }
        },
        error:function(err){
            console.log(err);
        }

       });

    });

    $(document).on('click','#btnPrint',function(e){

        var comboBoxFetcherCodeFrom = $('#comboBoxFetcherCodeFrom').val();
        var comboBoxFetcherCodeTo = $('#comboBoxFetcherCodeTo').val();
        var dateFetcherFrom = $('#dateFetcherFrom').val();
        var dateFetcherTo = $('#dateFetcherTo').val();
        var detailedSummarized = $("input[name='detailedSummarized']:checked").val();
        var fetcherActive;
        var fetcherInactive;

        if($('#fetcherActive').is(':checked')){
            fetcherActive = 1;
        }else{
            fetcherActive = 0;
        }

        if($('#fetcherInactive').is(':checked')){
            fetcherInactive = 1;
        }else{
            fetcherInactive = 0;
        }

        if(comboBoxFetcherCodeFrom == null){
            toastr.error("No fetcher from selected");
            return 0;
        }

        if(comboBoxFetcherCodeTo == null){
            toastr.error("No fetcher to selected");
            return 0;
        }

        if(dateFetcherFrom == ''){
            toastr.error("Please enter registered date from");
            $('#dateFetcherFrom').focus();
            exit;
        }

        if(dateFetcherTo == ''){
            toastr.error('Please enter registered date to');
            $('#dateFetcherTo').focus();
            exit;

        }

        if(dateFetcherFrom > dateFetcherTo){
            toastr.error("Date from shouldn't be greater than date to");
            exit;
        }

        var from4Numbers = comboBoxFetcherCodeFrom.substr(6,4);
        var to4Numbers = comboBoxFetcherCodeTo.substr(6,4);

        if(from4Numbers > to4Numbers){
            toastr.error("Fetch from shouldn't be greater than fetch to");
            exit;
        }

        // Set session for current print
        $.ajax({
            type:'post',
            url:'../fetcher/dbQueries.php',
            data:{
                comboBoxFetcherCodeFrom:comboBoxFetcherCodeFrom,
                comboBoxFetcherCodeTo:comboBoxFetcherCodeTo,
                dateFetcherFrom:dateFetcherFrom,
                dateFetcherTo:dateFetcherTo,
                fetcherActive:fetcherActive,
                fetcherInactive:fetcherInactive,
                detailedSummarized:detailedSummarized,
                btnPrint:1
            },
            success:function(data){
                console.log(data);
            },
            error:function(err){
                console.log(err);
            }
        });

        // if(detailedSummarized == 'detailed'){
        //     window.open('../print/detailed.php');
        // }else{
        //     window.open('../print/summarized.php');
        // }

    });

 

    // Add new fetcher

    // $(document).on('click','.addNewStudentFetcher',function(e){

    //     $.ajax({
    //         type:'post',
    //         url:'../fetcher/dbQueries.php',
    //         dataType:'json',
    //         data:{
    //             newStudentFetcher:1
    //         },
    //         success:function(data){
    //             var arrLen = data.length;
    //             var newCombo = [];

    //             for(var i = 0; i < arrLen ; i++){
    //                 newCombo.push(data[i]);
    //             }

    //         },
    //         error:function(err){
    //             console.log(err);
    //         }

    //     });

    // });

    $(document).on('click','#printStudents',function(e){

        e.preventDefault();

        $.ajax({
            type:'post',
            url:'../fetcher/dbQueries.php',
            data:{
                printStudents:1
            },
            success:function(data){
                console.log(data);
            },
            error:function(err){
                console.log(err);
            }
        });

    });

    // xss protection

    $('#txtFetcherName').on('keypress',function(e){

        var pattern = /^[a-zA-Z0-9- ]*$/;
        
        var userinput = $(this).val();

        if(!pattern.test(userinput)){
            toastr.error('Special Characters not allowed!');
            return false;
        }   

    });

    // $.ajax({
    //     type:'post',
    //     url:'../test.php',
    //     dataType:'json',
    //     data:{
    //         test:1
    //     },
    //     success:function(data){
            
    //         // console.log(data);
    //     },
    //     error:function(err){
    //         console.log(err);
    //     }
    // });


});