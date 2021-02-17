$(document).ready(function(){


    //For Loop
    $(document).on('click','#btnForLoop',function(e){
        e.preventDefault();
        var txtPalindrome = $('#txtForloop').val();
        var palindromeLength = $('#txtForloop').val().length;

        txtPalindrome = txtPalindrome.toLowerCase();

        if(txtPalindrome == ''){
            toastr.error('Please enter something!');
            return 0;
        }

        var insertedPalindrome = [];
        var palindromeRev = [];

        for(var i = 0; i < palindromeLength ; i++){
            insertedPalindrome.push(txtPalindrome.charAt(i));
        }

        for(var j = insertedPalindrome.length -1  ; j >= 0 ; j--){
            palindromeRev.push(insertedPalindrome[j]);
        }

        var reversePalindome = palindromeRev.toString();
        reversePalindome = reversePalindome.replaceAll(',','',reversePalindome);
        
        if(txtPalindrome != reversePalindome){

            $('#palindromeHolder').append("<p class='text-danger fade-in'>" + txtPalindrome + " is not palindrome on " + reversePalindome + "<br /></p>");
            toastr.error('Unfortunately this is not a palindrome');
            
        }else{

            $('#palindromeHolder').append("<p class='text-success fade-in'>" + txtPalindrome + " is palindrome on " + reversePalindome + "<br /></p>");
            toastr.success("Congratulations this is a palindome");

        }

    });

    
    //While Loop
    $(document).on('click','#btnWhileLoop',function(e){
        e.preventDefault();
        var txtWhileLoop = $('#txtWhileLoop').val();
        var txtWhileLoopLength = $('#txtWhileLoop').val().length;

        if(txtWhileLoop == ''){
            toastr.error('Please enter something!');
            return 0;
        }

        txtWhileLoop = txtWhileLoop.toLowerCase();

        var i = 0;

        var whileOriginalArr = [];
        var whileReverseArr = [];

        while(i < txtWhileLoopLength){

            whileOriginalArr.push(txtWhileLoop.charAt(i));
            i++;
        }

        var j = whileOriginalArr.length - 1;
        
        while(j >= 0){
            whileReverseArr.push(whileOriginalArr[j]);
            j--;
        }

        var reverseString = whileReverseArr.toString();
        reverseString = reverseString.replaceAll(',','',reverseString);

        
        if(txtWhileLoop != reverseString)
        {
            $('#palindromeHolder').append("<p class='text-danger fade-in'>" + txtWhileLoop + " is not palindrome on " + reverseString + "<br /></p>");
            toastr.error('Unfortunately this is not a palindrome');
            
        }else{

            $('#palindromeHolder').append("<p class='text-success fade-in'>" + txtWhileLoop + " is palindrome on " + reverseString + "<br /></p>");
            toastr.success("Congratulations this is a palindome");

        }

    });


    //For each loop

    $(document).on('click','#btnForeachLoop',function(e){
        var txtForeachLoop = $('#txtForeachLoop').val();

        if(txtForeachLoop == ''){
            toastr.error('Please enter something!');
            return 0;
        }

        txtForeachLoop = txtForeachLoop.toLowerCase();

        var forEachOriginalArr =[];
        var reverseForeachArr = [];

        txtForeachLoop.split('').forEach(c => {
            forEachOriginalArr.push(c);
        });

        forEachOriginalArr.reverse().forEach(x=>{
            reverseForeachArr.push(x);
        });

        reverseForeachArr = reverseForeachArr.toString();
        reverseForeachArr = reverseForeachArr.replaceAll(',','',reverseForeachArr);

        if(txtForeachLoop != reverseForeachArr){
            
            $('#palindromeHolder').append("<p class='text-danger fade-in'>" + txtForeachLoop + " is not palindrome on " + reverseForeachArr + "<br /></p>");
            toastr.error('Unfortunately this is not a palindrome');

        }else{

            $('#palindromeHolder').append("<p class='text-success fade-in'>" + txtForeachLoop + " is palindrome on " + reverseForeachArr + "<br /></p>");
            toastr.success("Congratulations this is a palindome");
        }

    });

    // loop numbers

    $(document).on('focus','#txtRowLoop',function(e){
        $('#loopoutput').removeClass('fade-in');
    });


    $(document).on('click','#generateNumberLoop',function(e){

        e.preventDefault();
        $('#loopoutput').empty();

        var txtRowLoop = $('#txtRowLoop').val();
        var n = txtRowLoop;

        $('#loopoutput').addClass('fade-in');

        $('#loopoutput').css({
            border: '1px solid',
            color: 'gray',
            padding:'10px 10px 10px 10px'
        });

        for(var i = 1; i <= n; i++){
            for(var j = 1; j < i; j++){
            }
            for(var k = i; k <= n ; k++){
                $('#loopoutput').append(k + "&emsp;&emsp;&emsp;");
            }
            $('#loopoutput').append("<br>");

        }

    });

    $('#txtEvenOrOdd').keypress(function(e){
        if(e.which != 8 && e.which !=0 && e.which < 48 || e.which > 57){
            toastr.error('Input should not be letters');
            return false;
            
        }
    });

    $('#txtRowLoop').keypress(function(e){
        if(e.which != 8 && e.which !=0 && e.which < 48 || e.which > 57){
            toastr.error('Input should not be letters');
            return false;
            
        }
    });


    // generate odd or even

    $(document).on('click','#generateEvenOrOdd',function(e){
        
        e.preventDefault();
        var txtEvenOrOdd = $('#txtEvenOrOdd').val();
        if(txtEvenOrOdd == ''){
            toastr.error('Please enter something!');
            return 0;
        }

        var remainder = txtEvenOrOdd % 2;

        if(remainder == 1){
            $('#oddOrEven').append("<p class='fade-in text-info'>" + txtEvenOrOdd + " is an odd number</p>");
            toastr.info('Odd Number');
           
        }else{
            
            $('#oddOrEven').append("<p class='fade-in text-success'>" + txtEvenOrOdd + " is an even number</p>");
            toastr.success('Even Number');
        }

    });


    //Enum and switch

    var enums = [
         'Australia',
         'England',
         'Germany',
         'Philippines'
    ];

    for(var i = 0; i < enums.length ; i ++){
        $('#comboBoxCountry').append(new Option(enums[i]));
    }


    $(document).on('change','#comboBoxCountry',function(e){

        $('#comboBoxCity').empty();

        var country = $(this).val();
        var enums2 = [];

        switch(country){
            case "Australia":
                enums2.push("Sydney");
                enums2.push("Melbourne");
                enums2.push("Brisbane");
                break;
            case "England":
                enums2.push("London");
                enums2.push("Birmingham")
                break;
            case "Germany":
                enums2.push("Berlin");
                enums2.push("Hamburg");
                break;
            case "Philippines":
                enums2.push("Manila");
                enums2.push("Quezon");
                enums2.push("Makati");
                break;
            default:
                enums2.push("Unknown");
        }

        for(var q = 0 ; q < enums2.length ; q ++){

            $('#comboBoxCity').append(new Option(enums2[q]));

        }

    });

    // End switch enum



    // Start string replace
    $(document).on('click','#btnStringReplace',function(e){

        
        e.preventDefault();
        $('#tblMonth tbody').empty();
        

        var txtGivenString = $('#txtGivenString').val();
        var replaced = txtGivenString.replace(/[^a-z0-9\s]/gi, ' ');
        replaced = replaced.toUpperCase();

        $('#stringReplace').empty();
        $('#stringReplace').append("<p class='fade-in text-success'>"
            + replaced +
            "</p>");

        var monthArray = replaced.split(" ");
        console.log(monthArray);

        for(var i = 0; i < monthArray.length ; i ++){
            $('#tblMonth tbody').append("<tr class='fade-in'>" +
                "<td>" + (i + 1) + "</td>" +
                "<td>" + (monthArray[i])+ "</td>" +
            "</td>");
        }


    });

    // End String Replace


    $(document).on('click','#btnFullname',function(e){
        
        e.preventDefault();
        var txtLastName = $('#txtLastName').val();
        var txtFirstName = $("#txtFirstName").val();
        var txtMiddleName = $('#txtMiddleName').val();

        if(txtLastName == ''){
            toastr.error("Last Name Needed!");
            return 0;
        }
        
        if(txtFirstName == ''){
            toastr.error('Firt Name Needed!');
            return 0;
        }
        
        var middleInitial = txtMiddleName.substr(0,1);
        if(middleInitial == ""){
            middleInitial = "";
        }else{
            
            middleInitial = middleInitial + ".";
      
        }

        var fullname = txtLastName + " , " + txtFirstName + " " + middleInitial;
        var fullnamewithMiddleName = txtLastName + " , " + txtFirstName + " " + txtMiddleName;

        $('#tblFullName tbody').append("<tr class='fade-in'>"+
            "<td>" + fullname + "</td>"+
            "<td>" + fullnamewithMiddleName + "</td>"+
        "</tr>");
    
    });
// End Concatination


    $(document).on('click','#getInformationFromDB',function(e){

        e.preventDefault();

        $('#tblPersonsData tbody').empty();
        
        $.ajax({
            url:'personclass.php',
            type:'post',
            data:{
                getInformationFromDB:1
            },
            datatype:'json',
            success:function(data){
                var arr = JSON.parse(data);
                console.log(arr);
                var arrLen = arr.length;

                console.log(arr[0].lastname);

                for(var i = 0 ; i < arrLen ; i++){
                    $('#tblPersonsData tbody').append("<tr class='fade-in'>"+
                        "<td>" + arr[i].lastname+ "</td>" +
                        "<td>" + arr[i].middlename+ "</td>" +
                        "<td>" + arr[i].firstname+ "</td>" +
                        "<td>" + arr[i].age+ "</td>" +
                    "</tr>");
                }


            },
            error:function(err){

                console.log(err);

            }


        });

    });


    // LINQ

    //Get total of ages
    $(document).on('click','#totalAllAges',function(e){
        e.preventDefault();

        $.ajax({
            url:'personclass.php',
            type:'post',
            data:{
                totalAllAges:1
            },
            dataType:'json',
            success:function(data){
                console.log(data);
                if(data.status == 'Error'){
                    toastr.error(data.info);
                }else{
                    $('#txtTotalAge').val(data.info);
                    toastr.success("Data Retrieved!");

                }
            },
            error:function(err){
                console.log(err);
            }
        });

    });

    //Get total of ages less than 40 

    $(document).on('click','#btnTotalAgesLess40',function(e){
    
        e.preventDefault();
        $.ajax({
            url:'personclass.php',
            type:'post',
            data:{
                btnTotalAgesLess40:1
            },
            dataType:'json',
            success:function(data){
                console.log(data);
                if(data.status == 'Error'){
                    toastr.error(data.info);
                }else{
                    $('#txtTotalAgesLess40').val(data.info);
                    toastr.success("Data Retrieved!");
                }
            },
            error:function(err){
                console.log(err);
            }

        });
        
    });

    // Get Total Persons
    $(document).on('click','#btnTotalPersons',function(e){
        e.preventDefault();

        $.ajax({
            url:'personclass.php',
            type:'post',
            dataType:'json',
            data:{
                btnTotalPersons:1
            },
            success:function(data){
                if(data.status == 'Error'){
                    toastr.error(data.info);
                }else{
                    $('#txtTotalPersons').val(data.info);
                    toastr.success("Data Retrieved!");
                }

            },
            error:function(err){
                console.log(err);
            }
        });

    });


    // Total age greater than 40 

    $(document).on('click','#btnTotalAgeGreater40',function(e){
        e.preventDefault();

        $.ajax({
            url:'personclass.php',
            type:'post',
            dataType:'json',
            data:{
                btnTotalAgeGreater40:1
            },
            success:function(data){
                if(data.status == 'Error'){
                    toastr.error(data.info);
                }else{
                    $('#txtTotalAgeGreater40').val(data.info);
                    toastr.success("Data Retrieved!");
                }

            },
            error:function(err){
                console.log(err);
            }
        });


    });



    $(document).on('click','#btnSearchPersonData',function(e){
        e.preventDefault();
        

        $('#tblPersonsData tbody').empty();
        // var ascDesc = $("input[name='searchAscDesc']:checked").val();
        // var sortName = $("input[name='searchSort']:checked").val();
        var txtSearchName = $('#txtSearchName').val();

        $.ajax({
            url:'personclass.php',
            type:'post',
            dataType:'json',
            data:{
                btnSearchPersonData:1,
                txtSearchName:txtSearchName
            },
            success:function(data){
                console.log(data);
                if(data.status == 'Error'){
                    toastr.error(data.message);
                }else{

                    for(var i = 0; i < data.length ; i ++){
                        $('#tblPersonsData tbody').append("<tr class='fade-in'>"
                        +"<td>" + data[i].lastname + "</td>"+
                        "<td>" + data[i].middlename + "</td>"+
                        "<td>" + data[i].firstname + "</td>"+
                        "<td>" + data[i].age + "</td>"+
                        
                        "</tr>");
                    }

                }

            },
            error:function(err){
                console.log(err);
            }
        })



    });

    // Sort by firstname lastname middlename age
    $(document).on('change','.names',function(e){
        e.preventDefault();
        $('#tblPersonsData tbody').empty();
        var sortName = $("input[name='searchSort']:checked").val();
        var ascDesc = $("input[name='searchAscDesc']:checked").val();

        $.ajax({
            url:'personclass.php',
            type:'post',
            data:
            {
                names:1,
                sortName:sortName,
                ascDesc:ascDesc
            },
            dataType:'json',
            success:function(data){
                for(var i = 0 ; i < data.length ; i ++){
                    $('#tblPersonsData tbody').append("<tr class='fade-in'>"
                    +"<td>" + data[i].lastname + "</td>"+
                    "<td>" + data[i].middlename + "</td>"+
                    "<td>" + data[i].firstname + "</td>"+
                    "<td>" + data[i].age + "</td>"+
                        
                    "</tr>");

                }

            },
            error:function(err){

                console.log(err);

            }

        });



    });


   
}); //End document.ready