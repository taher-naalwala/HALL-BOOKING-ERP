<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
        }

        html {
            box-sizing: border-box;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        .column {
            float: left;
            width: 50%;
            margin-bottom: 16px;
            padding: 0 8px;
        }

        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            margin: 8px;
        }

        .about-section {
            padding: 50px;
            text-align: center;
            background-color: #474e5d;
            color: white;
        }

        .container {
            padding: 0 16px;
        }

        .container::after,
        .row::after {
            content: "";
            clear: both;
            display: table;
        }

        .title {
            color: grey;
        }

        .button {
            border: none;
            outline: 0;
            display: inline-block;
            padding: 8px;
            color: white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 100%;
        }

        .button:hover {
            background-color: #555;
        }

        @media screen and (max-width: 650px) {
            .column {
                width: 100%;
                display: block;
            }
        }
    </style>
</head>

<body>

    <div class="about-section">
        <h1>About Us Page</h1>
        <p>This is a HALL BOOKING Software where users can select a particular date, pay the amount and booked that hall for that particular date. This product is developed and maintained at TN GROUP.</p>
        <p>At TN GROUP, we always strive to create products that solve a problem and makes people life easier. Below is our team of experts who have crafted this project.</p>
    </div>

    <h2 style="text-align:center">Our Team</h2>
    <div class="row">
        <div class="column">
            <div class="card">
              
                <div class="container">
                    <h2>TAHER NAALWALA</h2>
                    <p class="title">CEO & Founder</p>
                    <p>Currently doing my BTECH in CS from Indore. Love to code</p>
                    <p>taher@jamaatkhana.com</p>
                    <p><button class="button">Contact</button></p>
                </div>
            </div>
        </div>

        <div class="column">
            <div class="card">
               
                <div class="container">
                    <h2>M KOSAR SULTAN</h2>
                    <p class="title">MANAGER</p>
                    <p>I droped out of my college to manage my father's business.</p>
                    <p>kosar@jamaatkhana.com</p>
                    <p><button class="button">Contact</button></p>
                </div>
            </div>
        </div>

      
    </div>

</body>

</html>