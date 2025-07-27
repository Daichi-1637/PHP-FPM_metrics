<?

# クエリパラーメーターが存在しなければ即座に200を返す.
if (!array_key_exists("processing_time", $_GET)) {
    http_response_code(200);
    echo "Welcome to index.html!";
    return;
}

# クエリパラメーターがある場合はバリデーションを行い, 無効なパラメータであれば400を返す.
$processing_time = filter_input(INPUT_GET, "processing_time", FILTER_VALIDATE_INT);
if ($processing_time === false || $processing_time < 0) {
    http_response_code(400);
    echo nl2br("Invalid parameter! Must be an integer greater than or equal to 0!\nprocessing_time=" . $_GET["processing_time"]);
    return;
}

# クエリパラーメーターが有効であれば, 指定された時間だけsleepを行い, その後に200を返す.
usleep($processing_time * 1000000);
http_response_code(200);
echo nl2br("Welcome to index.html!\nSorry for keeping you waiting for " . $processing_time . "[second]!");
