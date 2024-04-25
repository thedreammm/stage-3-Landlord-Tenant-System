<?php
include ('../php_imports/header.php');
if(!isset($_SESSION['account_id'])){
    header("Location: signup.php");
}
$account_id = $_SESSION['account_id'];

?>

<?php 
include('../php_imports/header.php');
?>
<head>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../js_imports/script.js"></script>
    <script type="text/javascript" src="../js_imports/username.js"></script>
</head>

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="w-1/5 bg-white shadow-lg">
            <div class="flex items-center justify-center h-20 shadow-md">
                <h1 class="text-3xl font-semibold text-gray-700">Messages</h1>
            </div>
            <nav class="mt-10">
                <?php
                    require_once('../php_imports/setup_messaging.php');
                ?>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="flex justify-between items-center p-6">
                <div class="flex items-center space-x-4 lg:space-x-0">
                    <h1 class="text-2xl font-semibold text-gray-700">Message Room</h1>
                </div>
                
                
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600"></span>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <div class="container mx-auto px-6 py-8">
                <?php
                    require_once('../php_imports/setup_messaging.php');
                ?>
                <div id="messages">
                    
                </div>
                <form class="form" name="form">
                    <textarea class="form_input" name="content"></textarea><br>
                    <input  class="text-3xl font-semibold text-gray-700"hidden id="room_id" class="form_input" name="room_id" value=""><br>
                    <input  class="text-3xl font-semibold text-gray-700"hidden class="form_input" name="account_id" value="<?php echo $account_id; ?>"><br>
                </form>
                <button class="text-3xl font-semibold text-gray-700" name="../php_imports/send_message" onclick="sendForm(this)">Send</button>
                <span id="response"></span>
            </div>
            </main>
        </div>

                
    </div>




<head>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../js_imports/script.js"></script>
    <script type="text/javascript" src="../js_imports/username.js"></script>
</head>

<?php include('../php_imports/footer.php')?>
