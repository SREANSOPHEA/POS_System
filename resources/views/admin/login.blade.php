<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('assets/css/log.css')}}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <div class="box">
        <h1>Login</h1>
        <table>
            <form action="/login-submit" method="post">
                @csrf
                <tr>
                    <th>Name</th>
                    <th><input type="text" name="name"></th>
                </tr>
                <tr>
                    <th>Password</th>
                    <th><div class="password"><input type="password" name="password" id="passwordtext"><button id="Pass" type="button"><b><i class='bx bxs-hide'></i></b></button></div></th>
                </tr>
                <tr>
                    <td colspan="2"><button class="btnSubmit">Login</button></td>
                </tr>
                <tr>
                    <td colspan="2"><span>Don't have an account? <a href="/register">Register</a></span></td>
                </tr>
            </form>
        </table>
    </div>
    <script>
        $(document).ready(function(){
            $('#Pass').click(function(){
                var type = $('#passwordtext').attr('type');
                if(type == "password"){
                    $('.bx').attr('class',"bx bx-show");
                    $('#passwordtext').attr('type','text');
                }else{
                    $('.bx').attr('class',"bx bx-hide");
                    $('#passwordtext').attr('type','password');
                }
            })
        })
    </script>
</body>
</html>