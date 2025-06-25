<?php
include 'header.php';
// session_start();
include 'dbconnect.php';

// Reset session if start new chat is requested
// if (isset($_GET['reset'])) {
//     session_unset();
//     session_destroy();
//     header("Location: medicbot.php");
//     exit();
// }
// Reset session on every page reload (unless it's a POST request)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    session_unset();
    session_destroy();
    session_start(); // Start a new session
}

// Initialize session
if (!isset($_SESSION['step'])) {
    $_SESSION['step'] = 1;
    $_SESSION['data'] = [];
    $_SESSION['conversation'] = [];
}

function addConversation($sender, $message) {
    $_SESSION['conversation'][] = ['sender' => $sender, 'message' => $message];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = trim($_POST['response']);
    $_SESSION['data'][] = $response;
    addConversation('You', htmlspecialchars($response));
    $_SESSION['step']++;
}


$step = $_SESSION['step'];
$data = $_SESSION['data'];
$nextQuestion = "";
$doctorHTML = "";

if ($step === 1) {
    $nextQuestion = "Hello! I'm Dr. HealthBot, your virtual assistant. May I know your full name, please?";
} elseif ($step === 2) {
    $nextQuestion = "Thank you, {$data[0]}! Could you please tell me your age?";
} elseif ($step === 3) {
    $nextQuestion = "Got it. And what is your gender? (Male / Female / Other)";
} elseif ($step === 4) {
    $nextQuestion = "Thanks! Can you briefly describe the main health issue you're facing today?";
} elseif ($step === 5) {
    $nextQuestion = "I see. What is the first symptom you've noticed?";
} elseif ($step === 6) {
    $nextQuestion = "Thank you. Are you experiencing a second symptom as well? (Yes / No)";
} elseif ($step === 7) {
    if (strtolower($data[5]) === 'yes') {
        $nextQuestion = "Please describe the second symptom.";
    } else {
        $nextQuestion = "Alright. Are there any other symptoms you'd like to mention? (Yes / No)";
    }
} elseif ($step === 8) {
    if (strtolower($data[6]) === 'yes') {
        $nextQuestion = "Please describe the third symptom.";
    } else {
        $nextQuestion = "Got it. Approximately how long have you been experiencing these symptoms?";
    }
} elseif ($step === 9) {
    $nextQuestion = "Have you taken any medication or tried any home remedies for this? (Yes / No)";
} elseif ($step === 10) {
    if (strtolower($data[7]) === 'yes') {
        $nextQuestion = "Could you mention the name of the medication and whether it helped relieve your symptoms?";
    } else {
        $nextQuestion = "No worries. It's good to understand the symptoms clearly first. Do you have any known allergies or conditions like diabetes, asthma, or high blood pressure? (Yes / No)";
    }
} elseif ($step === 11) {
    if (strtolower($data[8]) === 'yes') {
        $nextQuestion = "Please list any medical conditions or allergies you're aware of.";
    } else {
        $nextQuestion = "Thanks for confirming. Based on what you've shared, I'll recommend a specialist for you shortly.";
    }
} elseif ($step === 12) {
    $symptoms = array_map('strtolower', array_slice($data, 4, 3));
    // Proceed with symptom analysis and specialist suggestion


    // Example matching logic (expandable)
    if (in_array('chest pain', $symptoms) || in_array('shortness of breath', $symptoms)) {
        $suggested_specialization = 'Cardiologist';
    } elseif (in_array('headache', $symptoms) || in_array('dizziness', $symptoms)) {
        $suggested_specialization = 'Neurologist';
    } elseif (in_array('fever', $symptoms) || in_array('cough', $symptoms)) {
        $suggested_specialization = 'General Physician';
    } else {
        $suggested_specialization = 'General Practitioner';
    }

    $nextQuestion = "Based on the symptoms you've shared, {$data[0]}, I recommend consulting a **{$suggested_specialization}**.\n\nWould you like me to assist you in scheduling an appointment? (Yes / No)";

    $mapping = [
        'fever' => 'General ', 'cold' => 'General ', 'cough' => 'Pulmonologist',
        'breath' => 'Pulmonologist', 'wheezing' => 'Pulmonologist', 'chest pain' => 'Cardiologist',
        'palpitation' => 'Cardiologist', 'high bp' => 'Cardiologist', 'skin rash' => 'Dermatologist',
        'itching' => 'Dermatologist', 'acne' => 'Dermatologist', 'eczema' => 'Dermatologist',
        'stomach ache' => 'Gastroenterologist', 'diarrhea' => 'Gastroenterologist',
        'vomit' => 'Gastroenterologist', 'constipation' => 'Gastroenterologist',
        'eye pain' => 'Ophthalmologist', 'blurry vision' => 'Ophthalmologist',
        'dry eyes' => 'Ophthalmologist', 'bone pain' => 'Orthopedic', 'joint pain' => 'Orthopedic',
        'back pain' => 'Orthopedic', 'neck pain' => 'Orthopedic', 'anxiety' => 'Psychiatrist',
        'depression' => 'Psychiatrist', 'insomnia' => 'Psychiatrist', 'stress' => 'Psychiatrist',
        'diabetes' => 'Endocrinologist', 'thyroid' => 'Endocrinologist', 'hormone' => 'Endocrinologist',
        'urine pain' => 'Urologist', 'frequent urination' => 'Urologist',
        'kidney pain' => 'Nephrologist', 'swelling' => 'Nephrologist', 'pregnancy' => 'Gynecologist',
        'period pain' => 'Gynecologist', 'infertility' => 'Gynecologist', 'toothache' => 'Dentist',
        'bleeding gums' => 'Dentist', 'cavity' => 'Dentist'
    ];

    foreach ($symptoms as $symptom) {
        foreach ($mapping as $keyword => $spec) {
            if (strpos($symptom, $keyword) !== false) {
                $suggested_specialization = $spec;
                break 2;
            }
        }
    }

    addConversation('MedicBot', "Thanks for the details. Here's a summary:");
    addConversation('MedicBot', "Name: {$data[0]}\nAge: {$data[1]}\nGender: {$data[2]}\nProblem: {$data[3]}\nSymptoms: {$data[4]}, {$data[5]}, {$data[6]}");
    addConversation('MedicBot', "Suggested Doctor: $suggested_specialization");

    $stmt = $conn->prepare("SELECT name, specialization, qualification, photo FROM doctors WHERE specialization = ?");
    $stmt->bind_param("s", $suggested_specialization);
    $stmt->execute();
    $result = $stmt->get_result();

    ob_start();
    echo '<div class="doctor-section mt-4 p-3 border rounded">';
    echo '<h5 class="mb-3">Available Doctors:</h5><div class="row">';
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $photo = $row['photo'] ? $row['photo'] : 'default-doctor.jpg';
            echo '<div class="col-md-4">
                    <div class="card mb-3">
                        <img src="img/docimg/' . $photo . '" class="card-img-top" alt="' . htmlspecialchars($row['name']) . '">
                        <div class="card-body text-center">
                            <h5>' . htmlspecialchars($row['name']) . '</h5>
                            <p>' . htmlspecialchars($row['specialization']) . '</p>
                            <small>' . htmlspecialchars($row['qualification']) . '</small>
                        </div>
                    </div>
                  </div>';
        }
    } else {
        echo '<p>No doctors found for this specialization right now.</p>';
    }
    echo '</div></div>';
    $doctorHTML = ob_get_clean();

    $_SESSION['completed'] = true;
}
?>
<div class="container-xxl bg-white p-0">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <?php
        // session_start();
        if (isset($_SESSION['candidate_id'])) {
            include 'top_menu.php';
        } else {
            include 'topmenu.php';
        }
        ?>
    </nav>
    <!-- Navbar End -->

    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .chat-background {
            background: url('img/medicbotbg.jpg') no-repeat center center fixed;
            background-size: cover;
            min-height: 110vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 60px 15px;
        }

        .chat-container {
            width: 100%;
            max-width: 700px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        .chat-box {
            max-height: 400px;
            overflow-y: auto;
            margin-bottom: 20px;
        }

        .chat-message {
            margin-bottom: 15px;
            padding: 10px 15px;
            border-radius: 20px;
            display: inline-block;
            clear: both;
            word-wrap: break-word;
        }

        .bot {
            background: #e3f2fd;
            float: left;
            max-width: 75%;
        }

        .user {
            background: #d1c4e9;
            margin-left: auto;
            text-align: right;
            float: right;
        }

        .chat-box::after {
            content: "";
            display: block;
            clear: both;
        }

        form {
            margin-top: 10px;
        }

        @media (max-width: 768px) {
            .chat-background {
                flex-direction: column;
                padding: 30px 15px;
            }
        }
    </style>

    <!-- Chat Section with Image -->
    <div class="chat-background">
        <div class="row w-100 align-items-center">
            <!-- Left Image -->
            <div class="col-md-6 d-flex justify-content-center mb-4 mb-md-0">
                <img src="img/medicbot1.png" alt="Medic Info" class="img-fluid rounded shadow" style="max-height: 450px;">
            </div>

            <!-- Right Chat -->
            <div class="col-md-6">
                <div class="chat-container">
                    <h3 class="text-center">
                        <i class="bi bi-robot" style="color: blue;"></i> Welcome to MedicBot
                    </h3>
                    <div class="chat-box" id="chatBox">
                        <?php
                        // Display conversation
                        if (!isset($_SESSION['conversation'])) $_SESSION['conversation'] = [];
                        foreach ($_SESSION['conversation'] as $msg) {
                            echo '<div class="chat-message ' . ($msg['sender'] === 'MedicBot' ? 'bot' : 'user') . '">' . nl2br($msg['message']) . '</div>';
                        }
                        if (!empty($nextQuestion)) {
                            $_SESSION['conversation'][] = ['sender' => 'MedicBot', 'message' => $nextQuestion];
                            echo '<div class="chat-message bot">' . $nextQuestion . '</div>';
                        }
                        ?>
                    </div>

                    <?php if (empty($_SESSION['completed'])): ?>
                        <form method="post">
                            <div class="form-group">
                                <input type="text" name="response" class="form-control" placeholder="Type your answer..." required autofocus>
                            </div>
                            <button class="btn btn-primary btn-block">Send</button>
                        </form>
                    <?php else: ?>
                        <?php echo $doctorHTML ?? ''; ?>
                        <div class="text-center mt-4">
                            <a href="medicbot.php?reset=true" class="btn btn-success">Start New Chat</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top">
        <i class="bi bi-arrow-up"></i>
    </a>

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <?php include 'footer.php'; ?>
    </div>
    <!-- Footer End -->
</div>

<script>
    // Scroll chat to bottom on page load
    window.onload = function () {
        var chatBox = document.getElementById("chatBox");
        chatBox.scrollTop = chatBox.scrollHeight;
    };
</script>


