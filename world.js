window.onload = function(){
    

    $('#lookup').on('click', function(){
       let result = document.getElementById('result');
       
        let country = $('#country').val();
        fetchCountry(country,'country',function(data){
            console.log(data)
            result.innerHTML = data

        });

        
    });

    $('#lookupCity').on('click', function(){
        let result = document.getElementById('result');
        
         let country = $('#country').val();
         fetchCountry(country,'cities',function(data){
             console.log(data)
             result.innerHTML = data
 
         });
 
         
     });
}

function fetchCountry(country,context, callback){
    $.ajax({
        url:"http://localhost/info2180-lab5/world.php",
        type: "GET",
        data: {
            country: country,
            context: context
          },
        success: function (data){
            callback(data)
        }
    })
}