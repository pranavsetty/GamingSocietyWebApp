<?php
    if (!isset($stylePath)) $stylePath = "style/";
?>
<head>
    <meta charset="UTF-8">
    <title>Team Omega</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato|Roboto" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo $stylePath . "main.css"; ?>">
    <link rel="stylesheet" href="<?php echo $stylePath . $styleFileName; ?>">


</head>