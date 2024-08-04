<?php
include_once "logic/api.php";

session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle POST request logic here if needed
} else {
    // Handle GET request
    /*
        if (!isset($_SESSION['username'])) {
            header("Location: index.php");
            exit();
        }
    */
    $inquiriesArray = getInquiries();
    // You can use $inquiriesArray as needed in your application
}
function showToast($message)
{
    $_SESSION["message"] = $message;
}

function getInquiries()
{
    $url = "http://localhost:8000/inquiries";

    // Sending cURL request to get inquiry data
    $response = callAPIGet($url);

    // Decode the JSON response
    $response = json_decode($response, true);

    // Initialize an empty array
    $inquiryArray = array();

    // Check if the response is an array
    if (is_array($response)) {
        foreach ($response as $inquiry) {
            // Store the inquiry directly
            $inquiryArray[] = $inquiry;
        }

        //echo "Data retrieved successfully.";
        //echo json_encode($response);
    } else {
        // Handle API call failure
        echo "API call failed. Error: Invalid response format.";
    }

    return $inquiryArray;
}

include_once "logic/pagination.php";
?>
<script>
    const inquiriesArray = <?php echo json_encode($inquiriesArray); ?>;
</script>
<?php
include_once "view/dashboard.html";