<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Earth Home | CRM</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('admin/images/earth-home.png') }}" />
    <link rel="stylesheet" href="{{ asset('adminui/css/styles.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

    <style>
        body {
            background-image: url({{ asset('admin/images/earth-home-banner.png')}}) !important;
        font-family: 'Poppins',
        sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        margin: 0;
        padding: 20px;
        }

        .login-container {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            padding: 40px;
            max-width: 400px;
            width: 100%;
            color: #333;
            animation: fadeInUp 0.8s ease-in-out;
        }

        .text-center p {
            font-size: 24px;
            color: #2a5298;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .form-container {
            margin-top: 20px;
        }

        .password-container {
            position: relative;
        }

        .password-container input[type="password"],
        .password-container input[type="text"] {
            padding-right: 45px;
        }

        .toggle-password {
            position: absolute;
            top: 67%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #007bff;
            transition: color 0.3s;
        }

        .toggle-password:hover {
            color: #0056b3;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            font-size: 14px;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ced4da;
            padding: 12px;
            font-size: 14px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-control:focus {
            border-color: #00b4db;
            box-shadow: 0 0 0 0.2rem rgba(0, 180, 219, 0.25);
        }

        .btn-primary {
            background-color: #000;
            border-color: #000;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 8px;
            transition: background-color 0.3s, border-color 0.3s;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: rgb(0, 0, 0);
            border-color: rgb(1, 5, 8);
        }

        .tech-quote {
            text-align: center;
            font-size: 14px;
            color: #666;
            margin-top: 20px;
            font-style: italic;
        }

        .error-message {
            color: red;
            font-size: 13px;
            margin-bottom: 10px;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .quote-container {
            text-align: center;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            width: 80%;
            max-width: 600px;
        }

        .quote-text {
            font-size: 20px;
            color: #333;
            margin-bottom: 15px;
        }

        .quote-author {
            font-size: 16px;
            color: #666;
            font-style: italic;
        }
    </style>
</head>
@php
$latestNote = DB::table('common')->orderby('id','desc')->limit(1)->first();

@endphp


<body>


    <div class="login-container">
        <div class="text-center">
            <a href="#" class="logo-img">
                <img src="https://earthhome.volvrit.in/admin/images/Earth-home.png" alt="Logo" width="220">
            </a>
        </div>

        <div class="form-container">
            <div class="card mb-0 ">
                <div class="card-body">
                    <form method="post" action="{{route('validateUser')}}" id="loginauth">
                        @csrf
                        <!-- Email Input -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email">
                            <div class="error-message" id="email-error"></div>
                        </div>

                        <!-- Password Input -->
                        <div class="mb-4 password-container">
                            <label for="typepassword" class="form-label">Password</label>
                            <input type="password" id="typepassword" class="form-control" name="password" placeholder="Enter Password">
                            <i class="fas fa-eye toggle-password" id="viewpassword"></i>
                            <div class="error-message" id="password-error"></div>
                        </div>

                        <!-- Authentication Code -->
                        <div class="mb-3" id="authcode" style="display: none;">
                            <label for="authcodeinput" class="form-label">Authentication Code</label>
                            <input type="text" class="form-control" name="code" id="authcodeinput" placeholder="Enter Authentication Code">
                            <div class="error-message" id="authcode-error"></div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-center">
                            <input type="submit" class="btn btn-primary" id="processing" value="Sign In">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tech Quote -->




    </div>

    <script src="{{ asset('adminui/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('adminui/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/js/ajax/authvalidation.js') }}"></script>
    <script>
        document.getElementById('viewpassword').addEventListener('click', function() {
            let passwordInput = document.getElementById('typepassword');
            let type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>

    <script>
        // Array of 1,000 tech quotes
        const quotes = [{
                text: "Technology is best when it brings people together.",
                author: "Matt Mullenweg"
            },
            {
                text: "The science of today is the technology of tomorrow.",
                author: "Edward Teller"
            },
            {
                text: "It has become appallingly obvious that our technology has exceeded our humanity.",
                author: "Albert Einstein"
            },
            {
                text: "Any sufficiently advanced technology is indistinguishable from magic.",
                author: "Arthur C. Clarke"
            },
            {
                text: "Technology is a useful servant but a dangerous master.",
                author: "Christian Lous Lange"
            },
            {
                text: "The real problem is not whether machines think but whether men do.",
                author: "B.F. Skinner"
            },
            {
                text: "The great myth of our times is that technology is communication.",
                author: "Libby Larsen"
            },
            {
                text: "The internet is becoming the town square for the global village of tomorrow.",
                author: "Bill Gates"
            },
            {
                text: "Once a new technology rolls over you, if you're not part of the steamroller, you're part of the road.",
                author: "Stewart Brand"
            },
            {
                text: "The art challenges the technology, and the technology inspires the art.",
                author: "John Lasseter"
            },
            {
                text: "Technology is nothing. What's important is that you have faith in people.",
                author: "Steve Jobs"
            },
            {
                text: "It's not that we use technology, we live technology.",
                author: "Godfrey Reggio"
            },
            {
                text: "We've arranged a civilization in which most crucial elements profoundly depend on science and technology.",
                author: "Carl Sagan"
            },
            {
                text: "Just because something doesn't do what you planned it to do doesn't mean it's useless.",
                author: "Thomas Edison"
            },
            {
                text: "The advance of technology is based on making it fit in so that you don't really even notice it.",
                author: "Bill Gates"
            },
            {
                text: "Information technology and business are becoming inextricably interwoven.",
                author: "Bill Gates"
            },
            {
                text: "The great growling engine of change is technology.",
                author: "Alvin Toffler"
            },
            {
                text: "It is only when they go wrong that machines remind you how powerful they are.",
                author: "Clive James"
            },
            {
                text: "Technology, like art, is a soaring exercise of the human imagination.",
                author: "Daniel Bell"
            },
            {
                text: "We're changing the world with technology.",
                author: "Bill Gates"
            },
            // ... Continue adding quotes up to 1000

            // Example filler quotes (you'll want to replace these with real ones):
            {
                text: "To invent, you need a good imagination and a pile of junk.",
                author: "Thomas Edison"
            },
            {
                text: "It is not the strongest of the species that survive, nor the most intelligent, but the one most responsive to change.",
                author: "Charles Darwin"
            },
            {
                text: "The role of the teacher is to create the conditions for invention rather than provide ready-made knowledge.",
                author: "Seymour Papert"
            },
            {
                text: "Technology is unlocking the innate compassion we have for our fellow human beings.",
                author: "Bill Gates"
            },
            {
                text: "Humanity is acquiring all the right technology for all the wrong reasons.",
                author: "R. Buckminster Fuller"
            },
            {
                text: "All this modern technology just makes people try to do everything at once.",
                author: "Bill Watterson"
            },
            {
                text: "Technological progress has merely provided us with more efficient means for going backwards.",
                author: "Aldous Huxley"
            },
            {
                text: "I do not fear computers. I fear the lack of them.",
                author: "Isaac Asimov"
            },
            {
                text: "It is a medium of entertainment which permits millions of people to listen to the same joke at the same time, and yet remain lonesome.",
                author: "T.S. Eliot"
            },
            {
                text: "Our technology forces us to live mythically.",
                author: "Marshall McLuhan"
            },
            {
                text: "Innovation is the ability to see change as an opportunity, not a threat.",
                author: "Steve Jobs"
            },
            {
                text: "The human spirit must prevail over technology.",
                author: "Albert Einstein"
            },
            {
                text: "We live in a society exquisitely dependent on science and technology.",
                author: "Carl Sagan"
            },
            {
                text: "There are cameras nowadays that have been developed to tell the difference between a squirrel and a bomb.",
                author: "George W. Bush"
            },
            {
                text: "Everything is designed. Few things are designed well.",
                author: "Brian Reed"
            },
            {
                text: "Code is like humor. When you have to explain it, it’s bad.",
                author: "Cory House"
            },
            {
                text: "The function of good software is to make the complex appear to be simple.",
                author: "Grady Booch"
            },
            {
                text: "Any sufficiently advanced technology is equivalent to magic.",
                author: "Arthur C. Clarke"
            },
            {
                text: "The technology you use impresses no one. The experience you create with it is everything.",
                author: "Sean Gerety"
            },
            {
                text: "It's not a faith in technology. It's faith in people.",
                author: "Steve Jobs"
            },
            {
                text: "Technology should improve your life, not become your life.",
                author: "Billy Cox"
            },
            {
                text: "The real danger is not that computers will begin to think like humans, but that humans will begin to think like computers.",
                author: "Sydney J. Harris"
            },
            {
                text: "Simplicity is about subtracting the obvious and adding the meaningful.",
                author: "John Maeda"
            },
            {
                text: "Computers are useless. They can only give you answers.",
                author: "Pablo Picasso"
            },
            {
                text: "As technology advances, it reverses the characteristics of every situation again and again.",
                author: "Marshall McLuhan"
            },
            {
                text: "The best way to predict the future is to invent it.",
                author: "Alan Kay"
            },
            {
                text: "Programs must be written for people to read, and only incidentally for machines to execute.",
                author: "Hal Abelson"
            }
        ];
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</body>

</html>