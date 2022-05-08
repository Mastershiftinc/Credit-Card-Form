$(document).ready(function(){
    load_transactions();
	$(document).on('click', '#submit', function(){
        
        var action = "send";
        
        //getting variable value
        var creditcard = $('#cardNumber').val();
        var cardname = $('#cardName').val();
        var month = $('#cardMonth').val();
        var year = $('#cardYear').val();
        var cardcvv = $('#cardCvv').val();
        
        //credit card type
        var cardType = "visa";
        var re = new RegExp("^4");
        var re2 = new RegExp("^(34|37)");
        var re3 = new RegExp("^5[1-5]");
        var re4 = new RegExp("^6011");
        var re5 = new RegExp('^9792');
        if(creditcard.match(re) != null){
            var cardType = "visa";
        }if(creditcard.match(re2) != null){
            var cardType = "amex";
        }if(creditcard.match(re3) != null){
            var cardType = "mastercard";
        }if(creditcard.match(re4) != null){
            var cardType = "discover";
        }if(creditcard.match(re5) != null){
            var cardType = 'troy';
        }


            //validatting the input text
        if(creditcard != '' && cardname != '' && month !='' && year != '' && cardcvv !='' ){
            
            
         //sending the values to php actions
        $.ajax({
         url:"php/actions.php",
         method:"POST",
         
         data:{action:action,cardType:cardType, creditcard:creditcard,cardname:cardname,month:month,year:year,cardcvv:cardcvv},
         success:function(data)
         {
            $('#cardNumber').attr("required", true);
            $('#content').html(data);
            $('#app').html(data);
         }
        });

    }else{
        //getting the alert to complete missing values
        $('#alert').show();
        $('#alert').text("Please Complete every field");
        var intervalId = window.setTimeout (function(){
            $('#alert').hide();
    }, 2500);
    }
       });

       //loading transactions records
      function load_transactions(){
        var action = "transactions";
        $.ajax({
            url:"php/actions.php",
            method:"POST",
            
            data:{action:action},
            success:function(data)
            {
             
               $('#contain').html(data);
               
            }
           });
      }


});
