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
            <div class="introduction">
                <p>
                    Welcome to HoloX's Advanced Bookmarking Tool - your ultimate hub for storing, organizing, and
                    accessing valuable IT research resources.
                    <br><br>
                    Our tool is designed with the specific needs of IT researchers and professionals in mind. With a
                    focus on simplicity, ease-of-use, and efficiency, we aim to streamline your research process and
                    ensure that no valuable resource is ever lost in the noise.
                    <br><br>
                    Key features of our platform include:
                    <br>
                    <strong>Streamlined Storage:</strong> Easily save links from various popular IT resources like Stack
                    Overflow, GitHub, Quora, and more, in a matter of seconds.
                    <br><br>
                    <strong>Efficiency:</strong> Spend less time managing your saved resources and more time delving
                    into them. With our platform, you can swiftly save resources and then retrieve them when needed, all
                    in an organized manner.
                    <br><br>
                    <strong>Centralization:</strong> No more sifting through different apps, notes, or emails to find
                    that one important link. Save everything in one place and access it anytime, anywhere.
                    <br><br>
                    Take the first step towards enhanced research organization today. Get started with HoloX's Advanced
                    Bookmarking Tool and never lose a valuable link again.
                </p>
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