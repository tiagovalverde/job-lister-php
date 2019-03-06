<?php include_once 'config/init.php'; ?>

<?php
$job = new Job();

if(isset($_POST['submit'])) {
    $data = array();
    $data['company'] = $_POST['company'];
    $data['category_id'] = $_POST['category_id'];
    $data['title'] = $_POST['title'];
    $data['description'] = $_POST['description'];
    $data['location'] = $_POST['location'];
    $data['salary'] = $_POST['salary'];
    $data['contact_email'] = $_POST['contact_email'];
    $data['contact_user'] = $_POST['contact_user'];

    if($job->createJob($data)) {
        redirect('index.php', 'Your job has been listed', 'success');
    } else {
        redirect('index.php', 'Something went wrong', 'error');
    }
}

$template = new Template('templates/job-create.php');

$template->categories = $job->getCategories();

// render page
echo $template;

?>