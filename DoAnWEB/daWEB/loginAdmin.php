<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        text-align: center;
        margin: 0;
        padding: 0;
    }

    h2 {
        color: #333;

    }

    .f {
        max-width: 300px;
        margin: 20px auto;
        background-color: #fff;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        display: block;
        flex-direction: column;
        align-items: center;
    }


    label {
        display: block;
        margin-bottom: 8px;
    }

    input {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        box-sizing: border-box;

    }

    input[type="submit"] {
        background-color: #4caf50;

        color: #fff;
        cursor: pointer;
    }

    .DK {
        background: transparent;
        border: 1px solid #f5f5f5;
        color: #fff;
        width: 100%;
        text-transform: uppercase;

        transition: 0.25s ease-in-out;
        margin-top: 10px;
    }

    .DK:hover {
        /* border: 5px solid #a52a2a; */
        background: #a52a2a;
    }

    .DKR {
        background: transparent;
        border: 1px solid #f5f5f5;
        color: #fff;
        width: 100%;
        text-transform: uppercase;

        transition: 0.25s ease-in-out;
    }

    .DKR:hover {
        background: #a52a2a;
    }
</style>
</head>

<body>



    <h2>Admin Login</h2>
    <div class="f">
        <form action="xulyLogin.php" method="post" enctype="multipart/form-data">
            <label for="username">Username:</label>
            <input type="text" value="" name="username"><br>

            <label for="password">Password:</label>
            <input type="password" value="" name="password"><br>

            <input type="submit" value="Login" name="submit" class="DK">



        </form>
        <form action="Register.php" method="post">
            <input type="submit" value="Register" name="submitRegister" class="DKR">
        </form>
    </div>




</body>

</html>