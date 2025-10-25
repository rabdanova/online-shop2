<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <!-- <title>Neumorphism Login Form UI | CodingNepal</title> -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body>
<div class="content">
    <div class="text">
        Sign up Form
    </div>
    <form action={{route('post.signUp')}} method="POST">
        @csrf
        <div class="field">
            @error('name')
            <label for="name"><b>{{$message}}</b></label>
            @enderror
            <input type="text" id="name" name="name" required>
            <span class="fas fa-user"></span>
            <label>Your Name</label>
        </div>
        <div class="field">
            @error('email')
            <label for="email"><b>{{$message}}</b></label>
            @enderror
            <input type="text" id="email" name="email" required>
            <span class="fas fa-user"></span>
            <label>Your Email</label>
        </div>
        <div class="field">
            @error('password')
            <label for="password"><b>{{$message}}</b></label>
            @enderror
            <input type="password" id="password" name="password" required>
            <span class="fas fa-lock"></span>
            <label>Password</label>
        </div>
        <div class="field">
            <input type="password" id="password_confirmation" name="password_confirmation" required>
            <span class="fas fa-lock"></span>
            <label>Repeat your password</label>
        </div>
        <button>Sign up</button>
        <div class="sign-up">
            Have an account?
            <a href={{route('login')}}>sign in now</a>
        </div>
    </form>
</div>
</body>
</html>
<style>
@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
*{
margin: 0;
padding: 0;
/* user-select: none; */
box-sizing: border-box;
font-family: 'Poppins', sans-serif;
}
html,body{
height: 100%;
}
body{
display: grid;
place-items: center;
background: #dde1e7;
text-align: center;
}
.content{
width: 330px;
padding: 40px 30px;
background: #dde1e7;
border-radius: 10px;
box-shadow: -3px -3px 7px #ffffff73,
2px 2px 5px rgba(94,104,121,0.288);
}
.content .text{
font-size: 33px;
font-weight: 600;
margin-bottom: 35px;
color: #595959;
}
.field{
    margin-bottom: 20px;
height: 50px;
width: 100%;
display: flex;
position: relative;
}
.field:nth-child(2){
margin-top: 20px;
}
.field input{
height: 100%;
width: 100%;
padding-left: 45px;
outline: none;
border: none;
font-size: 18px;
background: #dde1e7;
color: #595959;
border-radius: 25px;
box-shadow: inset 2px 2px 5px #BABECC,
inset -5px -5px 10px #ffffff73;
}
.field input:focus{
box-shadow: inset 1px 1px 2px #BABECC,
inset -1px -1px 2px #ffffff73;
}
.field span{
position: absolute;
color: #595959;
width: 50px;
line-height: 50px;
}
.field label{
position: absolute;
top: 50%;
transform: translateY(-50%);
left: 45px;
pointer-events: none;
color: #666666;
}
.field input:valid ~ label{
opacity: 0;
}
.forgot-pass{
text-align: left;
margin: 10px 0 10px 5px;
}
.forgot-pass a{
font-size: 16px;
color: #3498db;
text-decoration: none;
}
.forgot-pass:hover a{
text-decoration: underline;
}
button{
margin: 15px 0;
width: 100%;
height: 50px;
font-size: 18px;
line-height: 50px;
font-weight: 600;
background: #dde1e7;
border-radius: 25px;
border: none;
outline: none;
cursor: pointer;
color: #595959;
box-shadow: 2px 2px 5px #BABECC,
-5px -5px 10px #ffffff73;
}
button:focus{
color: #3498db;
box-shadow: inset 2px 2px 5px #BABECC,
inset -5px -5px 10px #ffffff73;
}
.sign-up{
margin: 10px 0;
color: #595959;
font-size: 16px;
}
.sign-up a{
color: #3498db;
text-decoration: none;
}
.sign-up a:hover{
text-decoration: underline;
}
</style>
