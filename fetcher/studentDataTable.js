
$(document).ready(function(){

    loadDatatable();

    $(document).on('click','.btnEditStudent', function(e){
        var recordid = $(this).closest('tr').find('.recordid').text();
        var studentcode = $(this).closest('tr').find('.studentcode').text();
        var fullname = $(this).closest('tr').find('.fullname').text();

        Swal.fire({
            title:"Edit user",
            html:
                        "<div class='input-group mb-3'>" +
                            "<div class='input-group-prepend'>" + 
                                "<span class='input-group-text btn btn-info'><i class='fa fa-hashtag' aria-hidden='true'></i>&emsp; Record ID &emsp; </span>" +
                            "</div>" +
                            "<input id='txtrecordidEdit' type='text' class='form-control' placeholder='Full Name' disabled value='"+ recordid +"'>" +
                        "</div>"  +
                        "<div class='input-group mb-3'>" +
                            "<div class='input-group-prepend'>" + 
                                "<span class='input-group-text btn btn-info'><i class='fa fa-pencil' aria-hidden='true'></i>&emsp; Student Code</span>" +
                            "</div>" +
                            "<input id='txtstudentcodeEdit' type='text' class='form-control' placeholder='Full Name' disabled value='"+ studentcode +"'>" +
                        "</div>"  +
                        "<div class='input-group mb-3'>" +
                            "<div class='input-group-prepend'>" + 
                                "<span class='input-group-text btn btn-info'><i class='fa fa-user' aria-hidden='true'></i>&emsp; Student Name</span>" +
                            "</div>" +
                            "<input id='txtfullnameEdit' type='text' class='form-control' placeholder='Full Name' value='"+ fullname +"'>" +
                        "</div>",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update it!'
          }).then((result) => {
            if (result.isConfirmed) {

                var xrecordid = $('#txtrecordidEdit').val();
                var xstudentcode = $('#txtstudentcodeEdit').val();
                var xfullname = $('#txtfullnameEdit').val();


                $.ajax({
                    type:'post',
                    url:'studentDataTable.php',
                    dataType:'json',
                    data:{
                        xrecordid:xrecordid,
                        xstudentcode:xstudentcode,
                        xfullname:xfullname,
                        updateStudent:1
                    },
                    success:function(data){
                        if(data.status == 'Error'){
                            let timeInterval;
                            Swal.fire({
                                title: data.status,
                                html: 'Closing in <b></b> ms <p>'+data.message + '</p>',
                                timer: 3000,
                                icon:'error',
                                timerProgressBar: true,
                                didOpen : ()=>{
                                    Swal.showLoading()
                                    timeInterval = setInterval(()=>{
                                        let content = Swal.getContent()
                                        if(content){
                                            let b = content.querySelector('b')
                                            if(b){
                                                b.textContent = Swal.getTimerLeft()
                                            }
                                        }
                                    }, 100)
                                },
                                willClose:() =>{
                                    clearInterval(timeInterval)
                                }
                            }).then((result)=>{
                                if(result.dismiss === Swal.DismissReason.timer){
                                    // console.log('Dismissed')
                                }
                            });

                            // end swal timer error
                            
                        }else{

                            let timeInterval;
                            Swal.fire({
                                title: 'Student successfully updated!',
                                html: 'Closing in <b></b>',
                                timer: 3000,
                                icon:'success',
                                timerProgressBar: true,
                                didOpen : ()=>{
                                    Swal.showLoading()
                                    timeInterval = setInterval(()=>{
                                        let content = Swal.getContent()
                                        if(content){
                                            let b = content.querySelector('b')
                                            if(b){
                                                b.textContent = Swal.getTimerLeft()
                                            }
                                        }
                                    }, 100)
                                },
                                willClose:() =>{
                                    clearInterval(timeInterval)
                                }
                            }).then((result)=>{
                                if(result.dismiss === Swal.DismissReason.timer){
                                    // window.location.reload()
                                    loadDatatable();
                                }
                            });

                        }
                    },
                    error:function(err){
                        console.log(err);
                    }
                });

            }

        });


    });

    // End update

    $(document).on('click','.btnDeleteStudent',function(e){
        
        var xrecordid = $(this).closest('tr').find('.recordid').text();
        var xstudentcode = $(this).closest('tr').find('.studentcode').text();
        var xfullname = $(this).closest('tr').find('.fullname').text();

        Swal.fire({
            title: 'Are you sure you want to delete this student?',
            text: "Other data may affect.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire(
                'Deleted!',
                'Student deleted.',
                'success'
              );

              $.ajax({
                type:'post',
                url:'studentDataTable.php',
                dataType:'json',
                data:{
                    btnDeleteStudent:1,
                    xrecordid:xrecordid,
                    xstudentcode:xstudentcode,
                    xfullname:xfullname
                },
                success:function(data){
                    if(data.status == 'Ok'){
                        loadDatatable();
                    }
                },
                error:function(err){
                    console.log(err);
                }

             });
            }

          });

        

    });

    // Load data

    function loadDatatable(){

        $('#tblStudents').DataTable().destroy();
        $('#tblStudents tbody').empty();

        $.ajax({
        url : 'studentDataTable.php',
        type:'post',
        dataType:'json',
        data:{
            load:1
        },
        success:function(data){
            // console.log(data);
            for(var i = 0; i < data.length; i ++){
                $('#tblStudents tbody').append("<tr>" +
                    // "<td class='recordid'>" + "<input type=''text' class='recordidclass' value='" +data[i].recid + "' disabled></td>" +
                
                    "<td class='recordid' style='text-align:center;'>" + +data[i].recid + "</td>" +
                    "<td class='studentcode'>" + data[i].studentcode + "</td>" +
                    "<td class='fullname'>" + data[i].fullname + "</td>" +
                    "<td style='text-align:center;'>" + "<span data-toggle='tooltip' data-placement='top' title='Edit' class='btn btn-info btnEditStudent'><i class='fa fa-pencil'></i></span> " +
                    "<span data-toggle='tooltip' data-placement='top' title='Delete' class='btn btn-danger btnDeleteStudent'><i class='fa fa-trash'></i></span>" + "</td>" +
                    
                "</tr>");
            }

            $('#tblStudents').DataTable();
            
        },
        error:function(err){
            console.log(err);
        }

        });
    }   

});