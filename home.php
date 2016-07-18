<!DOCTYPE html>
<?php require_once '/config/config.php';?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    
    <body>
        <div style="text-align: center">
            <form action="<?php echo base_url?>controller/commn_controller.php"
                  method="post" onsubmit="return test()">
                <input type="checkbox" value="fbb" id="facebook" name="fb"> &ensp;&ensp;
            <label>facebook</label>
            <input type="checkbox" value="tww" id="tweeter" name="tw"> &ensp;&ensp; 
            <label> Twitter</label>
            <br>
            <br>
            <textarea id="post" name="fb_type" value="test"></textarea>
            <input type="submit" >
        </form>
        </div>
        <script>

        function test()
        {
            var text = document.getElementById('post').value;
           // vat fb = document.getElementById('facebook');
           // var tw  = document.getElementById('tweeter')
            
            if(text == "")
            {
                alert ("you cannot post empty status");
                return false;
            }else if (document.getElementById('facebook').checked === false ||
                    document.getElementById('tweeter')=== false)
            {
                alert
                ("plaese select one of the sociel media to post your message");
                return false;
            }
            else {
                if(confirm('Are you sure ?')=== true)
                {
                    return true;
                }else
                {
                    return false;
                };
                
            }
            
        }
        </script>
    </body>
    
</html>

