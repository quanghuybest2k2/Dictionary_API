<?php
if (isset($_GET['submit'])) {
    $word = $_GET['word'];

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.dictionaryapi.dev/api/v2/entries/en/$word",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    $response = json_decode($response, true);
    if (count($response) > 0) {
        $word = $response[0]['word'];
        $phonetics = $response[0]['phonetics'];
        $meanings = $response[0]['meanings'];
        echo "<h1>Word: $word</h1>";
        echo "<h2>Phonetics:</h2><ul>";
        foreach ($phonetics as $phonetic) {
            echo "<li>" . $phonetic['text'] . "</li>";
        }
        echo "</ul>";
        echo "<h2>Meanings:</h2><ul>";
        foreach ($meanings as $meaning) {
            echo "<li><strong>" . $meaning['partOfSpeech'] . ":</strong> ";
            foreach ($meaning['definitions'] as $definition) {
                echo $definition['definition'] . " ";
            }
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "<h1>Word not found!</h1>";
    }
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dictionary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <form action="" method="get">
            <div class="form-group">
                <label for="wordInput">Enter word</label>
                <input type="text" class="form-control" id="wordInput" name="word" required />
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Search</button>
        </form>
    </div>
</body>

</html>