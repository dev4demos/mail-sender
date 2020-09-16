<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Message</title>
    <style>
        input,
        textarea {
            width: 100%;
        }

        .container {
            margin: 0 auto;
            width: 65%
        }
    </style>
</head>
<body>

    <div class="container">
        <form method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <fieldset>
                <legend>New Message</legend>
                <label>
                    Message Content* <br>
                    <textarea name="message_content" required="required"></textarea>
                </label>
                <br>
                <label>
                    Sender <br>
                    <input type="email" name="sender" placeholder="janedoe@gmail.com"></input>
                </label>
            </fieldset>
            <div>
                <button name="submit" value="send">Send Message</button>
            </div>
        </form>
    </div>

</body>
</html>
