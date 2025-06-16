<html>

<head>
    <link
        href='https://fonts.googleapis.com/css?family=Playfair+Display:400,700,900,400italic,700italic,900italic|Droid+Serif:400,700,400italic,700italic'
        rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="index.css">
    <title>HoloX</title>
    <meta name="viewport" content="width=device-width">
</head>

<body onload="startTime()">
    <div class="head">
        <div class="headerobjectswrapper">

            <header><a href="index.php">HoloX</a></header>
            <div class="nav-links">
                <a class="fancy" href="index.php">
                    <span class="top-key"></span>
                    <span class="text">Home</span>
                    <span class="bottom-key-1"></span>
                    <span class="bottom-key-2"></span>
                </a>
                <a class="fancy" href="introduction.php">
                    <span class="top-key"></span>
                    <span class="text">Introduction</span>
                    <span class="bottom-key-1"></span>
                    <span class="bottom-key-2"></span>
                </a>
                <a class="fancy" href="contact.php">
                    <span class="top-key"></span>
                    <span class="text">Contact Us</span>
                    <span class="bottom-key-1"></span>
                    <span class="bottom-key-2"></span>
                </a>
                <a class="fancy" href="login_page.php">
                    <span class="top-key"></span>
                    <span class="text">Login</span>
                    <span class="bottom-key-1"></span>
                    <span class="bottom-key-2"></span>
                </a>
            </div>
        </div>
        <div class="subhead">
            <div id="time"></div>
        </div>
        <div class="content">
            <div class="description">
                <p>
                    Welcome to HoloX Bookmark Platform! In the fast-paced world of technology research, having quick and
                    easy access to valuable resources is key.
                    That's why we have developed a unique tool tailored to
                    your needs.
                    <strong>Come, join us, and enhance your research experience with HoloX Bookmark Platform!</strong>
                    <br>
                    <button>
                        <span class="box">
                            <a href="login_page.php">
                                Click Here!
                            </a>
                        </span>
                    </button>
                </p>
                <object data="book.html" width="100%" height="600">
                </object>
            </div>
            <div class="image">
                <img src="bookmark1.jpg" alt="Bookmark Image">
                <img src="bookmark2.jpg" alt="Bookmark Image">
                <img src="bookmark3.jpg" alt="Bookmark Image">
            </div>
        </div>
    </div>
    <script>
        function startTime() {
            const today = new Date();
            let h = today.getHours();
            let m = today.getMinutes();
            let s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('time').innerHTML = h + ":" + m + ":" + s;
            setTimeout(startTime, 1000);
        }

        function checkTime(i) {
            if (i < 10) { i = "0" + i };  // add zero in front of numbers < 10
            return i;
        }
    </script>
</body>

</html>